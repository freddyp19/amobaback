<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->primary('id');
            $table->string('external_id')->nullable();
            $table->string('external_budget_id')->nullable();
            $table->string('external_route_id')->nullable();
            $table->integer('track_id')->nullable();
            $table->string('name')->nullable();
            $table->string('notes')->nullable();
            $table->timestamp('timestamp', $precision = 0)->nullable();
            $table->string('arrival_address')->nullable();
            $table->timestamp('arrival_timestamp', $precision = 0)->nullable();
            $table->string('departure_address')->nullable();
            $table->timestamp('departure_timestamp', $precision = 0)->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('confirmed_pax_count')->default(0)->nullable();
            $table->timestamp('reported_departure_timestamp', $precision = 0)->nullable();
            $table->decimal('reported_departure_kms', $precision = 8, $scale = 2)->nullable();
            $table->timestamp('reported_arrival_timestamp', $precision = 0)->nullable();
            $table->decimal('reported_arrival_kms', $precision = 8, $scale = 2)->nullable();
            $table->integer('reported_vehicle_plate_number')->nullable();
            $table->integer('status')->nullable();
            $table->json('status_info')->nullable();
            $table->integer('reprocess_status')->default(0)->nullable();
            $table->integer('return')->default(0)->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->string('synchronized_downstream')->nullable();
            $table->string('synchronized_upstream')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('sale_tickets_drivers')->default(0)->nullable();
            $table->string('notes_drivers')->nullable();
            $table->longText('itinerary_drivers')->nullable();
            $table->decimal('cost_if_externalized', $precision = 8, $scale = 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
