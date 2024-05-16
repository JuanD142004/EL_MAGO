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
    public function store(PurchaseRequest $request)
    {
        Purchase::create($request->validated());

        return redirect()->route('purchase.index')
            ->with('success', 'Purchase created successfully.');
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
    public function updateStatus(Request $request, $id)
    {
                $request->validate([
                    'status' => 'required|boolean', // Asegura que 'status' sea un valor booleano
                ]);
        
                $purchase = Purchase::findOrFail($id);
                $purchase->enabled = $request->input('status');
                $purchase->save();
        
                $action = $purchase->enabled ? 'habilitado' : 'inhabilitado';
        
                return redirect()->back()->with('success', "El proveedor ha sido $action correctamente.");
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