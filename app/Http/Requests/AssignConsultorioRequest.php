<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignConsultorioRequest extends FormRequest
{
    public function authorize()
    {
        // Puedes implementar lógica adicional para verificar la autorización del usuario.
        // Retorna true si todos los usuarios pueden realizar esta solicitud.
        return true;
    }

    public function rules()
    {
        return [
            'consultorio_id' => 'required|exists:consultorios,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha_asignacion' => 'required|date',
        ];
    }
}
