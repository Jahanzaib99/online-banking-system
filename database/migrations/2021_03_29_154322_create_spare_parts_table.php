<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('price');
            $table->unsignedBigInteger('car_id');
            $table->text('description');
            $table->text('remarks')->nullable();
            $table->text('image')->nullable();
            $table->enum('status', ['publish', 'unPublish'])->default('Publish');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_parts');
    }
}
