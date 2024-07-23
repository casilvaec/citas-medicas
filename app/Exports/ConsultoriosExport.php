<?php 

// namespace App\Exports;

// use App\Models\Consultorio;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Illuminate\Support\Facades\DB;

// class ConsultoriosExport implements FromCollection, WithHeadings
// {
//     public function collection()
//     {
//         return DB::table('consultorios')
//             ->leftJoin('consultorio_medico', 'consultorios.id', '=', 'consultorio_medico.consultorio_id')
//             ->leftJoin('medicos', 'consultorio_medico.medico_id', '=', 'medicos.id')
//             ->leftJoin('users', 'medicos.usuarioId', '=', 'users.id')
//             ->leftJoin('especialidades_medicas', 'medicos.especialidad_id', '=', 'especialidades_medicas.id')
//             ->select(
//                 'consultorios.codigo as Consultorio',
//                 DB::raw('CONCAT(users.nombre, " ", users.apellidos) as Doctor'),
//                 'especialidades_medicas.nombre as Especialidad',
//                 'consultorio_medico.created_at as Fecha_de_Asignacion',
//                 'consultorios.estado as Estado'
//             )
//             ->get();
//     }

//     public function headings(): array
//     {
//         return [
//             'Consultorio',
//             'Doctor',
//             'Especialidad',
//             'Fecha de Asignación',
//             'Estado',
//         ];
//     }
// } -->

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsultoriosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('consultorios')
            ->leftJoin('consultorio_medico', 'consultorios.id', '=', 'consultorio_medico.consultorio_id')
            ->leftJoin('medicos', 'consultorio_medico.medico_id', '=', 'medicos.id')
            ->leftJoin('users', 'medicos.usuarioId', '=', 'users.id')
            ->leftJoin('medico_especialidades', 'medico_especialidades.medico_id', '=', 'medicos.id')
            ->leftJoin('especialidades', 'especialidades.id', '=', 'medico_especialidades.especialidadId')
            ->select(
                'consultorios.codigo as Consultorio',
                DB::raw('CONCAT(users.nombre, " ", users.apellido) as Doctor'),
                'especialidades.nombre as Especialidad',
                'consultorio_medico.created_at as Fecha_de_Asignacion',
                'consultorios.estado as Estado'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Consultorio',
            'Doctor',
            'Especialidad',
            'Fecha de Asignación',
            'Estado',
        ];
    }
}
