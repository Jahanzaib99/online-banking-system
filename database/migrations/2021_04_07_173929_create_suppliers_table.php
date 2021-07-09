<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('trade_name');
            $table->string('contact_name')->nullable();
            $table->string('contact_tel');
            $table->string('contact_email');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('post_town')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->string('website_address')->nullable();
            $table->string('business_type')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('VAT_registered')->nullable();
            $table->string('trading_years');
            $table->string('vehicle_parts_deal');
            $table->string('ebay_account_username')->nullable();
            $table->string('about')->nullable();
            $table->enum('account_status', ['pending', 'aproved', 'cancelled'])->default('pending')->nullable();;
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
