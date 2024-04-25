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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_UNIQUE');
            $table->string('product_name', 45);
            $table->string('brand', 45);
            $table->string('price_unit', 45);
            $table->string('unit_of_measurement', 45);
            $table->integer('suppliers_id')->index('fk_products_suppliers1_idx');
            $table->string('created_at', 45)->nullable();
            $table->string('updated_at', 45)->nullable();
            $table->tinyInteger('enabled')->nullable();

            $table->primary(['id']);
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
};
