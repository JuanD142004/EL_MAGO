@extends('layouts.app')

@section('template_title')
    {{ $load->name ?? __('Show') . " " . __('Load') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Load</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-dark btn-sm" href="{{ route('loads.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group mb-2">
                            <strong>Date:</strong>
                            {{ $load->date }}
                        </div>
                        <div class="form-group mb-2">
                            <strong>Route Name:</strong>
                            {{ $load->route->route_name ?? 'N/A' }}
                        </div>
                        <div class="form-group mb-2">
                            <strong>Truck Type:</strong>
                            {{ $load->truckType->truck_brand ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agrega un margen inferior entre las secciones -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Details Load') }}</span>
                        </div>
                       
                    </div>

                    <div class="card-body bg-white">
                        @forelse ($load->detailsLoads as $detail)
                            <div class="form-group mb-2">
                                <strong>Amount:</strong>
                                {{ $detail->amount }}
                            </div>
                            <div class="form-group mb-2">
                                <strong>Product Name:</strong>
                                {{ $detail->product->product_name ?? 'N/A' }}
                            </div>

                            <div class="form-group mb-2">
                                <strong>Loads Id:</strong>
                                {{ $detail->loads_id }}
                            </div>
                        @empty
                            <p>No hay detalles para esta carga.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
