<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('club_id')->nullable()->after('school_name')->constrained('clubs')->onDelete('set null');
            $table->foreignId('class_id')->nullable()->after('club_id')->constrained('Class')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['club_id']);
            $table->dropForeign(['class_id']);
            $table->dropColumn(['club_id', 'class_id']);
        });
    }
};