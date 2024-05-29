<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Route;
use App\Models\TruckType;
use App\Models\DetailsLoad;
use Illuminate\Http\Request;
use App\Models\Product;

class LoadController extends Controller
{
    public function index()
    {
        $loads = Load::with('detailsLoads')->paginate();

        return view('load.index', compact('loads'))
            ->with('i', (request()->input('page', 1) - 1) * $loads->perPage());
    }

    public function create()
    {
        $currentLoad = Load::latest()->first(); 
        $load = new Load();
        $routes = Route::all();
        $truckTypes = TruckType::all();
        $products = Product::all();
        $detailsLoad = DetailsLoad::all(); 

        return view('load.create', compact('currentLoad', 'load', 'routes', 'truckTypes', 'detailsLoad', 'products'));
    }

    public function store(Request $request)
    {
        try {
            // Obtener los datos enviados desde el formulario
            $data = $request->input('data');

            // Crear una nueva venta
            $load = new Load();
            $load->id = $data['id'];
            $load->date = $data['date'];
            $load->routes_id = $data['routes_id'];
            $load->truck_types_id = $data['truck_types_id'];
            $load->enabled = true; // Marcar la venta como habilitada
            $load->save();

            // Recorrer y guardar los detalles de la venta en la base de datos
            foreach ($data['detalles'] as $detalle) {
                $detalleCarga = new DetailsLoad();
                $detalleCarga->id = $detalle['id'];
                $detalleCarga->amount = $detalle['amount'];
                $detalleCarga->products_id = $detalle['products_id']; // Valor predeterminado de descuento
                $detalleCarga->loads_id = $detalle['loads_id'];
                $detalleCarga->load_id = $load->id; // Asociar el detalle con la venta creada
                $detalleCarga->save();
            }

            // Retornar una respuesta de éxito
            return redirect()->route('load.index')->with('success', 'Venta  creada exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier excepción que ocurra durante el proceso
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $load = Load::findOrFail($id);
        $routes = Route::all();
        $truckTypes = TruckType::all();
        $detailsLoads = DetailsLoad::where('loads_id', $id)->get();

        $currentTime = now();
        $createdAt = $load->created_at;
        $differenceInHours = $currentTime->diffInHours($createdAt);
        $isPastDate = $load->date < $currentTime->format('Y-m-d');

        if ($differenceInHours >= 24 || $isPastDate) {
            return redirect()->route('loads.index')
                             ->with('error', 'No puedes editar esta carga porque han pasado más de 24 horas desde su registro o la fecha de la carga ya ha pasado.');
        }

        return view('load.edit', compact('load', 'routes', 'truckTypes', 'detailsLoads'));
    }

    public function update(Request $request, Load $load)
    {
        $request->validate([
            'date' => 'required|date',
            'routes_id' => 'required|integer',
            'truck_types_id' => 'required|integer',
            'details_loads' => 'required|array',
            'details_loads.*.amount' => 'required|numeric',
            'details_loads.*.products_id' => 'required|integer',
        ]);

        foreach ($request->input('details_loads') as $key => $detail) {
            $request->merge([
                "details_loads.$key.amount" => is_array($detail['amount']) ? '' : (string)$detail['amount'],
                "details_loads.$key.products_id" => is_array($detail['products_id']) ? '' : (string)$detail['products_id'],
            ]);
        }

        $load->update($request->all());

        $load->detailsLoads()->delete();

        foreach ($request->input('details_loads') as $detail) {
            $detailLoad = new DetailsLoad();
            $detailLoad->amount = $detail['amount'];
            $detailLoad->products_id = $detail['products_id'];
            $detailLoad->loads_id = $load->id;
            $detailLoad->save();
        }

        return redirect()->route('loads.index')->with('success', 'Carga actualizada exitosamente.');
    }

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

    public function destroy($id)
    {
        Load::findOrFail($id)->delete();

        return redirect()->route('loads.index')
                         ->with('success', 'Carga eliminada exitosamente');
    }

    public function show($id)
{
    $load = Load::findOrFail($id);
    
    return view('load.show', compact('load'));
}

}


