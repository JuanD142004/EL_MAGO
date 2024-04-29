@extends('layouts.app')

@section('template_title')
    Supplier
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
        
        <br>
            <div class="col-sm-12">
                <div class="card">
                <div class="card-header ">
                     <form action="{{route('supplier.index')}}" method="GET">
                         <div class="btn-group">
                            <input type="text" name="busqueda" class="from-control my-2">
                            <input type="submit" value="Buscar" class="btn btn-primary my-2" >
                            
                         </div>
                         <div>
                            @if (!empty($busqueda))
                                        <div>
                                            <a href="{{ route('supplier.index') }}" class="btn btn-primary btn-sm">
                                                {{ __('Volver al índice') }}
                                            </a>
                                        </div>
                                    @endif
                          </div>
                     </form>
                  </div>
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Supplier') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nit</th>
										<th>Supplier Name</th>
										<th>Cell Phone</th>
										<th>Mail</th>
										<th>Address</th>
                                        <th>status</th>


                                        <th></th>
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
                                                <form action="{{ route('supplier.update_status', $supplier->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($supplier->enabled)
                                                        <button type="submit" class="btn btn-sm btn-warning" name="status" value="0"><i class="fa fa-fw fa-times"></i> Inhabilitar</button>
                                                    @else
                                                        <button type="submit" class="btn btn-sm btn-success" name="status" value="1"><i class="fa fa-fw fa-check"></i> Habilitar</button>

                                                    @endif
                                                    
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
                                <tfoot>
                                <tr>
                                <td colspan="4">{{$suppliers->appends(['busqueda'=>$busqueda])}}</td>
                                </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                    </div>
                </div>
                {!! $suppliers->Links() !!}
            </div>
        </div>
    </div>
@endsection
