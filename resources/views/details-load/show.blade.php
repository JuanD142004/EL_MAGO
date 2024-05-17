@extends('layouts.app')

@section('template_title')
    {{ $detailsLoad->name ?? __('Show') . " " . __('Details Load') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Details Load</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('details-loads.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Amount:</strong>
                            {{ $detailsLoad->amount }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Products Id:</strong>
                            {{ $detailsLoad->products_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Loads Id:</strong>
                            {{ $detailsLoad->loads_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
