<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="nit">{{ __('Nit') }}</label>
            <input type="text" name="nit" class="form-control @error('nit') is-invalid @enderror" value="{{ old('nit', $supplier->nit) }}" id="nit" placeholder="Nit">
            {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="supplier_name">{{ __('Supplier Name') }}</label>
            <input type="text" name="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror" value="{{ old('supplier_name', $supplier->supplier_name) }}" id="supplier_name" placeholder="Supplier Name">
            {!! $errors->first('supplier_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="cell_phone">{{ __('Cell Phone') }}</label>
            <input type="text" name="cell_phone" class="form-control @error('cell_phone') is-invalid @enderror" value="{{ old('cell_phone', $supplier->cell_phone) }}" id="cell_phone" placeholder="Cell Phone">
            {!! $errors->first('cell_phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="mail">{{ __('Mail') }}</label>
            <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror" value="{{ old('mail', $supplier->mail) }}" id="mail" placeholder="Mail">
            {!! $errors->first('mail', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $supplier->address) }}" id="address" placeholder="Address">
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
<br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-primary">{{ __('Volver') }}</a>

    </div>
</div>
