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
        Schema::create('rol_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('roless')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('submenu_id');
            $table->foreign('submenu_id')->references('id')->on('submenu')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['rol_id','submenu_id']);
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
        Schema::dropIfExists('rol_menus');
    }
};
