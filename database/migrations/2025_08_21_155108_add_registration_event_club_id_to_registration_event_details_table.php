<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrationEventClubIdToRegistrationEventDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('registration_event_details', function (Blueprint $table) {
            $table->unsignedBigInteger('registration_event_club_id')->nullable()->after('registration_event_id');

            $table->foreign('registration_event_club_id')->references('id')->on('registration_event_clubs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('registration_event_details', function (Blueprint $table) {
            $table->dropForeign(['registration_event_club_id']);
            $table->dropColumn('registration_event_club_id');
        });
    }
}