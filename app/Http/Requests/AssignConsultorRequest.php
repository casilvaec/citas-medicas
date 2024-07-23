<?php 

// app/Http/Requests/AssignConsultorioRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignConsultorioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'consultorioId' => 'required|exists:consultorios,id',
            'medicoId' => 'required|exists:users,id',
            'fecha_asignacion' => 'required|date',
        ];
    }
}
