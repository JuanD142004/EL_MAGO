<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;
use App\Models\DetailsPurchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;


/**
 * Class PurchaseController
 * @package App\Http\Controllers
 */
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$purchases = Purchase::paginate();
       
        $search = trim($request->get('search'));
        $purchases = Purchase::with('Supplier')
            ->where('suppliers_id', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return view('purchase.index', compact('purchases'))
            ->with('i', (request()->input('page', 1) - 1) * $purchases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $purchase = new Purchase();
        $products = Product::all();
        $suppliers = Supplier::all();
        $detailsPurchase = new DetailsPurchase();
        return view('purchase.create', compact('purchase', 'detailsPurchase', 'products', 'suppliers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // Acceder a los datos enviados desde el formulario
        $datos = $request->input('data');

        // Crear una nueva compra
        $compra = new Purchase();
        $compra->sppliers_id = $datos['nombre_proveedor'];
        $compra->date = $datos['fecha'];
        $compra->total_value = $datos['ValorTotal'];
        $compra->num_bill = $datos['NumeroFactura'];
        $compra->save();


        // Recorrer los detalles de la compra y guardarlos en la base de datos
        foreach ($datos['detalles'] as $detalle) {
            $detalleCompra = new DetailsPurchase();
            $detalleCompra->products_id = $detalle['Producto'];
            $detalleCompra->purcahse_lot = $detalle['Lote'];
            $detalleCompra->amount = $detalle['Cantidad'];
            $detalleCompra->unit_value = $detalle['ValorUnitario'];
            $detalleCompra->purchases_id = $compra->id; // Asociar el detalle con la compra creada
            $detalleCompra->save();
        }

        // Retornar una respuesta de redirección
        return redirect()->route('purchases.index')
            ->with('success', 'Registro creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $purchase = Purchase::find($id);

        return view('purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);

        return view('purchase.edit', compact('purchase'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $purchase->update($request->validated());

        return redirect()->route('purchase.index')
            ->with('success', 'Purchase updated successfully');

    }
    public function annul($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->status = 'Anulado';
        $purchase->save();
    
        return redirect()->route('purchase.index')
                        ->with('success', 'Compra anulada correctamente');
    }
    

    public function destroy($id)
    {
        $purchase = Purchase::find($id);

        if ($purchase) {
            $purchase->delete();
            return redirect()->route('purchase.index')->with('success', 'Purchase deleted successfully');
        } else {
            return redirect()->route('purchase.index')->with('error', 'Purchase not found');

    }
}

}