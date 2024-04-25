<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="truck_brand" class="form-label">{{ __('Marca de Camión') }}</label>
            <input type="text" name="truck_brand" class="form-control @error('truck_brand') is-invalid @enderror" value="{{ old('truck_brand', $truckType?->truck_brand) }}" id="truck_brand" placeholder="Marca de Camión">
            {!! $errors->first('truck_brand', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="plate" class="form-label">{{ __('Placa') }}</label>
            <input type="text" name="plate" class="form-control @error('plate') is-invalid @enderror" value="{{ old('plate', $truckType?->plate) }}" id="plate" placeholder="Placa">
            {!! $errors->first('plate', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ability" class="form-label">{{ __('Capacidad') }}</label>
            <input type="text" name="ability" class="form-control @error('ability') is-invalid @enderror" value="{{ old('ability', $truckType?->ability) }}" id="ability" placeholder="Capacidad">
            {!! $errors->first('ability', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="enabled" class="form-label">{{ __('Enabled') }}</label>
            <select name="enabled" class="form-control @error('enabled') is-invalid @enderror" id="enabled">
                <option value="1" {{ old('enabled', $truckType?->enabled) == '1' ? 'selected' : '' }}>1</option>
            </select>
            {!! $errors->first('enabled', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
