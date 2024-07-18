<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::all();
        return view('catalogos.generos.index', compact('generos'));
    }

    public function create()
    {
        return view('catalogos.generos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:generos',
        ]);

        Genero::create($request->all());

        return redirect()->route('admin.generos.index')
                         ->with('success', 'Género creado exitosamente.');
    }

    public function edit(Genero $genero)
    {
        return view('catalogos.generos.edit', compact('genero'));
    }

    public function update(Request $request, Genero $genero)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:generos,nombre,' . $genero->id,
        ]);

        $genero->update($request->all());

        return redirect()->route('admin.generos.index')
                         ->with('success', 'Género actualizado exitosamente.');
    }

    public function destroy(Genero $genero)
    {
        $genero->delete();

        return redirect()->route('admin.generos.index')
                         ->with('success', 'Género eliminado exitosamente.');
    }
}
