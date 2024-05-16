<div class="row padding-1 p-1">
    <div class="col-md-12">




        <div class="form-group mb-2 mb20">
            <label for="suppliers_id" class="form-label">{{ __('Suppliers Id') }}</label>
            <select name="suppliers_id" class="form-control @error('suppliers_id') is-invalid @enderror" id="suppliers_id">
                <option value="" selected disabled>{{ __('Select supplier') }}</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                @endforeach
            </select>
            {!! $errors->first('products_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


        <div class="form-group mb-2 mb20">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $purchase?->date) }}" id="date" placeholder="Date">
            {!! $errors->first('date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="total_value" class="form-label">{{ __('Total Value') }}</label>
            <input type="text" name="total_value" class="form-control @error('total_value') is-invalid @enderror" value="{{ old('total_value', $purchase?->total_value) }}" id="total_value" placeholder="Total Value">
            {!! $errors->first('total_value', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="num_bill" class="form-label">{{ __('Num Bill') }}</label>
            <input type="text" name="num_bill" class="form-control @error('num_bill') is-invalid @enderror" value="{{ old('num_bill', $purchase?->num_bill) }}" id="num_bill" placeholder="Num Bill">
            {!! $errors->first('num_bill', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        
     
    </div>
  
</div>
