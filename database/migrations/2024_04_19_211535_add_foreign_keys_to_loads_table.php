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
        Schema::table('loads', function (Blueprint $table) {
            $table->foreign(['products_id'], 'fk_load_products1')->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['routes_id'], 'fk_load_routes1')->references(['id'])->on('routes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['truck_types_id'], 'fk_load_truck_types1')->references(['id'])->on('truck_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loads', function (Blueprint $table) {
            $table->dropForeign('fk_load_products1');
            $table->dropForeign('fk_load_routes1');
            $table->dropForeign('fk_load_truck_types1');
        });
    }
};
