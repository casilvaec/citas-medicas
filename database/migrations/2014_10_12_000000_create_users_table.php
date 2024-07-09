<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tipoIdentificacion')->nullable();
            $table->string('identificacion')->nullable();
            $table->unsignedBigInteger('idGenero')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('telefonoConvencional')->nullable();
            $table->string('telefonoCelular')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('idCiudadResidencia')->nullable();
            $table->unsignedBigInteger('idEstadoUsuario')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('idGenero')->references('id')->on('generos')->onDelete('set null');
            $table->foreign('idCiudadResidencia')->references('id')->on('ciudad_residencias')->onDelete('set null');
            $table->foreign('idEstadoUsuario')->references('id')->on('estado_usuarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
