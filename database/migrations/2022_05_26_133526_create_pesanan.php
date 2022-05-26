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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kode_user');
            $table->string('kode_pos');
            $table->string('address');
            $table->tinyInteger('status')->default('0');
            $table->string('message')->nullable();
            $table->string('random_code');
            $table->integer('total_price');
        });
    }
};
