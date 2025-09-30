<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registration_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('set null');
            $table->string('club');
            $table->string('name'); 
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth');
            $table->string('school')->nullable();
            $table->string('class')->nullable(); 
            $table->string('coach_name');
            $table->string('phone');
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_events');
    }
};