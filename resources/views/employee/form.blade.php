<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('users_id') }}
            {{ Form::select('users_id',$users, $employee->users_id, ['class' => 'form-control' . ($errors->has('users_id') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('users_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('gender') }}
            {{ Form::text('gender', $employee->gender, ['class' => 'form-control' . ($errors->has('gender') ? ' is-invalid' : ''), 'placeholder' => 'Gender']) }}
            {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('civil_status') }}
            {{ Form::text('civil_status', $employee->civil_status, ['class' => 'form-control' . ($errors->has('civil_status') ? ' is-invalid' : ''), 'placeholder' => 'Civil Status']) }}
            {!! $errors->first('civil_status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('routes_id') }}
            {{ Form::select('routes_id',$routes, $employee->routes_id, ['class' => 'form-control' . ($errors->has('routes_id') ? ' is-invalid' : ''), 'placeholder' => 'Routes Id']) }}
            {!! $errors->first('routes_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
<br>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('employee.index') }}" class="btn btn-primary">{{ __('Volver') }}</a>
    </div>
</div>