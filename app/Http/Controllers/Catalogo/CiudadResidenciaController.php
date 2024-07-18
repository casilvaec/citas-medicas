<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\CiudadResidencia;
use Illuminate\Http\Request;

class CiudadResidenciaController extends Controller
{
    public function index()
    {
        $ciudades = CiudadResidencia::all();
        return view('catalogos.ciudades_residencia.index', compact('ciudades'));
    }

    public function create()
    {
        return view('catalogos.ciudades_residencia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        CiudadResidencia::create($request->all());

        return redirect()->route('admin.ciudades-residencia.index')
                         ->with('success', 'Ciudad de Residencia creada exitosamente.');
    }

    public function edit(CiudadResidencia $ciudad)
    {
        return view('catalogos.ciudades_residencia.edit', compact('ciudad'));
    }

    public function update(Request $request, CiudadResidencia $ciudad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $ciudad->update($request->all());

        return redirect()->route('admin.ciudades-residencia.index')
                         ->with('success', 'Ciudad de Residencia actualizada exitosamente.');
    }

    public function destroy(CiudadResidencia $ciudad)
    {
        $ciudad->delete();

        return redirect()->route('admin.ciudades-residencia.index')
                         ->with('success', 'Ciudad de Residencia eliminada exitosamente.');
    }
}

