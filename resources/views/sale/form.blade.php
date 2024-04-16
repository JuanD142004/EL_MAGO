<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('customers_id') }}
            {{ Form::text('customers_id', $sale->customers_id, ['class' => 'form-control' . ($errors->has('customers_id') ? ' is-invalid' : ''), 'placeholder' => 'Customers Id']) }}
            {!! $errors->first('customers_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price_total') }}
            {{ Form::text('price_total', $sale->price_total, ['class' => 'form-control' . ($errors->has('price_total') ? ' is-invalid' : ''), 'placeholder' => 'Price Total']) }}
            {!! $errors->first('price_total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('payment_method') }}
            {{ Form::text('payment_method', $sale->payment_method, ['class' => 'form-control' . ($errors->has('payment_method') ? ' is-invalid' : ''), 'placeholder' => 'Payment Method']) }}
            {!! $errors->first('payment_method', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>