<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_id')->unique();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('floor_no')->nullable();
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('rf_id')->nullable()->unique();
            $table->string('auth')->nullable();
            $table->string('level')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('person');
    }
}
