<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Route;
use App\Http\Requests\LoadRequest;
use App\Models\Product;
use App\Models\TruckType;
use SebastianBergmann\Type\TrueType;

/**
 * Class LoadController
 * @package App\Http\Controllers
 */
class LoadController extends Controller
{
    /**
     * Muestra una lista de recursos.
     */
    public function index()
    {
        $loads = Load::paginate();
        $products = Product::all(); // Obtener todos los productos

        return view('load.index', compact('loads', 'products'))
            ->with('i', (request()->input('page', 1) - 1) * $loads->perPage());
    }


    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $load = new Load();
        $routes = Route::all();
        $products = Product::all();
        $truckTypes = TruckType::all(); // Obtener todos los tipos de camiones
    
        return view('load.create', compact('load', 'routes', 'products', 'truckTypes'));
    }
       
   /**
    * Almacena un recurso recién creado en el almacenamiento.
    */
    public function store(LoadRequest $request)
    {
        // Validar los datos recibidos del formulario
        $validatedData = $request->validated();

        // Crear una nueva instancia de Load
        $load = new Load();

        // Asignar los valores recibidos a las propiedades del modelo Load
        $load->date = $validatedData['date'];
        $load->products_id = $validatedData['products_id']; // Aquí asignamos el ID del producto seleccionado
        $load->amount = $validatedData['amount'];
        $load->routes_id = $validatedData['routes_id'];
        $load->truck_types_id = $validatedData['truck_types_id'];

        // Guardar el modelo en la base de datos
        $load->save();

        // Redirigir a la vista index de carga con un mensaje de éxito
        return redirect()->route('load.index')->with('success', '¡Carga creada exitosamente!');
    }
    
    /**
     * Muestra el recurso especificado.
     */
    public function show($id)
    {
        $load = Load::find($id);

        return view('load.show', compact('load'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit($id)
{
    $load = Load::findOrFail($id);
    $routes = Route::all(); // Obtener todas las rutas
    $products = Product::all(); // Obtener todos los productos
    $truckTypes = TruckType::all(); // Obtener todos los tipos de camión

    // Convertir la fecha a un objeto DateTime si es una cadena de texto
    if (is_string($load->date)) {
        $load->date = new \DateTime($load->date);
    }

    // Verificar si han pasado menos de 24 horas desde la creación
    $currentTime = now();
    $createdAt = $load->created_at;
    $differenceInHours = $currentTime->diffInHours($createdAt);

    // Verificar si la fecha es del día anterior al día actual menos 24 horas
    $isPreviousDay = $load->date < $currentTime->subHours(24);

    if ($differenceInHours >= 24 || $isPreviousDay) {
        // Si han pasado más de 24 horas desde la creación
        // o la fecha es del día anterior al día actual menos 24 horas, redireccionar con un mensaje de error
        $errorMessage = 'No puedes editar esta carga porque han pasado más de 24 horas desde su registro o la fecha de la carga es del día anterior al día actual menos 24 horas.';
        return redirect()->route('load.index')->with('error', $errorMessage);
    }

    // Si pasa la verificación, mostrar la vista de edición
    return view('load.edit', compact('load', 'routes', 'products', 'truckTypes'));
}

    
    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(LoadRequest $request, Load $load)
    {
        // Verificar si han pasado menos de 24 horas desde la creación
        $currentTime = now();
        $createdAt = $load->created_at;
        $differenceInHours = $currentTime->diffInHours($createdAt);
    
        // Verificar si la fecha es del día anterior al día actual menos 24 horas
        $isPreviousDay = $load->date < $currentTime->subHours(24);
    
        if ($differenceInHours >= 24 || $isPreviousDay) {
            // Si han pasado más de 24 horas desde la creación
            // o la fecha es del día anterior al día actual menos 24 horas, redireccionar con un mensaje de error
            $errorMessage = 'No puedes editar esta carga porque han pasado más de 24 horas desde su registro o la fecha de la carga es del día anterior al día actual menos 24 horas.';
            return redirect()->route('load.index')->with('error', $errorMessage);
        }
    
        // Actualizar la carga si no hay restricciones de tiempo
        $load->update($request->validated());
    
        return redirect()->route('load.index')->with('success', '¡Carga actualizada exitosamente!');
    }
    
    public function destroy($id)
    {
        
    }
    
}
