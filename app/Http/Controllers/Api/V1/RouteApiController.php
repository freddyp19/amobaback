<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RouteController;
use App\Models\CalendarDaysDisabled;
use App\Models\RouteData;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RouteApiController extends Controller
{
    public function rutesAll()
    {
        try {
            #aqui se podria seleccionar por los campos date_init y date_finish
            $routeAll = (new RouteController)->showAll();
            //dd($routeAll);

            return response()->json([
                'success' => true,
                'error' => false,
                'routes' => $routeAll["routes"],
                'message' => ""
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'error' => true,
                'routes' => [],
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function ruteDataID(Request $request)
    {
        //dd();
        $consult["id"] = $request->id;
        $consult["startDate"] = date_format(date_create($request->rangeDates[0]),"Y-m-d");

        //sumamos un dia, en caso de null o ser iguales, para evitar problemas con BETWEEN
        if($request->rangeDates[1]!=null){
            $consult["endDate"] = date_format(date_create($request->rangeDates[1]),"Y-m-d");
        }else{
            $consult["endDate"] = date("Y-m-d", strtotime($request->rangeDates[0] . "+ 1 days"));
        }
        if($consult["startDate"]==$consult["endDate"]){
            $consult["endDate"] = date("Y-m-d", strtotime($request->rangeDates[1] . "+ 1 days"));
        }
        
        #se puede plantear que sonculte el mes esto cambiaria las dechas de inicio y fin

        try {
            
            $routeData = RouteData::where("route_id", "=", $request->id)->first();

            $calendarDaysDisableds = DB::select("SELECT DATE_FORMAT(DAY, '%Y-%m-%d') as day
                                      FROM calendar_days_disableds
                                      WHERE calendar_id = {$routeData->calendar_id}
                                      AND DAY BETWEEN '{$consult["startDate"]}' AND '{$consult["endDate"]}'
                                      ");

            $user = Auth::user();
            
            $daysReservation = DB::select("SELECT DATE_FORMAT(reservation_end, '%Y-%m-%d') as reservation_end, 
                                    DATE_FORMAT(reservation_start, '%Y-%m-%d') as reservation_start, 
                                    DATEDIFF (reservation_end, reservation_start) AS diasReservation 
                                    FROM reservations
                                    WHERE route_id = {$routeData->route_id}
                                    AND user_plan_id = {$user->userPlans->id}
                                    AND (
                                        reservation_start BETWEEN '{$consult["startDate"]}' AND '{$consult["endDate"]}' OR
                                        reservation_end BETWEEN '{$consult["startDate"]}' AND '{$consult["endDate"]}')
                                    ");
            # aqui tenemos un subquery, recomendaria cambiarlo por una funtion de MySQL
            $dasyServicesANDAllReservations = DB::select("SELECT TIMESTAMP as day, SUM(capacity) AS allCapacity,
                                    (SELECT COUNT(user_plan_id) FROM reservations WHERE route_id={$routeData->route_id} 
                                        AND reservation_start BETWEEN '{$consult["startDate"]}' AND '{$consult["endDate"]}')
                                    AS allReservations
                                    FROM services  S
                                    JOIN routes r ON (s.external_route_id=r.external_id)
                                    WHERE  r.id IN ({$routeData->route_id}) 
                                    AND TIMESTAMP BETWEEN '{$consult["startDate"]}' AND '{$consult["endDate"]}'
                                    GROUP BY TIMESTAMP");

            $fechaReservation = [];

            foreach ($daysReservation as $days) {
                if ($days->diasReservation == 0) {
                    $fechaReservation[] = $days->reservation_start;
                } else {
                    // recordando que ya se tiene la fecha de inicio y fin
                    $fechaReservation[] = $days->reservation_start;
                    $fechaActual = date($days->reservation_start);
                    for ($i = 0; $i < ($days->diasReservation - 1); $i++) {
                        //sumo 1 día y cambio la fecha actual
                        $fechaReservation[] = $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                    }
                    $fechaReservation[] = $days->reservation_end;
                }
            }
            
            $days = [];
            foreach ($calendarDaysDisableds as $calendarDaysDisabled) {
                $days[] = $calendarDaysDisabled->day;
            }

            $routeData->calendarDaysDisableds = $days;
            $routeData->datesReservations = $fechaReservation;
            $routeData->dasyServicesANDAllReservations = $dasyServicesANDAllReservations;

            //dd($routeData->calendarDaysDisableds);

            return response()->json([
                'success' => true,
                'error' => false,
                'routeData' => $routeData,
                'message' => ""
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => true,
                'routeData' => [],
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function ruteDataYear($year){

        try {
            //loso a modo de ejemplo esta ruta
            $routes = DB::select("SELECT r.*, rd.calendar_id FROM routes AS r
                        JOIN route_data AS rd ON rd.route_id = r.id
                        WHERE {$year} between year(rd.date_init) AND YEAR(rd.date_finish)");

            return response()->json([
                'success' => true,
                'error' => false,
                'routes' => $routes,
                'message' => ""
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => true,
                'routes' => [],
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
