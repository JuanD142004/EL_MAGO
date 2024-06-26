<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $municipality?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
       <div class="form-group mb-2 mb20">
    <label for="departaments_id" class="form-label">{{ __('Departament') }}</label>
    <select name="departaments_id" class="form-control @error('departaments_id') is-invalid @enderror" id="departaments_id">
        <option value="">Select a Departament</option>
        @foreach($departaments as $departament)
            <option value="{{ $departament->id }}" {{ old('departaments_id', $municipality->departaments_id) == $departament->id ? 'selected' : '' }}>
                {{ $departament->name }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('departaments_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
</div>

        <div class="form-group mb-2 mb20">
            <label for="enabled" class="form-label">{{ __('Enabled') }}</label>
            <input type="text" name="enabled" class="form-control @error('enabled') is-invalid @enderror" value="{{ old('enabled', $municipality?->enabled) }}" id="enabled" placeholder="Enabled">
            {!! $errors->first('enabled', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>