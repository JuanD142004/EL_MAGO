@extends('layouts.app')

@section('template_title')
    Details Sale
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Details Sale') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('details-sales.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        
										<th>Products Id</th>
										<th>Price Unit</th>
										<th>Amount</th>
										<th>Discount</th>
										<th>Sales Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailsSales as $detailsSale)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detailsSale->products_id }}</td>
											<td>{{ $detailsSale->price_unit }}</td>
											<td>{{ $detailsSale->amount }}</td>
											<td>{{ $detailsSale->discount }}</td>
											<td>{{ $detailsSale->sales_id }}</td>

                                            <td>
                                                <form action="{{ route('details-sales.destroy',$detailsSale->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('details-sales.show',$detailsSale->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('details-sales.edit',$detailsSale->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $detailsSales->links() !!}
            </div>
        </div>
    </div>
@endsection
