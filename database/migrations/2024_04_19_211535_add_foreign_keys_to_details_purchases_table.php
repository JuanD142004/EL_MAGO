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
        Schema::table('details_purchases', function (Blueprint $table) {
            $table->foreign(['products_id'], 'fk_details_purchases_products1')->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['purchases_id'], 'fk_details_purchases_purchases1')->references(['id'])->on('purchases')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details_purchases', function (Blueprint $table) {
            $table->dropForeign('fk_details_purchases_products1');
            $table->dropForeign('fk_details_purchases_purchases1');
        });
    }
};
