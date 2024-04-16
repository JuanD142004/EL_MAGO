<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('products_id') }}
            {{ Form::text('products_id', $detailsSale->products_id, ['class' => 'form-control' . ($errors->has('products_id') ? ' is-invalid' : ''), 'placeholder' => 'Products Id']) }}
            {!! $errors->first('products_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price_unit') }}
            {{ Form::text('price_unit', $detailsSale->price_unit, ['class' => 'form-control' . ($errors->has('price_unit') ? ' is-invalid' : ''), 'placeholder' => 'Price Unit']) }}
            {!! $errors->first('price_unit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('amount') }}
            {{ Form::text('amount', $detailsSale->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount']) }}
            {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('discount') }}
            {{ Form::text('discount', $detailsSale->discount, ['class' => 'form-control' . ($errors->has('discount') ? ' is-invalid' : ''), 'placeholder' => 'Discount']) }}
            {!! $errors->first('discount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sales_id') }}
            {{ Form::text('sales_id', $detailsSale->sales_id, ['class' => 'form-control' . ($errors->has('sales_id') ? ' is-invalid' : ''), 'placeholder' => 'Sales Id']) }}
            {!! $errors->first('sales_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>