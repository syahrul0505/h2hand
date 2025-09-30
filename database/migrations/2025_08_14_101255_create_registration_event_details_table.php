<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registration_event_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_event_id')->nullable()->constrained('registration_events')->onDelete('cascade');
            $table->foreignId('race_event_number_id')->nullable()->constrained('race_event_numbers')->onDelete('set null');
            $table->string('name'); 
            $table->decimal('price', 15, 2); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_event_details');
    }
};