@extends('layouts.app')

@section('template_title')
{{ $purchase->name ?? __('Show') . " " . __('Purchase') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Purchase</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('purchase.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Supplier Name:</strong>
                        {{ $purchase->supplier->supplier_name }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Date:</strong>
                        {{ $purchase->date }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Total Value:</strong>
                        {{ $purchase->total_value }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Num Bill:</strong>
                        {{ $purchase->num_bill }}
                    </div>

                </div>

                @if(isset($detailsPurchases))
                <div class="card-body bg-white">
                    @foreach($detailsPurchases as $detailsPurchase)
                    <div class="form-group mb-2 mb20">
                        <strong>Product Name:</strong>
                        {{ $detailsPurchase->product->product_name }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Purchase Lot:</strong>
                        {{ $detailsPurchase->purchase_lot }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Amount:</strong>
                        {{ $detailsPurchase->amount }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Unit Value:</strong>
                        {{ $detailsPurchase->unit_value }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Purchases Id:</strong>
                        {{ $detailsPurchase->purchases_id }}
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection