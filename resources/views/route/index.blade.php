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
                        <table id="route-table" class="table table-striped table-hover">
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
                                            <ul>
                                                @if(is_array($route->municipalities))
                                                    @foreach ($route->municipalities as $municipality)
                                                        <li>{{ $municipality }}</li>
                                                    @endforeach
                                                @else
                                                    <li>No municipalities</li>
                                                @endif
                                            </ul>
                                        </td>
                                        <td>
                                            <form action="{{ route('route.destroy', $route->id) }}" method="POST">
                                                <a class="btn btn-primary btn-sm" href="{{ route('route.show', $route->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-success btn-sm" href="{{ route('route.edit', $route->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


