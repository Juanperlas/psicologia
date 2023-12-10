<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletasTable extends Migration
{
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_aceptada_id')->constrained('citas_aceptadas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boletas');
    }
}
