<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('max_people')->unsigned()->nullable()->after('age');
            $table->string('age_category')->nullable()->after('max_people');
            $table->string('class_category')->nullable()->after('age_category');
            $table->string('image')->nullable()->after('class_category');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['max_people', 'age_category', 'class_category', 'image']);
        });
    }
};