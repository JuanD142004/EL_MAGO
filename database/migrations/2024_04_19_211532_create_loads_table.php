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
        Schema::create('loads', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_UNIQUE');
            $table->date('date');
            $table->integer('products_id')->index('fk_load_products1_idx');
            $table->string('amount', 45);
            $table->integer('routes_id')->index('fk_load_routes1_idx');
            $table->integer('truck_types_id')->index('fk_load_truck_types1_idx');
            $table->timestamps();

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
        Schema::dropIfExists('loads');
    }
};
