<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>

    <!-- Agrega el CSS de flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>

<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="date" class="form-label">{{ __('Fecha') }}</label>
            <input type="text" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', optional($load)->date ? $load->date->format('Y-m-d') : '') }}" id="date" placeholder="Fecha">
            {!! $errors->first('date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="products_id" class="form-label">{{ __('ID de Producto') }}</label>
            <select name="products_id" class="form-control @error('products_id') is-invalid @enderror" id="products_id">
                <option value="">Selecciona el producto</option>
                    @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('products_id', optional($load)->products_id) == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                    @endforeach
            </select>

            {!! $errors->first('products_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="amount" class="form-label">{{ __('Cantidad') }}</label>
            <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $load?->amount) }}" id="amount" placeholder="Cantidad">
            {!! $errors->first('amount', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="routes_id" class="form-label">{{ __('ID de Ruta') }}</label>
           <select name="routes_id" class="form-control @error('routes_id') is-invalid @enderror" id="routes_id">
                <option value="">Selecciona la ruta</option>
                    @foreach($routes as $route)
                <option value="{{ $route->id }}" {{ old('routes_id', optional($load)->routes_id) == $route->id ? 'selected' : '' }}>{{ $route->route_name }}</option>
                    @endforeach
            </select>
            {!! $errors->first('routes_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="truck_types_id" class="form-label">{{ __('ID de Tipo de Camión') }}</label>
           <select name="truck_types_id" class="form-control @error('truck_types_id') is-invalid @enderror" id="truck_types_id">
                <option value="">Selecciona el tipo de camión</option>
                    @foreach($truckTypes as $truckType)
                <option value="{{ $truckType->id }}" {{ old('truck_types_id', $load->truck_types_id) == $truckType->id ? 'selected' : '' }}>
                    {{ $truckType->truck_brand }}
                </option>
                     @endforeach
            </select>
            {!! $errors->first('truck_types_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
<!-- Agrega el JavaScript de flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Inicializa flatpickr -->
<script>
    flatpickr('#date', {
        dateFormat: 'Y-m-d', // Formato de fecha deseado
        minDate: 'today', // Solo permite seleccionar a partir de hoy
        maxDate: 'today', // Solo permite seleccionar hasta hoy
        // Otros ajustes opcionales pueden ir aquí
    });
</script>

</body>
</html>
