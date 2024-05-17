<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="amount" class="form-label">{{ __('Amount') }}</label>
            <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $detailsLoad?->amount) }}" id="amount" placeholder="Amount">
            {!! $errors->first('amount', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="products_id" class="form-label">{{ __('ID de Producto') }}</label>
            <select name="products_id" class="form-control @error('products_id') is-invalid @enderror" id="products_id">
                <option value="">Selecciona el producto</option>
                    @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('products_id', optional($detailsLoad)->products_id) == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                    @endforeach
            </select>

            {!! $errors->first('products_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="loads_id" class="form-label">{{ __('Loads Id') }}</label>
            <select name="loads_id" class="form-control @error('loads_id') is-invalid @enderror" id="loads_id">
    <option value="">Selecciona la carga</option>
    @foreach($loads as $load)
        <option value="{{ $load->id }}" {{ old('loads_id', optional($detailsLoad)->load_id) == $load->id ? 'selected' : '' }}>{{ $load->id }}</option>
    @endforeach
</select>

            {!! $errors->first('loads_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>