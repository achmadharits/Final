<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_facility_id')->constrained('city_facilities');
            $table->foreignId('worker_id')->constrained('workers');
            $table->bigInteger('total')->nullable();
            $table->bigInteger('population')->nullable();
            $table->double('ratio')->nullable();
            $table->enum('status', ['Tinggi', 'Sedang', 'Rendah'])->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_workers');
    }
}
