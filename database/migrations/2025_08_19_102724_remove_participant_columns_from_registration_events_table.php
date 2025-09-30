<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('registration_events', function (Blueprint $table) {
            $table->dropColumn([
                'club',
                'name',
                'gender',
                'date_of_birth',
                'school',
                'class',
                'coach_name',
                'phone'
            ]);
        });
    }

    public function down()
    {
        Schema::table('registration_events', function (Blueprint $table) {
            $table->string('club')->after('event_id');
            $table->string('name')->after('club');
            $table->enum('gender', ['male', 'female'])->after('name');
            $table->date('date_of_birth')->after('gender');
            $table->string('school')->nullable()->after('date_of_birth');
            $table->string('class')->nullable()->after('school');
            $table->string('coach_name')->after('class');
            $table->string('phone')->after('coach_name');
        });
    }
};