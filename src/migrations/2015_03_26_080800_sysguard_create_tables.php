<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysguardCreateTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->integer('active_group_id')->unsigned()->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('groups', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->nullable()->index();
            $table->integer('level')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('menus', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->string('name')->nullable()->index();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->boolean('enabled')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('permissions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('route')->nullable()->index();
            $table->boolean('enabled')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('group_user', function(Blueprint $table)
        {
            $table->primary(['group_id', 'user_id']);
            $table->integer('group_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->nullableTimestamps();
        });

        Schema::create('group_menu', function(Blueprint $table)
        {
            $table->primary(['group_id', 'menu_id']);
            $table->integer('group_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->nullableTimestamps();
        });

        Schema::create('group_permission', function(Blueprint $table)
        {
            $table->primary(['group_id', 'permission_id']);
            $table->integer('group_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->nullableTimestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('groups');
        Schema::drop('menus');
        Schema::drop('permissions');
        Schema::drop('group_user');
        Schema::drop('group_menu');
        Schema::drop('group_permission');
    }
}
