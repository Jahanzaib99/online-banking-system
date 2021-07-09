<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->float('price')->nullable();
            $table->string('phone')->nullable();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('make_id')->nullable();
            $table->unsignedBigInteger('car_model_id')->nullable();
            $table->integer('year')->nullable();
            $table->string('mileage')->nullable();
            $table->string('registration')->nullable();
            $table->string('transmission')->nullable();
            $table->smallInteger('doors')->nullable();
            $table->smallInteger('cylinders')->nullable();
            $table->string('fuel')->nullable();
            $table->text('description');
            $table->text('remarks')->nullable();
            $table->string('engine')->nullable();
            $table->string('body')->nullable();
            $table->string('trim')->nullable();
            $table->string('gearbox')->nullable();
            $table->text('image')->nullable();
            $table->enum('status', ['publish', 'unPublish'])->default('Publish');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->foreign('make_id')->references('id')->on('makes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
