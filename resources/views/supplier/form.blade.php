<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nit') }}
            {{ Form::text('nit', $supplier->nit, ['class' => 'form-control' . ($errors->has('nit') ? ' is-invalid' : ''), 'placeholder' => 'Nit']) }}
            {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('supplier_name') }}
            {{ Form::text('supplier_name', $supplier->supplier_name, ['class' => 'form-control' . ($errors->has('supplier_name') ? ' is-invalid' : ''), 'placeholder' => 'Supplier Name']) }}
            {!! $errors->first('supplier_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cell_phone') }}
            {{ Form::text('cell_phone', $supplier->cell_phone, ['class' => 'form-control' . ($errors->has('cell_phone') ? ' is-invalid' : ''), 'placeholder' => 'Cell Phone']) }}
            {!! $errors->first('cell_phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('mail') }}
            {{ Form::text('mail', $supplier->mail, ['class' => 'form-control' . ($errors->has('mail') ? ' is-invalid' : ''), 'placeholder' => 'Mail']) }}
            {!! $errors->first('mail', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('address') }}
            {{ Form::text('address', $supplier->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Address']) }}
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>