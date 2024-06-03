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
        Schema::table('details_sales', function (Blueprint $table) {
            $table->foreign(['products_id'], 'fk_details_sale_products1')->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sales_id'], 'fk_details_sale_sales1')->references(['id'])->on('sales')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details_sales', function (Blueprint $table) {
            $table->dropForeign('fk_details_sale_products1');
            $table->dropForeign('fk_details_sale_sales1');
        });
    }
};
