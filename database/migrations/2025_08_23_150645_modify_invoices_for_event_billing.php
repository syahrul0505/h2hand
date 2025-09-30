<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyInvoicesForEventBilling extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('registration_event_id')->nullable()->change();
            $table->foreignId('club_id')->nullable()->change();
            $table->foreignId('event_id')->nullable()->after('id')->constrained('events')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
            $table->foreignId('registration_event_id')->nullable(false)->change();
            $table->foreignId('club_id')->nullable(false)->change();
        });
    }
}