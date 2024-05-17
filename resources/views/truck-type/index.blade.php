
@extends('layouts.app')

@section('template_title')
    Tipo de Camión
@endsection

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
<style>
    body, input, select, label, button {
        font-family: sans-serif;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Tipo de Camión') }}
                        </span>

                        <div class="float-right">
                                <a href="{{ route('truck_type.create') }}" class="btn btn-dark text-white btn-sm float-right" data-placement="left" >
                                    <i class="fas fa-plus"></i> {{ __('Crear Nuevo') }}
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
                        <table class="table table-striped table-hover" id="myTable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Tipo de Camión</th>
                                    <th>Placa</th>
                                    <th>Capacidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($truckTypes) <= 0)
                                    <tr>
                                        <td colspan="6">No hay resultados</td>
                                    </tr>
                                @else
                                    @foreach ($truckTypes as $truckType)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $truckType->truck_brand }}</td>
                                            <td>{{ $truckType->plate }}</td>
                                            <td>{{ $truckType->ability }}</td>
                                            <td>
                                                <form id="toggle-form-{{ $truckType->id }}" action="{{ route('truck_type.update_status', $truckType) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="button" class="btn btn-sm {{ $truckType->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleSaleStatus({{ $truckType->id }}, {{ $truckType->enabled ? 0 : 1 }})">
                                                        <i class="fa fa-fw {{ $truckType->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $truckType->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                                    </button>
                                                    <input type="hidden" name="status" value="{{ $truckType->enabled ? 0 : 1 }}">
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('truck_type.destroy', $truckType->id) }}" method="POST">
                                                    @if($truckType->enabled)
                                                        <a class="btn btn-sm btn-success" href="{{ route('truck_type.edit', $truckType->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success disabled" disabled>
                                                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                        </button>
                                                    @endif
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js"></script>
    


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
        function toggleSaleStatus(truckTypeId, status) {
        var form = document.getElementById('toggle-form-' + truckTypeId);
        var action = status ? 'habilitar' : 'inhabilitar';

        Swal.fire({
            title: '¿Estás seguro?',
            text: `Esta acción cambiará el estado del Camión a ${status ? 'habilitado' : 'inhabilitado'}.`,
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
