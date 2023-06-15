<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::where("id",">",0)->delete();
  
        $dataJson = File::get("database/dataJson/reservations.json");
        $reservations = json_decode($dataJson);
  
        foreach ($reservations->reservations as $key => $reservation) {
            Reservation::create([
                "id" => $reservation->id,
                "user_plan_id" => $reservation->user_plan_id,
                "route_id" => $reservation->route_id,
                "track_id" => $reservation->track_id,
                "reservation_start" => $reservation->reservation_start,
                "reservation_end" => $reservation->reservation_end,
                "route_stop_origin_id" => $reservation->route_stop_origin_id,
                "route_stop_destination_id" => $reservation->route_stop_destination_id,
                "created_at" => $reservation->created_at,
                "updated_at" => $reservation->updated_at,
                "deleted_at" => $reservation->deleted_at,
            ]);

        }
    }
}
