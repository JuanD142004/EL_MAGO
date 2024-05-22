<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $sale->name ?? __("Show Sale") }}</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome from a CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h4 class="m-0">{{ __("Show Sale") }}</h4>
                            <a class="btn btn-primary mb-3 float-right" href="{{ route('sales.index') }}">
                                <i class="fas fa-chevron-left"></i> {{ __("Atrás") }}
                            </a>
                        </div>

                        <div class="card-body">
                            @if (!$sale->enabled)
                            <div class="alert alert-danger" role="alert">
                                {{ __("Esta venta está anulada.") }}
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>{{ __("Customer") }}</th>
                                            <td><strong>{{ $sale->customer->id }}</strong> - {{ $sale->customer->customer_name }}</td>
                                        </tr>

                                        <tr>
                                            <th>{{ __("Price Total") }}</th>
                                            <td>{{ $sale->price_total }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Payment Method") }}</th>
                                            <td>{{ $sale->payment_method }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-header bg-light">
                            <h4 class="m-0">{{ __('Details Sales') }}</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __("Product") }}</th>
                                            <th>{{ __("Amount") }}</th>
                                            <th>{{ __("Discount") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sale->detailsSales as $detailsSale)
                                        <tr>
                                            <td>{{ $detailsSale->product->product_name ?? 'N/A' }}</td>
                                            <td>{{ $detailsSale->amount }}</td>
                                            <td>{{ $detailsSale->discount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>