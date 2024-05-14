@extends('layouts.app')

@section('template_title')
    Supplier
@endsection

@section('content')
@include('barra.index')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    @font-face {
        font-family: Metropolis-Bold;
        src: url('{{ URL::asset("fonts/Metropolis-Bold.tff") }}');
    }
</style>

<div class="container-fluid">
    <div class="row">
        <br>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header ">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Supplier') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Crear Nuevo') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="myTable" style="width:100%">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nit</th>
                                        <th>Nombre del Proveedor</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($suppliers)<=0)
                                    <tr>
                                        <td colspan="5">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id}}</td>
                                        <td>{{ $supplier->nit }}</td>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ $supplier->cell_phone }}</td>
                                        <td>{{ $supplier->mail }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>
                                            <form id="toggle-form-{{ $supplier->id }}" action="{{ route('supplier.update_status', $supplier->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="btn btn-sm {{ $supplier->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleSaleStatus({{ $supplier->id }}, {{ $supplier->enabled ? 0 : 1 }})">
                                                    <i class="fa fa-fw {{ $supplier->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $supplier->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                                </button>
                                                <input type="hidden" name="status" value="{{ $supplier->enabled ? 0 : 1 }}">
                                            </form>
                                        </td>
                                        <td>
                                            @if ($supplier->enabled)
                                            <a class="btn btn-sm btn-success" href="{{ route('supplier.edit', $supplier->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                            @else
                                            <button class="btn btn-sm btn-success" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</button>
                                            @endif
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
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/app.js') }}" defer></script>









<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive:true,
             language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
        });

    function toggleSaleStatus(supplierId, status) {
        var form = document.getElementById('toggle-form-' + supplierId);
        var action = status ? 'habilitar' : 'inhabilitar';

        Swal.fire({
            title: '¿Estás seguro?',
            text: `Esta acción cambiará el estado del proveedor a ${status ? 'habilitado' : 'inhabilitado'}!`,
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
    };

   
        
</script>

@endsection
