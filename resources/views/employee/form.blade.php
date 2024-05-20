<div class="box box-info padding-1">
    <div class="box-body">
        @if ($errors->has('user_email'))
            <div class="alert alert-danger">
                {{ $errors->first('user_email') }}
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('users_id', 'Usuario') }}
            <select name="users_id" id="users_id" class="form-control{{ $errors->has('users_id') ? ' is-invalid' : '' }}" placeholder="Usuario">
                <option value="">Seleccione un usuario</option>
                
                @foreach($users as $user)
                    <option value="{{ $user->id }}" data-email="{{ $user->email }}" {{ $user->id == $employee->users_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('users_id', '<div class="invalid-feedback">:message</div>') !!}
            
        </div>
        <div class="form-group">
            {{ Form::label('user_email', 'Correo Electrónico') }}
            {{ Form::text('user_email', $employee->user->email ?? '', ['class' => 'form-control', 'id' => 'user_email', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('document_number') }}
            {{ Form::text('document_number', $employee->document_number, ['class' => 'form-control' . ($errors->has('document_number') ? ' is-invalid' : ''), 'placeholder' => 'document_number']) }}
            {!! $errors->first('document_number', '<div class="invalid-feedback">:message</div>') !!}
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
            {{ Form::label('eps') }}
            {{ Form::text('eps', $employee->eps, ['class' => 'form-control' . ($errors->has('eps') ? ' is-invalid' : ''), 'placeholder' => 'Eps']) }}
            {!! $errors->first('eps', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('phone') }}
            {{ Form::text('phone', $employee->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('children') }}
            {{ Form::text('children', $employee->children, ['class' => 'form-control' . ($errors->has('children') ? ' is-invalid' : ''), 'placeholder' => 'Hijos']) }}
            {!! $errors->first('children', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('home') }}
            {{ Form::text('home', $employee->home, ['class' => 'form-control' . ($errors->has('home') ? ' is-invalid' : ''), 'placeholder' => 'Donde vive']) }}
            {!! $errors->first('home', '<div class="invalid-feedback">:message</div>') !!}
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userSelect = document.getElementById('users_id');
            const emailInput = document.getElementById('user_email');

            userSelect.addEventListener('change', function() {
                const selectedOption = userSelect.options[userSelect.selectedIndex];
                const email = selectedOption.getAttribute('data-email');
                emailInput.value = email || '';
            });
        });
    </script>
