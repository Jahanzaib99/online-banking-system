<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparePartTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_part_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('spare_part_id');
            $table->text('description');
            $table->text('image')->nullable();
            $table->string('colour')->nullable();
            $table->enum('status', ['publish', 'unPublish'])->default('Publish');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('spare_part_id')->references('id')->on('spare_parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_part_types');
    }
}
