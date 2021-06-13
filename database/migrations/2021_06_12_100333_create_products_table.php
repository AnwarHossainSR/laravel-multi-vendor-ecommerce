<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('description')->nullable();
            $table->integer('stock')->default(0);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->text('photo');
            $table->unsignedFloat('price')->default(0);
            $table->integer('discount')->nullable();
            $table->unsignedFloat('offer_price')->nullable();
            $table->enum('size',['S','M','L','XL'])->default('M');
            $table->enum('condition',['new','hot','popular','winter'])->default('new');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->boolean('is_featured')->default(false);
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('products');
    }
}
