<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ConsultoriosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultorio;

class ConsultoriosController extends Controller
{
    public function index()
    {
        $consultorios = Consultorio::all();
        return view('admin.consultorios.index', compact('consultorios'));
    }

    public function create()
    {
        return view('admin.consultorios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:consultorios',
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'ubicacion' => 'required',
        ]);

        $consultorio = new Consultorio($request->all());
        $consultorio->estado = 'Disponible';
        $consultorio->save();

        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio creado correctamente.');
    }

    public function edit(Consultorio $consultorio)
    {
        return view('admin.consultorios.edit', compact('consultorio'));
    }

    public function update(Request $request, Consultorio $consultorio)
    {
        $request->validate([
            'codigo' => 'required|unique:consultorios,codigo,' . $consultorio->id,
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'ubicacion' => 'required',
        ]);

        $consultorio->update($request->all());

        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio actualizado correctamente.');
    }

    public function destroy(Consultorio $consultorio)
    {
        $consultorio->delete();

        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio eliminado correctamente.');
    }

    public function export()
    {
        return Excel::download(new ConsultoriosExport, 'consultorios.xlsx');
    }
}



