<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triaje; // Modelo de Triaje
use App\Models\User; // Modelo de Usuario
use Carbon\Carbon; // Para calcular la edad
use Illuminate\Support\Facades\DB;

class TriajeController extends Controller
{


  public function mostrarFormularioTriaje()
  {
      return view('triaje.buscar'); 
  }
  

    /**
     * Método para registrar el triaje.
     * Este método almacena los signos vitales y asigna una prioridad automáticamente.
     */
    public function store(Request $request)
    {
        // ! Validación de los datos del formulario
       
      try {
        $request->validate([
          'pacienteId' => 'required|exists:users,id', // Verifica que el paciente exista
          'frecuenciaCardiaca' => 'required|integer|between:60,100', // Frecuencia cardíaca entre 60 y 100
          'frecuenciaRespiratoria' => 'required|integer|between:12,20', // Frecuencia respiratoria entre 12 y 20
          'presionArterialMin' => 'required|integer|between:80,84', // Presión arterial mínima entre 80 y 84
          'presionArterialMax' => 'required|integer|between:120,129', // Presión arterial máxima entre 120 y 129
          'temperaturaCorporal' => 'required|numeric|between:12,40', // Temperatura corporal entre 12 y 40 grados Celsius
          'saturacionOxigeno' => 'required|numeric|between:70,100', // Saturación de oxígeno entre 70 y 100%
        ]);

        // Obtener el usuario desde la tabla `users`
        $usuario = User::find($request->pacienteId); 

        // Verificar que el usuario existe en la tabla `pacientes`
        $paciente = DB::table('pacientes')->where('usuarioId', $usuario->id)->first();

        if (!$paciente) {
            return redirect()->back()->with('error', 'No se encontró el paciente en la tabla pacientes.');
        }

        // TODO: Crear un nuevo registro de triaje con los datos validados
        $triaje = new Triaje();
        //$triaje->pacienteId = $request->pacienteId;
        $triaje->pacienteId = $paciente->id; // Usar el ID de la tabla `pacientes`
        $triaje->frecuenciaCardiaca = $request->frecuenciaCardiaca;
        $triaje->frecuenciaRespiratoria = $request->frecuenciaRespiratoria;
        $triaje->presionArterialMin = $request->presionArterialMin;
        $triaje->presionArterialMax = $request->presionArterialMax;
        $triaje->temperaturaCorporal = $request->temperaturaCorporal;
        $triaje->saturacionOxigeno = $request->saturacionOxigeno;

        // TODO: Calcular y asignar prioridad basada en signos vitales
        $triaje->prioridad = $this->calcularPrioridad($triaje);

        //dd($request->all()); // Esto te mostrará todos los datos que llegan desde el formulario


        // TODO: Guardar el triaje en la base de datos
        $triaje->save();

        // TODO: Retornar una respuesta exitosa al usuario
        return redirect()->back()->with('success', 'Triaje registrado exitosamente.');

      } catch (\Exception $e) {
        // Capturar cualquier excepción y mostrar mensaje de error
        return redirect()->back()->with('error', 'Error al registrar el triaje: ' . $e->getMessage());
      }  
    }

    /**
     * Método privado para calcular la prioridad basado en los signos vitales del paciente.
     * @param  Triaje $triaje
     * @return string
     */
    private function calcularPrioridad($triaje)
    {
        // ! Lógica de prioridad basada en valores críticos de signos vitales
        if ($triaje->frecuenciaCardiaca < 60 || $triaje->saturacionOxigeno < 80) {
            return 'Alto'; // Prioridad alta
        } elseif ($triaje->frecuenciaCardiaca > 100 || $triaje->presionArterialMax > 129) {
            return 'Medio'; // Prioridad media
        }
        return 'Bajo'; // Prioridad baja
    }

