<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\CiudadResidencia;
use Illuminate\Http\Request;

class CiudadResidenciaController extends Controller
{
    public function index()
    {
        $ciudadesResidencia = CiudadResidencia::all();
        return view('catalogos.ciudades_residencia.index', compact('ciudadesResidencia'));
    }

    public function create()
    {
        return view('catalogos.ciudades_residencia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ciudades_residencia',
        ]);

        CiudadResidencia::create($request->all());

        return redirect()->route('admin.ciudades-residencia.index')
                         ->with('success', 'Ciudad de Residencia creada exitosamente.');
    }

    public function edit(CiudadResidencia $ciudadResidencia)
    {
        return view('catalogos.ciudades_residencia.edit', compact('ciudadResidencia'));
    }

    public function update(Request $request, CiudadResidencia $ciudadResidencia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ciudades_residencia,nombre,' . $ciudadResidencia->id,
        ]);

        $ciudadResidencia->update($request->all());

        return redirect()->route('admin.ciudades-residencia.index')
                         ->with('success', 'Ciudad de Residencia actualizada exitosamente.');
    }

    public function destroy(CiudadResidencia $ciudadResidencia)
    {
        $ciudadResidencia->delete();

        return redirect()->route('admin.ciudades-residencia.index')
                         ->with('success', 'Ciudad de Residencia eliminada exitosamente.');
    }
}
