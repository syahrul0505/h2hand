<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventBookColumnsToRegistrationEventDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_event_details', function (Blueprint $table) {
            $table->integer('seri')->nullable()->after('price');
            $table->integer('lintasan')->nullable()->after('seri');
            $table->time('waktu_mulai')->nullable()->after('lintasan');
            $table->string('hasil')->nullable()->after('waktu_mulai');
            $table->string('status')->nullable()->comment('NS: No Show, DQ: Disqualified')->after('hasil');
            $table->integer('posisi')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('registration_event_details', function (Blueprint $table) {
            $table->dropColumn(['seri', 'lintasan', 'waktu_mulai', 'hasil', 'status', 'posisi']);
        });
    }
}
