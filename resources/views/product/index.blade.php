@extends('layouts.app')

@section('template_title')
Productos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <span id="card_title">
                        {{ __('Productos') }}
                    </span>
                    <div class="d-md-flex justify-content-between align-items-center">
                        <form action="{{ route('product.index') }}" method="GET">
                            <div class="btn-group">
                                <input class="form-control my-1" type="text" name="busqueda">
                                <input class="btn btn-primary my-1" type="submit" value="Buscar">
                            </div>
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

                    <div style="display: flex; justify-content: space-between; align-items: center;">

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
                                    @if(count($products)<=0) <tr>
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
                                                <form action="{{ route('product.update_status', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($product->enabled)
                                                    <button type="submit" class="btn btn-sm btn-warning" name="status" value="0"><i class="fa fa-fw fa-times"></i> Inhabilitar</button>
                                                    @else
                                                    <button type="submit" class="btn btn-sm btn-success" name="status" value="1"><i class="fa fa-fw fa-check"></i> Habilitar</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                @if ($product->enabled)
                                                <a class="btn btn-sm btn-success" href="{{ route('product.edit', $product->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                @else
                                                <button class="btn btn-sm btn-success" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</button>
                                                @endif
                                            </td>
                                        </tr>
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