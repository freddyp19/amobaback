<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CalendarsApiController extends Controller
{
    public function calendarsAll(){
        #solo usamos recursos que se encuentran en nuestra controller definidos
        try {

            $calendarsAll = (new \App\Http\Controllers\CalendarController)->showAll();

            return response()->json([
                'success' => true,
                'error' => false,
                'calendars' => $calendarsAll["calendars"],
                'message' => ""
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'error' => true,
                'calendars' =>[],
                'message' => $e->getMessage()
            ], 500);
        }
        
    }
}
