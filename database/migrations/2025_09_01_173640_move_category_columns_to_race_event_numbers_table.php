<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('race_event_numbers', function (Blueprint $table) {
            $table->string('category_event')->nullable()->after('price');   
            $table->string('age_category')->nullable()->after('category_event');
            $table->string('max_age')->nullable()->after('age_category');
            $table->string('class_category')->nullable()->after('max_age');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['category_event', 'age_category', 'max_age', 'class_category']);
        });
    }


    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('category_event')->nullable(); 
            $table->string('age_category')->nullable();
            $table->string('max_age')->nullable();
            $table->string('class_category')->nullable();
        });

        Schema::table('race_event_numbers', function (Blueprint $table) {
            $table->dropColumn(['category_event', 'age_category', 'max_age', 'class_category']);
        });
    }
};