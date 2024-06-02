@extends('layouts.app')

@section('template_title')
    Customer
@endsection


@section('content')
<!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<br>
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
                                  <i class="fas fa-plus"></i>  {{ __('Crear Cliente') }}
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
                            <table  id="myTable" class="table table-striped table-hover">

                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre del cliente</th>
                                        <th>Nombre de la empresa</th>
                                        <th>Dirección</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
                                        <th>Id Ruta</th> <!-- Cambiado de Routes Id a Route Name -->
                                        <th>Estado del cliente</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                              <form id="toggle-form-{{ $customer->id }}" action="{{ route('customer.update_status', $customer) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="btn btn-sm {{ $customer->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleSaleStatus({{ $customer->id }}, {{ $customer->enabled ? 0 : 1 }})">
                                                            <i class="fa fa-fw {{ $customer->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $customer->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                                        </button>
                                                        <input type="hidden" name="status" value="{{ $customer->enabled ? 0 : 1 }}">
                                                    </form>
                                                </td>

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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>



    <script>
        $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        });
    });

    function toggleSaleStatus(customerId, status) {
        var form = document.getElementById('toggle-form-' + customerId);
        var action = status ? 'habilitar' : 'inhabilitar';

        Swal.fire({
            title: '¿Estás seguro?',
            text: `Esta acción cambiará el estado del cliente a ${status ? 'habilitado' : 'inhabilitado'}.`,
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