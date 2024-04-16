<?php

namespace App\Http\Controllers;

use App\Models\TruckType;
use App\Http\Requests\TruckTypeRequest;

/**
 * Class TruckTypeController
 * @package App\Http\Controllers
 */
class TruckTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $truckTypes = TruckType::paginate();

        return view('truck-type.index', compact('truckTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $truckTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $truckType = new TruckType();
        return view('truck-type.create', compact('truckType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TruckTypeRequest $request)
    {
        TruckType::create($request->validated());

        return redirect()->route('truck-types.index')
            ->with('success', 'TruckType created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $truckType = TruckType::find($id);

        return view('truck-type.show', compact('truckType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $truckType = TruckType::find($id);

        return view('truck-type.edit', compact('truckType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TruckTypeRequest $request, TruckType $truckType)
    {
        $truckType->update($request->validated());

        return redirect()->route('truck-types.index')
            ->with('success', 'TruckType updated successfully');
    }

    public function destroy($id)
    {
        TruckType::find($id)->delete();

        return redirect()->route('truck-types.index')
            ->with('success', 'TruckType deleted successfully');
    }
}
