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
            $table->string('slug')->nullable()->default(NULL);
            $table->string('parent_slug')->nullable()->default(NULL);
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions');

            $table->string('menu_group')->default('');
            $table->integer('menu_order')->default(0);
            $table->string('title')->default('');
            $table->string('url')->default('');
            $table->string('description')->nullable()->default(NULL);
            $table->string('icon')->nullable()->default(NULL);
            $table->string('locale')->nullable()->default('en');
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
