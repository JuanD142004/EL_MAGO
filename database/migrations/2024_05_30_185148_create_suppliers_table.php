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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_UNIQUE');
            $table->string('nit', 45)->unique('nit_UNIQUE');
            $table->string('supplier_name', 45);
            $table->bigInteger('cell_phone')->unique('cell_phone_UNIQUE');
            $table->string('mail', 45)->nullable()->unique('mail_UNIQUE');
            $table->string('address', 45)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('suppliers');
    }
};
