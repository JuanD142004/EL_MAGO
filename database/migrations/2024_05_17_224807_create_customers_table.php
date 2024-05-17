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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name', 45);
            $table->string('company_name', 45);
            $table->string('location', 45);
            $table->bigInteger('cell_phone');
            $table->string('mail', 60)->nullable();
            $table->integer('routes_id')->index('fk_customers_routes1_idx');
            $table->timestamps();
            $table->tinyInteger('enabled')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
