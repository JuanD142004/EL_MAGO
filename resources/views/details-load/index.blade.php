@extends('layouts.app')

@section('template_title')
    Details Load
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Details Load') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('details_load.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        
										<th>Amount</th>
										<th>Products Id</th>
										<th>Loads Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailsLoads as $detailsLoad)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detailsLoad->amount }}</td>
											<td>{{ $detailsLoad->product->product_name }}</td>
											<td>{{ $detailsLoad->loads_id }}</td>

                                            <td>
                                                <form action="{{ route('details_loads.destroy',$detailsLoad->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('details_load.show',$detailsLoad->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('details_load.edit',$detailsLoad->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detailsLoads->links() !!}
            </div>
        </div>
    </div>
@endsection
