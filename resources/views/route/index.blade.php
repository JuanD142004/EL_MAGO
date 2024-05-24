@extends('layouts.app')

@section('template_title')
    Route
@endsection

@section('content')
<br>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-12">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Rutas') }}
                            </span>
                            <div class="float-end">
                                <a href="{{ route('route.create') }}" class="btn btn-dark text-white btn-sm" data-placement="left">
                                    <i class="fas fa-plus"></i> {{ __('Crear Nuevo') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="routetable" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Nombre de la Ruta</th>
                                    <th>Departamento</th>
                                    <th>Municipios</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($routes as $route)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $route->route_name }}</td>
                                        <td>{{ $route->departament->name }}</td>
                                        <td>
                                            <div style="display: flex;">
                                                <ul style="flex-grow: 1; margin-bottom: 0;">
                                                    @if(is_array($route->municipalities))
                                                        @foreach ($route->municipalities as $municipality)
                                                            <li>{{ $municipality }}</li>
                                                        @endforeach
                                                    @else
                                                        <li>No municipalities</li>
                                                    @endif
                                                </ul>
                                                <form id="toggle-form-{{ $route->id }}" action="{{ route('update_status', $route->id) }}" method="POST" style="margin-left: 1px;">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($route->enabled)
                                                        <button type="button" class="btn btn-sm btn-warning" onclick="toggleSaleStatus({{ $route->id }}, false)"><i class="fa fa-fw fa-times"></i> Inhabilitar</button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success" onclick="toggleSaleStatus({{ $route->id }}, true)"><i class="fa fa-fw fa-check"></i> Habilitar</button>
                                                    @endif
                                                    <input type="hidden" name="status" value="{{ $route->enabled ? '0' : '1' }}">
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($route->enabled)
                                                <a class="btn btn-sm btn-success" href="{{ route('route.edit', $route->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                            @else
                                                <button class="btn btn-sm btn-success" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    function toggleSaleStatus(routeId, status) {
                        var form = document.getElementById('toggle-form-' + routeId);
                        var action = status ? 'habilitar' : 'inhabilitar';
                    
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: `¡Esta acción cambiará el estado del producto a ${status ? 'habilitado' : 'inhabilitado'}!`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: `Sí, ${action}`,
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    }
                    </script>
                    @endsection