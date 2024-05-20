<div class="box box-info padding-1">
    <div class="box-body">
        @if ($errors->has('user_email'))
            <div class="alert alert-danger">
                {{ $errors->first('user_email') }}
            </div>
        @endif
        <div class="form-group">
            <label for="users_id">{{ __('Usuario') }}</label>
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
            <label for="user_email">{{ __('Correo Electrónico') }}</label>
            <input type="text" name="user_email" value="{{ $employee->user->email ?? '' }}" class="form-control" id="user_email" readonly>
        </div>

        <div class="form-group">
            <label for="document_number">{{ __('Número de Documento') }}</label>
            <input type="text" name="document_number" value="{{ $employee->document_number }}" class="form-control{{ $errors->has('document_number') ? ' is-invalid' : '' }}" placeholder="Número de Documento">
            {!! $errors->first('document_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label for="gender">{{ __('Género') }}</label>
            <input type="text" name="gender" value="{{ $employee->gender }}" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" placeholder="Género">
            {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label for="civil_status">{{ __('Estado Civil') }}</label>
            <input type="text" name="civil_status" value="{{ $employee->civil_status }}" class="form-control{{ $errors->has('civil_status') ? ' is-invalid' : '' }}" placeholder="Estado Civil">
            {!! $errors->first('civil_status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label for="eps">{{ __('EPS') }}</label>
            <input type="text" name="eps" value="{{ $employee->eps }}" class="form-control{{ $errors->has('eps') ? ' is-invalid' : '' }}" placeholder="EPS">
            {!! $errors->first('eps', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label for="phone">{{ __('Teléfono') }}</label>
            <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Teléfono">
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label for="children">{{ __('Hijos') }}</label>
            <input type="text" name="children" value="{{ $employee->children }}" class="form-control{{ $errors->has('children') ? ' is-invalid' : '' }}" placeholder="Hijos">
            {!! $errors->first('children', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label for="home">{{ __('Lugar de Residencia') }}</label>
            <input type="text" name="home" value="{{ $employee->home }}" class="form-control{{ $errors->has('home') ? ' is-invalid' : '' }}" placeholder="Lugar de Residencia">
            {!! $errors->first('home', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label for="routes_id">{{ __('Ruta') }}</label>
            <select name="routes_id" class="form-control{{ $errors->has('routes_id') ? ' is-invalid' : '' }}" placeholder="Ruta">
                @foreach($routes as $route_id => $route_name)
                    <option value="{{ $route_id }}" {{ $route_id == $employee->routes_id ? 'selected' : '' }}>
                        {{ $route_name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('routes_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
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
