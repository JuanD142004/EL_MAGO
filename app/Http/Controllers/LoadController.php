<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Route;
use App\Models\TruckType;
use Illuminate\Http\Request;

/**
 * Class LoadController
 * @package App\Http\Controllers
 */
class LoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loads = Load::paginate();

        return view('load.index', compact('loads'))
            ->with('i', (request()->input('page', 1) - 1) * $loads->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $load = new Load();
        $routes = Route::all();
        $truckTypes = TruckType::all();

        return view('load.create', compact('load', 'routes', 'truckTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'routes_id' => 'required|integer',
            'truck_types_id' => 'required|integer',
        ]);

        $load = new Load();
        $load->date = $request->input('date');
        $load->routes_id = $request->input('routes_id');
        $load->truck_types_id = $request->input('truck_types_id');
        $load->enabled = true;
        $load->disabled_at = now()->addHours(24);

        $load->save();

        return redirect()->route('loads.index')
                         ->with('success', 'Carga creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $load = Load::findOrFail($id);

        return view('load.show', compact('load'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $load = Load::findOrFail($id);
        $routes = Route::all();
        $truckTypes = TruckType::all();

        // Obtener la fecha y hora actuales
        $currentTime = now();

        // Verificar si han pasado menos de 24 horas desde la creación
        $createdAt = $load->created_at;
        $differenceInHours = $currentTime->diffInHours($createdAt);

        // Verificar si la fecha de la carga es anterior a la fecha y hora actuales
        $isPastDate = $load->date < $currentTime->format('Y-m-d');

        // Verificar si han pasado 24 horas desde la creación o si la fecha de la carga es anterior a la fecha actual
        if ($differenceInHours >= 24 || $isPastDate) {
            return redirect()->route('loads.index')
                             ->with('error', 'No puedes editar esta carga porque han pasado más de 24 horas desde su registro o la fecha de la carga ya ha pasado.');
        }

        return view('load.edit', compact('load', 'routes', 'truckTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Load $load)
    {
        $request->validate([
            'date' => 'required|date',
            'routes_id' => 'required|integer',
            'truck_types_id' => 'required|integer',
        ]);

        $load->update($request->all());

        return redirect()->route('loads.index')
                         ->with('success', 'Carga actualizada exitosamente.');
    }

    /**
     * Update the status of the load.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $load = Load::findOrFail($id);
        $load->enabled = $request->input('status');
        if ($load->enabled) {
            $load->disabled_at = now()->addHours(24);
        } else {
            $load->disabled_at = null;
        }
        $load->save();

        $action = $load->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->route('loads.index')->with('success', "La carga ha sido $action correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Load::findOrFail($id)->delete();

        return redirect()->route('loads.index')
                         ->with('success', 'Carga eliminada exitosamente');
    }
}
