<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('reciever_id');
            $table->unsignedBigInteger('request_order_id');
            $table->unsignedBigInteger('spare_part_type_id');
            $table->string('size')->nullable();
            $table->string('colour')->nullable();
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('pending')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reciever_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('request_order_id')->references('id')->on('request_orders')->onDelete('cascade');
            $table->foreign('spare_part_type_id')->references('id')->on('spare_part_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_offers');
    }
}
