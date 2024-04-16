@extends('layouts.app')

@section('template_title')
    {{ $sale->name ?? "{{ __('Show') Sale" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Sale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sales.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Customers Id:</strong>
                            {{ $sale->customers_id }}
                        </div>
                        <div class="form-group">
                            <strong>Price Total:</strong>
                            {{ $sale->price_total }}
                        </div>
                        <div class="form-group">
                            <strong>Payment Method:</strong>
                            {{ $sale->payment_method }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