    /**
     * Método para buscar un paciente por su número de identificación antes de registrar el triaje.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function buscarPacienteParaTriaje(Request $request)
    {
        //dd("Llega al controlador");

        // ! Validación de la entrada de búsqueda
        $request->validate([
            'busquedaPaciente' => 'required|string|max:255', // Validación básica del campo de búsqueda
        ]);

        // TODO: Obtener el número de identificación del formulario
        $busqueda = $request->input('busquedaPaciente');

        // TODO: Buscar al paciente en la tabla 'users' que tenga el número de identificación y estadoId = 2
        // $paciente = User::where('numeroIdentificacion', $busqueda)
        //     ->where('estadoId', 2)  // Solo pacientes con registro completo
        //     ->first();

        // Buscar al paciente en la tabla 'users' que tenga el número de identificación y estadoId = 2
        $paciente = User::with('genero') // Relación con la tabla generos
        ->where('numeroIdentificacion', $busqueda)
        ->where('estadoId', 2)  // Solo pacientes con registro completo
        ->first();

            //dd("Llegó antes de cargar la vista");
        // ! Verificar si se encontró al paciente
        if ($paciente) {
            // TODO: Calcular la edad a partir de la fecha de nacimiento usando Carbon
            $edad = Carbon::parse($paciente->fechaNacimiento)->age;

            // TODO: Retornar la vista con los datos del paciente y su edad
            return response()->view('triaje.buscar', compact('paciente', 'edad'));
        } else {
            // ! Si no se encuentra el paciente, retornar con un mensaje de error
            return response()->route('triaje.formulario')->with('error', 'No se encontró un paciente con ese número de identificación.');
        }
        // return response()->view('triaje.buscar');
    }

    public function listarTriajes()
    {
        // Obtener todos los triajes, ordenados por prioridad y fecha de registro
        // Obtener todos los triajes con el paciente relacionado, ordenados por prioridad y fecha de registro
        $triajes = Triaje::with('paciente.user') // Cargamos la relación del paciente y del usuario
            ->where('estadoRegistro', 'activo') // Solo triajes activos
            ->orderBy('created_at', 'desc')
            ->get();

        // Retornar la vista con los triajes
        return view('triaje.listar', compact('triajes'));
    }

    public function eliminarTriaje($id)
    {
        // try {
        //     $triaje = Triaje::findOrFail($id);
        //     $triaje->delete();
        //     return redirect()->route('triajes.listar')->with('success', 'Triaje eliminado correctamente.');
        // } catch (\Exception $e) {
        //     return redirect()->route('triajes.listar')->with('error', 'Error al eliminar el triaje.');
        // }

        try {
          // Buscar el triaje por ID
          $triaje = Triaje::findOrFail($id);
  
          // Cambiar el estado a 'inactivo' en lugar de eliminar físicamente
          $triaje->estadoRegistro = 'inactivo';
          $triaje->save();
  
          // Redirigir con un mensaje de éxito
          return redirect()->route('medico.triajes.listar')->with('success', 'El triaje ha sido eliminado correctamente.');
          } catch (\Exception $e) {
              // En caso de error, retornar a la lista de triajes con un mensaje de error
              return redirect()->route('medico.triajes.listar')->with('error', 'Error al eliminar el triaje.');
          }


    }


    public function editarTriaje($id)
    {
        // Buscar el triaje por ID
        $triaje = Triaje::findOrFail($id);

        // Retornar la vista con los datos del triaje
        return view('triaje.editar', compact('triaje'));
    }

    public function actualizarTriaje(Request $request, $id)
    {
       
      try {
      // Validar los datos ingresados
        $request->validate([
            'frecuenciaCardiaca' => 'required|integer|between:60,100',
            'frecuenciaRespiratoria' => 'required|integer|between:12,20',
            'presionArterialMin' => 'required|integer|between:80,84',
            'presionArterialMax' => 'required|integer|between:120,129',
            'temperaturaCorporal' => 'required|numeric|between:12,40',
            'saturacionOxigeno' => 'required|numeric|between:70,100',
            //'prioridad' => 'required|string',
        ]);

        // Buscar el triaje por ID
        $triaje = Triaje::findOrFail($id);

        // Actualizar los signos vitales
        $triaje->frecuenciaCardiaca = $request->frecuenciaCardiaca;
        $triaje->frecuenciaRespiratoria = $request->frecuenciaRespiratoria;
        $triaje->presionArterialMin = $request->presionArterialMin;
        $triaje->presionArterialMax = $request->presionArterialMax;
        $triaje->temperaturaCorporal = $request->temperaturaCorporal;
        $triaje->saturacionOxigeno = $request->saturacionOxigeno;

        // Recalcular la prioridad basada en los nuevos signos vitales
        $triaje->prioridad = $this->calcularPrioridad($triaje);

        // Guardar los cambios
        $triaje->save();

        // Actualizar los datos del triaje
        // $triaje->update([
        //     'frecuenciaCardiaca' => $request->frecuenciaCardiaca,
        //     'frecuenciaRespiratoria' => $request->frecuenciaRespiratoria,
        //     'presionArterialMin' => $request->presionArterialMin,
        //     'presionArterialMax' => $request->presionArterialMax,
        //     'temperaturaCorporal' => $request->temperaturaCorporal,
        //     'saturacionOxigeno' => $request->saturacionOxigeno,
        //     //'prioridad' => $request->prioridad,
        // ]);

        // Redirigir al listado de triajes con un mensaje de éxito
        return redirect()->route('medico.triajes.listar')->with('success', 'Triaje actualizado correctamente.');
      } catch (\Exception $e) {
        // En caso de error, redirigir al listado de triajes con un mensaje de error
        return redirect()->route('medico.triajes.listar')->with('error', 'Error al actualizar el triaje.' . $e->getMessage());
      }
    }


}
