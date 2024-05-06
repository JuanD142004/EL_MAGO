@extends('layouts.app')

@section('template_title')
    Customer
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Clientes') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('customer.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Cliente') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-header ">
                     <form action="{{route('customer.index')}}" method="GET">
                         <div class="btn-group">
                            <input type="text" name="busqueda" class="from-control my-2">
                            <input type="submit" value="Enviar" class="btn btn-primary my-2" >
                         </div>
                     </form>
                  </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre del cliente</th>
                                        <th>Nombre de la empresa</th>
                                        <th>Ubicacion</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
                                        <th>Id Ruta</th> <!-- Cambiado de Routes Id a Route Name -->
                                        <th>Estado del cliente</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($customers)<=0)
                                        <tr>
                                            <td colspan="5">No hay resultados</td>
                                        </tr>
                                @else
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id}}</td>
                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customer->company_name }}</td>
                                            <td>{{ $customer->location }}</td>
                                            <td>{{ $customer->cell_phone }}</td>
                                            <td>{{ $customer->mail }}</td>
                                            <td>{{ $customer->route->route_name }}</td> <!-- Accede al nombre de la ruta a través de la relación -->
                                            <td> 
                                                @if($customer->enabled)
                                                    <form id="disableForm{{ $customer->id }}" action="{{ route('customer.disable', $customer->id) }}" method="POST" style="display: inline;">
                                                        @method('PUT')
                                                        @csrf
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDisable({{ $customer->id }})">Inhabilitar</button>
                                                    </form>
                                                @else
                                                    <form id="enableForm{{ $customer->id }}" action="{{ route('customer.enable', $customer->id) }}" method="POST" style="display: inline;">
                                                        @method('PUT')
                                                        @csrf
                                                        <button type="button" class="btn btn-success btn-sm" onclick="confirmEnable({{ $customer->id }})">Habilitar</button>
                                                    </form>
                                                @endif

                                                <script>
                                                    function confirmDisable(customerId) {
                                                        if (confirm('¿Estás seguro de inhabilitar a este cliente?')) {
                                                            document.getElementById('disableForm' + customerId).submit();
                                                        }
                                                    }

                                                    function confirmEnable(customerId) {
                                                        if (confirm('¿Estás seguro de habilitar a este cliente?')) {
                                                            document.getElementById('enableForm' + customerId).submit();
                                                        }
                                                    }
                                                </script>

                                            </td>
                                            <td>
                                                <form action="{{ route('customer.destroy',$customer->id) }}" method="POST">
                                                    @if($customer->enabled)
                                                        
                                                        <a class="btn btn-sm btn-success" href="{{ route('customer.edit',$customer->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success disabled" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</button>
                                                     @endif
                                                     
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                <td colspan="4">{{$customers->appends(['busqueda'=>$busqueda])}}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $customers->links() !!}
            </div>
        </div>
    </div>
@endsection
