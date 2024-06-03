@extends('layouts.app')

@section('template_title')
{{ $load->name ?? __('Show') . " " . __('Load') }}
@endsection

@section('content')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
    .card {
        width: 100%;
        margin: auto;
    }

    .card-header h4 {
        font-size: 1.5rem;
    }

    .btn-primary {
        font-size: 1.2rem;
    }

    .table th,
    .table td {
        font-size: 1.1rem;
    }

    .alert {
        font-size: 1.1rem;
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeeba;
    }

    h5 {
        font-size: 1.3rem;
    }

    .details-table-container {
        margin-top: 20px;
    }

    .table-details th,
    .table-details td {
        padding: 15px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h4 class="m-0">{{ __('Detalle') }} De carga</h4>
                    <a class="btn btn-dark btn-sm" href="{{ route('loads.index') }}" style="background-color: #00008B;"><i class="fas fa-arrow-left"></i> {{ __('Volver') }}</a>
                </div>

                <div class="card-body bg-white">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Date</th>
                                            <td>{{ $load->date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Route Name</th>
                                            <td>{{ $load->route->route_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Truck Type</th>
                                            <td>{{ $load->truckType->truck_brand ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Product Name</th>
                                            <th>Loads Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($load->detailsLoads as $detail)
                                        <tr>
                                            <td>{{ $detail->amount }}</td>
                                            <td>{{ $detail->product->product_name ?? 'N/A' }}</td>
                                            <td>{{ $detail->loads_id }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3">No hay detalles para esta carga.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection