<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::where("id",">",0)->delete();
  
        $dataJson = File::get("database/dataJson/routes.json");
        $routes = json_decode($dataJson);
  
        foreach ($routes->routes as $key => $route) {
            Route::create([
                "id" => $route->id,
                "external_id" => $route->external_id,
                "invitation_code" => $route->invitation_code,
                "title" => $route->title,
                "start_timestamp" => $route->start_timestamp,
                "end_timestamp" => $route->end_timestamp,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
