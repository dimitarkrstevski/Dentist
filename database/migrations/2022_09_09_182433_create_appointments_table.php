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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id')->nullable()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->time('time');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
