
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixForeignKeysAndIndexesFinal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Asegurar que la columna 'id' en 'roles' sea del tipo correcto
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->change();

            // Verificar si el índice ya existe antes de agregarlo
            $indexExists = DB::select(DB::raw("
                SELECT COUNT(*) as count 
                FROM information_schema.statistics 
                WHERE table_schema = DATABASE() 
                AND table_name = 'roles' 
                AND index_name = 'roles_id_index'
            "))[0]->count;

            if ($indexExists == 0) {
                $table->index('id', 'roles_id_index');
            }
        });

        // Añadir las claves foráneas correctamente
        Schema::table('rol_permisos', function (Blueprint $table) {
            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::table('usuario_roles', function (Blueprint $table) {
            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar las claves foráneas
        Schema::table('rol_permisos', function (Blueprint $table) {
            $table->dropForeign(['rol_permisos_rolid_foreign']);
        });

        Schema::table('usuario_roles', function (Blueprint $table) {
            $table->dropForeign(['usuario_roles_rolid_foreign']);
        });

        // Cambiar el tipo de la columna 'id' a 'int'
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedInteger('id', true)->change();
            $table->dropIndex('roles_id_index');
        });
    }
}
