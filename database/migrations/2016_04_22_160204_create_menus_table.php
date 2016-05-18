<?php

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
            
            // relations
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('permission_id')->unsigned()->references('id')->on('permissions');

            $table->string('menu_group')->default('');
            $table->integer('menu_order')->unsigned()->default(0);
            $table->string('title')->default('');
            $table->string('url')->default('');
            $table->string('description')->nullable()->default(NULL);
            $table->string('icon')->nullable()->default(NULL);
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
        Schema::drop('menus');
    }
}
