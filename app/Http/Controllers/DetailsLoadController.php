<?php

namespace App\Http\Controllers;

use App\Models\DetailsLoad;
use App\Http\Requests\DetailsLoadRequest;
use App\Models\Product;
use App\Models\Load;

/**
 * Class DetailsLoadController
 * @package App\Http\Controllers
 */
class DetailsLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailsLoads = DetailsLoad::paginate();

        return view('details-load.index', compact('detailsLoads'))
            ->with('i', (request()->input('page', 1) - 1) * $detailsLoads->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
 * Show the form for creating a new resource.
 */
public function create()
{
    $detailsLoad = new DetailsLoad();
    $products = Product::all(); // Obtener todos los productos desde la base de datos
    $loads = Load::all(); 
    return view('details-load.create', compact('detailsLoad', 'products', 'loads'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(DetailsLoadRequest $request)
    {
        DetailsLoad::create($request->validated());

        return redirect()->route('details-loads.index')
            ->with('success', 'DetailsLoad created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detailsLoad = DetailsLoad::find($id);

        return view('details-load.show', compact('detailsLoad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detailsLoad = DetailsLoad::find($id);

        return view('details-load.edit', compact('detailsLoad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetailsLoadRequest $request, DetailsLoad $detailsLoad)
    {
        $detailsLoad->update($request->validated());

        return redirect()->route('details-loads.index')
            ->with('success', 'DetailsLoad updated successfully');
    }
    

    public function destroy($id)
    {
        DetailsLoad::find($id)->delete();

        return redirect()->route('details-loads.index')
            ->with('success', 'DetailsLoad deleted successfully');
    }
}
