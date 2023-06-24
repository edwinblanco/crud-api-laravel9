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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10);
            $table->string('descripcion', 250);
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            $table->foreign('categoria_id')
            ->references('id')
            ->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
