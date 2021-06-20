<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_number')->unique();
            //$table->unsignedBigInteger('product_id')->nullable();
            $table->float('sub_total')->default(0);
            //$table->unsignedBigInteger('shipping_id')->default(0)->nullable();
            $table->float('coupon')->default(0)->nullable();
            $table->float('total_amount')->default(0);
            $table->integer('quantity')->default(0);
            $table->enum('payment_method',['cod','paypal'])->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('status',['new','process','delivered','cancel'])->default('new');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            //$table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('SET NULL');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            //billing
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->text('address');
            $table->string('postcode')->nullable();
            //shipping
            $table->string('scountry');
            $table->string('scity');
            $table->string('sstate');
            $table->text('saddress');
            $table->string('spostcode')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
