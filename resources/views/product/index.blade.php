@extends('layouts.app')

@section('template_title')
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title mb-0">
                            {{ __('Productos') }}
                        </h1>
                        <div class="d-md-flex justify-content-between align-items-center">
                            <form action="{{ route('product.index') }}" method="GET">
                            </form>
                            @if (!empty($busqueda))
                                <div>
                                    <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm">
                                        {{ __('Volver al índice') }}
                                    </a>
                                </div>
                            @endif
                            <div class="float-right">
                                <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm float-right" data-placement="right">
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
                                            <td colspan="5">No hay resultados</td>
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
                                        <td colspan="4">{{$products->appends(['busqueda'=>$busqueda])}}</td>
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
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
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
</script
