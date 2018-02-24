<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name', 50);
            $table->string('menu_url');
            $table->string('menu_icon', 20);
            $table->unsignedInteger('parent_id');
            $table->unsignedInteger('sort');
            $table->unsignedTinyInteger('is_show');
            $table->unsignedTinyInteger('log_type');
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
        Schema::dropIfExists('menus');
    }
}
