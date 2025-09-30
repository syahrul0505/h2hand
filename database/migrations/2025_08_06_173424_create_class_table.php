<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Class', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('grade')->nullable();
            $table->float('registration_fee')->default(0);
            $table->float('regular_contribution_price')->default(0);
            $table->float('quota_package_price')->default(0);
            $table->integer('number_of_attendance')->default(0);
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
        Schema::dropIfExists('Class');
    }
};