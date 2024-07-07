<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateUsuariosToUsers extends Migration
{
    public function up()
    {
        // Verifica si la tabla usuarios existe
        if (Schema::hasTable('usuarios')) {
            // Copia los datos de la tabla usuarios a la tabla users
            DB::table('usuarios')->select([
                'idUsuario as id',
                'nombre as name',
                'apellidos',
                'correoElectronico as email',
                'password',
                'tipoIdentificacion',
                'idGenero',
                'fechaNacimiento',
                'telefonoConvencional',
                'telefonoCelular',
                'direccion',
                'idCiudadResidencia',
                'idEstadoUsuario',
                'created_at',
                'updated_at'
            ])->chunkById(100, function ($usuarios) {
                foreach ($usuarios as $usuario) {
                    DB::table('users')->updateOrInsert(
                        ['id' => $usuario->id],
                        (array) $usuario
                    );
                }
            });
        }
    }

    public function down()
    {
        // No hay acción para revertir la migración
    }
}
