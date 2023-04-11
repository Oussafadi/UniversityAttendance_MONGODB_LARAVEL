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
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admissionNo');
            $table->unsignedBigInteger('filiere_id')->index();
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('cascade');
            $table->unsignedBigInteger('module_id')->index();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->string('status', 10);
            $table->string('seance', 10);
            $table->string('date', 20)->nullable();
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
        Schema::dropIfExists('absences');
    }
};
