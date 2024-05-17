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
            <input type="text" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', optional($load->date)->format('Y-m-d')) }}" id="date" placeholder="Fecha">
            {!! $errors->first('date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
                    <option value="{{ $truckType->id }}" {{ old('truck_types_id', optional($load)->truck_types_id) == $truckType->id ? 'selected' : '' }}>
                        {{ $truckType->truck_brand }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('truck_types_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
    </div>
</div>

<!-- Agrega el JavaScript de flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Inicializa flatpickr -->
<script>
    flatpickr('#date', {
        dateFormat: 'Y-m-d', // Formato de fecha deseado
        defaultDate: '{{ old('date', optional($load->date)->format('Y-m-d')) }}', // Establece la fecha predeterminada
        minDate: 'today', // Solo permite seleccionar a partir de hoy
        maxDate: 'today', // Solo permite seleccionar hasta hoy
        // Otros ajustes opcionales pueden ir aquí
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="col-md-12 mt20 mt-2">
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary me-2">{{ __('Enviar') }}</button>
        <a href="{{ url()->previous() }}" class="btn btn-default btn-sm" style="background-color: #007bff; color: #fff;">
            <i class="fas fa-arrow-left"></i> {{ __('Atrás') }}
        </a>
    </div>
</div>
</body>
</html>
