<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            
            $table->unsignedBigInteger('marca_id')->nullable();
            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->boolean('status')->default(false);
            
            $table->foreign('marca_id')
            ->references('id')->on('marcas')
            ->onDelete('cascade');

            $table->foreign('modelo_id')
            ->references('id')->on('modelos')
                ->onDelete('cascade');
                
                $table->foreign('categoria_id')
                ->references('id')->on('categorias')
                ->onDelete('set null');
            
            $table->timestamp('fecha_compra')->nullable();
            $table->text('descripcion')->nullable();
            
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
        Schema::dropIfExists('equipos');
    }
}
