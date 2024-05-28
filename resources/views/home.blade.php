@extends('layouts.app')

@section('content')
<br>
<link rel="stylesheet" href="{{asset('css/dashboard/sb-admin-2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/dashboard/sb-admin-2.css')}}">
<title>Inicio</title>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Panel Administrativo') }}</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Proveedor con más compras</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-user-group fa-2xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total de Ventas Hoy</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-sack-dollar fa-2xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ventas Realizadas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Compras Realizadas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-money-check-dollar fa-2xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Compras Proveedores</h3>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Proveedor</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Proveedor A</td>
                                        <td>2024-05-27</td>
                                        <td>$1000</td>
                                        <td>Producto X</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>Proveedor B</td>
                                        <td>2024-05-26</td>
                                        <td>$1500</td>
                                        <td>Producto Y</td>
                                        <td>15</td>
                                    </tr>
                                    <tr>
                                        <td>Proveedor C</td>
                                        <td>2024-05-25</td>
                                        <td>$2000</td>
                                        <td>Producto Z</td>
                                        <td>20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h3>Ventas Realizadas</h3>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cliente A</td>
                                        <td>2024-05-27</td>
                                        <td>$2000</td>
                                        <td>Producto X</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>Cliente B</td>
                                        <td>2024-05-26</td>
                                        <td>$2500</td>
                                        <td>Producto Y</td>
                                        <td>8</td>
                                    </tr>
                                    <tr>
                                        <td>Cliente C</td>
                                        <td>2024-05-25</td>
                                        <td>$3000</td>
                                        <td>Producto Z</td>
                                        <td>10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection