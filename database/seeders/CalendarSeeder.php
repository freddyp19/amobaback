<?php

namespace Database\Seeders;

use App\Models\Calendar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calendar::where("id",">",0)->delete();
  
        $dataJson = File::get("database/dataJson/calendar.json");
        $calendars = json_decode($dataJson);
  
        foreach ($calendars->calendar as $key => $calendar) {
            Calendar::create([
                "id" => $calendar->id,
                "calendar_id" => null,
                "name" => $calendar->name,
                "created_at" => $calendar->created_at,
                "updated_at" => $calendar->updated_at,
            ]);
        }
    }
}
