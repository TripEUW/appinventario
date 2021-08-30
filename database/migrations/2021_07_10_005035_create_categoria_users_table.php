<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_users', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('categoria_id')
                ->references('id')->on('categorias')
                ->onDelete('set null');
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
        Schema::dropIfExists('categoria_users');
    }
}
