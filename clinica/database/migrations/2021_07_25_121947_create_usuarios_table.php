<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido');
            $table->unsignedBigInteger('cargo_id');
            $table->integer('DNI');
            $table->date('fechaNacimiento');
            $table->integer('telefono');
            $table->string('email');
            $table->string('usuario');
            $table->string('clave');
            
            $table->timestamps();

            $table->foreign('cargo_id')
            ->references('id')
            ->on('cargos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
