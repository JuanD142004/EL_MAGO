@extends('layouts.app')

@section('template_title')
    Details Purchase
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Details Purchase') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('details_purchase.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Product Name</th>
                                        <th>Purchase Lot</th>
                                        <th>Amount</th>
                                        <th>Unit Value</th>
                                        <th>Purchases Id</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailsPurchases as $detailsPurchase)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $detailsPurchase->product->product_name }}</td>
                                            <td>{{ $detailsPurchase->purchase_lot }}</td>
                                            <td>{{ $detailsPurchase->amount }}</td>
                                            <td>{{ $detailsPurchase->unit_value }}</td>
                                            <td>{{ $detailsPurchase->purchases_id }}</td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detailsPurchases->links() !!}
            </div>
        </div>
    </div>
@endsection
