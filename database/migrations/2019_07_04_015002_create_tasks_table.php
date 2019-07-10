<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     * * Run the migrations.
     ******** CREATE MIGRATIONS
     * php artisan make:migration create_users_table
     * php artisan make:migration create_users_table --create=users (CON NOMBRE DE TABLA)
     ******** RUNNING MIGRTIONS
     * php artisan migrate
     ******** ROLLBACK AND RESET MIGRATIONS
     * php artisan migrate:rollback
     * php artisan cache:clear
     * php artisan migrate:reset
     ******** ROLLBACK / MIGRATE IN SIMPLE COMMAND
     * php artisan migrate:refresh
     * php artisan migrate:refresh --seed (RESET THE SEEDERS TOO)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->string('urlimage')->nullable();
            $table->integer('order')->unsigned()->default(0);
            $table->boolean('status')->unsigned()->default(0);
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
        Schema::dropIfExists('tasks');
    }
}
