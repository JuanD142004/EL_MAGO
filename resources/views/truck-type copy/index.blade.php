@extends('layouts.app')

@section('template_title')
    Tipo de Camión
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <div class="card-header ">
                     <form action="{{route('truck_type.index')}}" method="GET">
                         <div class="btn-group">
                            <input type="text" name="busqueda" class="from-control my-2">
                            <input type="submit" value="Buscar" class="btn btn-primary my-2" >
                         </div>
                     </form>
                  </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Tipo de Camión') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('truck_type.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Tipo de Camión</th>
                                        <th>Placa</th>
                                        <th>Capacidad</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                @if(count($truckTypes)<=0)
                                        <tr>
                                            <td colspan="5">No hay resultados</td>
                                        </tr>
                                @else
                                    @foreach ($truckTypes as $truckType)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $truckType->truck_brand }}</td>
                                            <td>{{ $truckType->plate }}</td>
                                            <td>{{ $truckType->ability }}</td>
                                            <td>
                                                <form action="{{ route('update_status', $truckType->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($truckType->enabled)
                                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('¿Está seguro de que desea inhabilitar este tipo de camión?')" name="status" value="0"><i class="fa fa-fw fa-times"></i> Inhabilitar</button>
                                                    @else
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('¿Está seguro de que desea habilitar este tipo de camión?')" name="status" value="1"><i class="fa fa-fw fa-check"></i> Habilitar</button>
                                                    @endif
                                                </form>
                                                
                                            </td>
                                            <td>
                                                @if ($truckType->enabled)
                                                    <a class="btn btn-sm btn-success" href="{{ route('truck_type.edit', $truckType->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                @else
                                                    <button class="btn btn-sm btn-success" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                <td colspan="4">{{$truckTypes->appends(['busqueda'=>$busqueda])}}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $truckTypes->links() !!}
            </div>
        </div>
    </div>
@endsection
