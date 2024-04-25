<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
/**
 * Class SupplierController
 * @package App\Http\Controllers
 */
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busqueda = $request ->busqueda;
        $suppliers = Supplier:: where('supplier_name','LIKE','%' .$busqueda.'%')
        ->orwhere('nit','LIKE','%' .$busqueda)
        ->orderBy('id', 'asc')
        ->paginate(10);

        $data = [
            'supplier'=>$suppliers,
            'busqueda'=>$busqueda,

        ];

      

        return view('supplier.index', compact('suppliers','busqueda'))
            ->with('i', (request()->input('page', 1) - 1) * $suppliers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = new Supplier();
        return view('supplier.create', compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Supplier::$rules);

        $supplier = Supplier::create($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        request()->validate(Supplier::$rules);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Proveedor actualizado con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->enabled = $request->input('status');
        $supplier->save();
    
        return redirect()->back()->with('success', 'Proveedor se actualizó con éxito.');
    }
    
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id)->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier deleted successfully');
    }
}
