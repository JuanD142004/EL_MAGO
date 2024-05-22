
<div class="row padding-1 p-1">
        <div class="col-md-12">
            <div class="form-group mb-2 mb20">
                <label for="route_name" class="form-label">{{ __('Nombre de la Ruta') }}</label>
                <input type="text" name="route_name" class="form-control @error('route_name') is-invalid @enderror" value="{{ old('route_name') }}" id="route_name" placeholder="Nombre">
                {!! $errors->first('route_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="departament_id">{{ __('Departamento') }}</label>
                <select id="departament" name="departament_id" class="form-select @error('departament_id') is-invalid @enderror" arial-label="Default select example">
                    <option value="">Selecciona el Departamento</option>
                    @foreach($departaments as $departament)
                        <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                    @endforeach
                </select>  
                @error('departament_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="municipality_id">{{ __('Municipio') }}</label>
                <select id="municipalities" name="municipalities[]" class="form-select select2-multiple @error('municipalities') is-invalid @enderror" aria-label="Default select example" multiple>
                    <option value="">Selecciona el Municipio</option>
                </select>
                
                @error('municipalities')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-12 mt20 mt-2">
            <button type="submit" class="btn btn-primary">{{ __('Crear') }}</button>
        </div>
    </div>

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const departament = document.getElementById('departament');
        const municipalities = document.getElementById('municipalities');
    
        const getMunicipalities = async (departaments_id) => {
            console.log(departaments_id); // Verifica el valor de departaments_id
            const response = await fetch(`/route/create/departament/${departaments_id}/municipalities`);
    
            const data = await response.json();
    
            let options = '';
            data.forEach(element => {
                options += `<option value="${element.name}">${element.name}</option>`;
            });
            municipalities.innerHTML = options;
        }
    
        // Inicializa Select2 aquí
        $(document).ready(function() {
            $('#municipalities').select2({
                placeholder: "Selecciona el Municipio",
                allowClear: true,
                tags: false // Esto evita que los usuarios escriban sus propias opciones
            }).on('change', function() {
                // Manejar cambios en las opciones seleccionadas
            });
        });
    
        window.onload = () => {
            const departaments_id = departament.value;
            getMunicipalities(departaments_id);
        };
    
        departament.addEventListener('change', (e) => {
            getMunicipalities(e.target.value);
        });
    });
    
</script>
<script>
    $(document).ready(function() {
        $('#municipalities').select2({
            placeholder: "Selecciona el Municipio",
            allowClear: true,
            tags: false // Evita que los usuarios ingresen sus propias opciones
        }).on('change', function() {
            // Manejar cambios en las opciones seleccionadas
        });
    });
    
    
</script>   
@endsection