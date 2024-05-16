<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="products_id" class="form-label">{{ __('Products Id') }}</label>
            <select name="products_id" class="form-control @error('products_id') is-invalid @enderror" id="products_id">
                <option value="" selected disabled>{{ __('Select Product') }}</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
            {!! $errors->first('products_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>



        <div class="form-group mb-2 mb20">
            <label for="purchase_lot" class="form-label">{{ __('Purchase Lot') }}</label>
            <input type="text" name="purchase_lot" class="form-control @error('purchase_lot') is-invalid @enderror" value="{{ old('purchase_lot', $detailsPurchase?->purchase_lot) }}" id="purchase_lot" placeholder="Purchase Lot">
            {!! $errors->first('purchase_lot', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="amount" class="form-label">{{ __('Amount') }}</label>
            <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $detailsPurchase?->amount) }}" id="amount" placeholder="Amount">
            {!! $errors->first('amount', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="unit_value" class="form-label">{{ __('Unit Value') }}</label>
            <input type="text" name="unit_value" class="form-control @error('unit_value') is-invalid @enderror" value="{{ old('unit_value', $detailsPurchase?->unit_value) }}" id="unit_value" placeholder="Unit Value">
            {!! $errors->first('unit_value', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="purchases_id" class="form-label">{{ __('Purchases Id') }}</label>
            <input type="select" name="purchases_id" class="form-control @error('purchases_id') is-invalid @enderror" value="{{ old('purchases_id', $detailsPurchase?->purchases_id) }}" id="purchases_id" placeholder="Purchases Id">
            {!! $errors->first('purchases_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>