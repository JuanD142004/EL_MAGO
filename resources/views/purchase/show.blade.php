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
                            <strong>Suppliers Id:</strong>
                            {{ $purchase->suppliers_id }}
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
                </div>
            </div>
        </div>
    </section>
@endsection
