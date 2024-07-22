
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultorioMedicoTable extends Migration
{
    public function up()
    {
        Schema::create('consultorio_medico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultorio_id'); // consultorios.id es bigint(20) unsigned
            $table->unsignedInteger('medico_id');         // medicos.id es int(10) unsigned
            $table->date('fecha_asignacion');
            $table->timestamps();

            $table->foreign('consultorio_id')->references('id')->on('consultorios')->onDelete('cascade');
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultorio_medico');
    }
}
