<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Departament;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Requests\RouteRequest;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $routes = Route::where('route_name', 'LIKE', '%' . $busqueda . '%')
                            ->orderBy('id', 'asc')
                            ->paginate(10);
    
        return view('route.index', compact('routes', 'busqueda'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $routes = new Route();
    $departaments = Departament::all();
    // $municipalities = Municipality::all(); // Agrega esta línea para obtener la lista de municipios
    return view('route.create', compact('routes', 'departaments'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      
        $request->validate([
            'route_name' => 'required|string|max:255',
            'departament_id' => 'required|integer',
            'municipalities' => 'required',
        ]);
    
        Route::create([
            'route_name' => $request->route_name,
            'departament_id' => $request->departament_id,
            'municipalities' => $request->municipalities,
        ]);
        return redirect()->route('route.index')
            ->with('success', 'Route created successfully.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $route = Route::find($id);

        return view('route.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $route = Route::find($id);
        $departaments = Departament::all();
        return view('route.edit', compact('route','departaments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RouteRequest $request, Route $route)
    {
        $route->update($request->validated());

        return redirect()->route('route.index')
            ->with('success', 'Route updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Route::find($id)->delete();

        return redirect()->route('route.index')
            ->with('success', 'Route deleted successfully');
    }





}
