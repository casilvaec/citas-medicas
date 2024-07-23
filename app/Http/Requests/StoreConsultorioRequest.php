<?php

// app/Http/Requests/StoreConsultorioRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultorioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'codigo' => 'required|unique:consultorios|max:255',
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'ubicacion' => 'required',
        ];
    }
}
