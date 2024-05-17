<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Comic Sans MS</title>
    <link href="https://fonts.bunny.net/css?family=Comic+Sans+MS" rel="stylesheet">
    <style>
        /* Aplicando la fuente Comic Sans MS a los elementos del formulario */
        .form-label,
        .form-control,
        select {
            font-family:  sans-serif;
            font-size: 14px; /* Aumenta el tamaño de la fuente */
        }
    </style>
</head>
<body>
<div class="row padding-1 p-1">
    
    <div class="col-md-12">
        <div class="form-group mb-2 mb20">
            <label for="customer_name" class="form-label">{{ __('Nombre del cliente') }}</label>
            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', optional($customer)->customer_name) }}" id="customer_name" placeholder="Nombre del cliente">
            {!! $errors->first('customer_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="company_name" class="form-label">{{ __('Nombre de la empresa') }}</label>
            <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', optional($customer)->company_name) }}" id="company_name" placeholder="Nombre de la empresa">
            {!! $errors->first('company_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="location" class="form-label">{{ __('Dirección') }}</label>
            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', optional($customer)->location) }}" id="location" placeholder="Dirección">
            {!! $errors->first('location', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cell_phone" class="form-label">{{ __('Celular') }}</label>
            <input type="text" name="cell_phone" class="form-control @error('cell_phone') is-invalid @enderror" value="{{ old('cell_phone', optional($customer)->cell_phone) }}" id="cell_phone" placeholder="Celular">
            {!! $errors->first('cell_phone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="mail" class="form-label">{{ __('Correo') }}</label>
            <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror" value="{{ old('mail', optional($customer)->mail) }}" id="mail" placeholder="Correo">
            {!! $errors->first('mail', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <!-- Campo para seleccionar la ruta -->
        <div class="form-group mb-2 mb20">
            <label for="routes_id" class="form-label">{{ __('Id Ruta') }}</label>
            <select name="routes_id" class="form-control @error('routes_id') is-invalid @enderror" id="routes_id">
                <option value="">Select Route</option>
                @foreach($routes as $route)
                    <option value="{{ $route->id }}" {{ optional($customer->route)->id == $route->id ? 'selected' : '' }}>{{ $route->route_name }}</option>
                @endforeach
            </select>
            {!! $errors->first('routes_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <!-- Agregar campo "enabled" -->
        <div class="form-group mb-2 mb20">
            <label for="enabled" class="form-label">{{ __('Habilitado') }}</label>
            <select name="enabled" class="form-control @error('enabled') is-invalid @enderror" id="enabled">
                <option value="1" {{ old('enabled', optional($customer)->enabled ?? '') == 1 ? 'selected' : '' }}>1</option>
            </select>
            {!! $errors->first('enabled', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <!-- Fin del campo "enabled" -->

        <div class="col-md-12 mt20 mt-2">
            <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
        </div>
        
    </div>
</div>
</body>
</html>
