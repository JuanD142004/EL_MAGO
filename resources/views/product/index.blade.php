@extends('layouts.app')

@section('template_title')
    Productos
    
@endsection
<link href="/path/to/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
<style>
    @font-face {
        font-family: Metropolis-Bold;
        src: url('{{ URL::asset("fonts/Metropolis-Bold.tff") }}');
    }
</style>
<br>
<div class="container-fluid">
   <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span id="card_title">
                        {{ __('Productos') }}
                    </span>
                    <div class="float-right">
                        <a href="{{ route('product.create') }}" class="btn btn-dark text-white btn-sm float-right" data-placement="left">
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
                        <table id="myTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nombre del Producto</th>
                                    <th>Marca</th>
                                    <th>Precio unitario</th>
                                    <th>Unidad de medida</th>
                                    <th>Proveedores Id</th>
                                    <th>Estado Id</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($products) <= 0)
                                <tr>
                                    <td colspan="4">No hay resultados</td>
                                </tr>
                                @else
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->price_unit }}</td>
                                    <td>{{ $product->unit_of_measurement }}</td>
                                    <td>{{ $product->supplier->supplier_name }}</td>
                                    <td>
                                        <form id="toggle-form-{{ $product->id }}" action="{{ route('product.update_status', $product->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn btn-sm {{ $product->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleSaleStatus({{ $product->id }}, {{ $product->enabled ? 0 : 1 }})">
                                                <i class="fa fa-fw {{ $product->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $product->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                            </button>
                                            <input type="hidden" name="status" value="{{ $product->enabled ? 0 : 1 }}">
                                        </form>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm {{ $product->enabled ? 'btn-success' : 'btn-secondary' }}" href="{{ route('product.edit', $product->id) }}" {{ $product->enabled ? '' : 'disabled' }}>
                                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">{{$products->appends(['busqueda'=>$busqueda])}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            {!! $products->links() !!}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

    function toggleSaleStatus(productId, status) {
        var form = document.getElementById('toggle-form-' + productId);
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
