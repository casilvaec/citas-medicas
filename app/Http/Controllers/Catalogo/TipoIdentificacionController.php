<?php

// app/Http/Controllers/Catalogo/TipoIdentificacionController.php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;

class TipoIdentificacionController extends Controller
{
    public function index()
    {
        $tiposIdentificacion = TipoIdentificacion::all();
        return view('catalogos.tipos_identificacion.index', compact('tiposIdentificacion'));
    }

    public function create()
    {
        return view('catalogos.tipos_identificacion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:255|unique:tipos_identificacion,tipo',
        ]);

        TipoIdentificacion::create($request->all());

        return redirect()->route('admin.tipos-identificacion.index')
                         ->with('success', 'Tipo de Identificación creado exitosamente.');
    }

    public function edit(TipoIdentificacion $tipos_identificacion)
    {
        return view('catalogos.tipos_identificacion.edit', ['tipoIdentificacion' => $tipos_identificacion]);
    }

    public function update(Request $request, TipoIdentificacion $tipos_identificacion)
    {
        $request->validate([
            'tipo' => 'required|string|max:255|unique:tipos_identificacion,tipo,' . $tipos_identificacion->id,
        ]);

        $tipos_identificacion->update($request->all());

        return redirect()->route('admin.tipos-identificacion.index')
                         ->with('success', 'Tipo de Identificación actualizado exitosamente.');
    }

    public function destroy(TipoIdentificacion $tipos_identificacion)
    {
        $tipos_identificacion->delete();

        return redirect()->route('admin.tipos-identificacion.index')
                         ->with('success', 'Tipo de Identificación eliminado exitosamente.');
    }
}
