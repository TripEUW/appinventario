<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoUserReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_user_reqs', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0);
            $table->boolean('status_req')->default(0);
            $table->boolean('status_req_user')->default(0);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('equipo_id')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
                

            $table->foreign('equipo_id')
                ->references('id')->on('equipos')
                ->onDelete('cascade');

            $table->timestamp('fecha_status_req')->nullable();
            $table->timestamp('fecha_status_req_user')->nullable();
                
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
        Schema::dropIfExists('equipo_user_reqs');
    }
}
