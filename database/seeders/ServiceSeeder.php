<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::where("id",">",0)->delete();
  
        $dataJson = File::get("database/dataJson/services.json");
        $services = json_decode($dataJson);
  
        foreach ($services->services as $key => $service) {
            Service::create([
                "id" => $service->id,
                "external_id" => $service->external_id,
                "external_budget_id" => $service->external_budget_id,
                "external_route_id" => $service->external_route_id,
                "track_id" => $service->track_id,
                "name" => $service->name,
                "notes" => $service->notes,
                "timestamp" => $service->timestamp,
                "arrival_address" => $service->arrival_address,
                "arrival_timestamp" => $service->arrival_timestamp,
                "departure_address" => $service->departure_address,
                "departure_timestamp" => $service->departure_timestamp,
                "capacity" => $service->capacity,
                "confirmed_pax_count" => $service->confirmed_pax_count,
                "reported_departure_timestamp" => $service->reported_departure_timestamp,
                "reported_departure_kms" => $service->reported_departure_kms,
                "reported_arrival_timestamp" => $service->reported_arrival_timestamp,
                "reported_arrival_kms" => $service->reported_arrival_kms,
                "reported_vehicle_plate_number" => $service->reported_vehicle_plate_number,
                "status" => $service->status,
                "status_info" => $service->status_info,
                "reprocess_status" => $service->reprocess_status,
                "return" => $service->return,
                "created" => $service->created,
                "modified" => $service->modified,
                "synchronized_downstream" => $service->departure_timestamp,
                "synchronized_upstream" => $service->synchronized_upstream,
                "province_id" => $service->province_id,
                "sale_tickets_drivers" => $service->sale_tickets_drivers,
                "notes_drivers" => $service->notes_drivers,
                "itinerary_drivers" => $service->itinerary_drivers,
                "cost_if_externalized" => $service->cost_if_externalized,
                "created_at" => $service->created,
                "updated_at" => $service->modified,
            ]);
        }
    }
}
