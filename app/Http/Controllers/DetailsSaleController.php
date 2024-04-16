<?php

namespace App\Http\Controllers;

use App\Models\DetailsSale;
use Illuminate\Http\Request;

/**
 * Class DetailsSaleController
 * @package App\Http\Controllers
 */
class DetailsSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailsSales = DetailsSale::paginate();

        return view('details-sale.index', compact('detailsSales'))
            ->with('i', (request()->input('page', 1) - 1) * $detailsSales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detailsSale = new DetailsSale();
        return view('details-sale.create', compact('detailsSale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetailsSale::$rules);

        $detailsSale = DetailsSale::create($request->all());

        return redirect()->route('details-sales.index')
            ->with('success', 'DetailsSale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailsSale = DetailsSale::find($id);

        return view('details-sale.show', compact('detailsSale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detailsSale = DetailsSale::find($id);

        return view('details-sale.edit', compact('detailsSale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetailsSale $detailsSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailsSale $detailsSale)
    {
        request()->validate(DetailsSale::$rules);

        $detailsSale->update($request->all());

        return redirect()->route('details-sales.index')
            ->with('success', 'DetailsSale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detailsSale = DetailsSale::find($id)->delete();

        return redirect()->route('details-sales.index')
            ->with('success', 'DetailsSale deleted successfully');
    }
}
