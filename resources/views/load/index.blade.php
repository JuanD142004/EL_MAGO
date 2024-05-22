@extends('layouts.app')

@section('template_title')
    Carga
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Carga') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('load.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Fecha</th>
										<th>ID de Producto</th>
										<th>Cantidad</th>
										<th>ID de Ruta</th>
										<th>ID de Tipo de Camión</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loads as $load)
                                        <tr>
                                            <td>{{ $load->id }}</td>
                            
											<td>{{ $load->date }}</td>
											<td>{{ $load->product_id}}</td>
											<td>{{ $load->amount }}</td>
											<td>{{ $load->route->route_name }}</td>
                                            <td>{{ $load->truckType->truck_brand }}</td>


                                            <td>
                                                <form action="{{ route('load.destroy',$load->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('load.show',$load->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('load.edit',$load->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $loads->links() !!}
            </div>
        </div>
    </div>
@endsection
