<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="product_name">{{ __('Nombre del Producto') }}</label>
            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name', $product?->product_name) }}" id="product_name" placeholder="Nombre del Producto">
            {!! $errors->first('product_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="brand">{{ __('Marca') }}</label>
            <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand', $product?->brand) }}" id="brand" placeholder="Marca">
            {!! $errors->first('brand', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="price_unit">{{ __('Precio unitario') }}</label>
            <input type="text" name="price_unit" class="form-control @error('price_unit') is-invalid @enderror" value="{{ old('price_unit', $product?->price_unit) }}" id="price_unit" placeholder="Precio unitario">
            {!! $errors->first('price_unit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <script>
    document.getElementById('price_unit').addEventListener('input', function(event) {
        // Obtener el valor actual del campo
        let value = event.target.value;

        // Eliminar cualquier carácter que no sea un número, punto o coma
        value = value.replace(/[^\d.,]/g, '');

        // Formatear el valor en formato de moneda
        value = formatCurrency(value);

        // Actualizar el valor en el campo
        event.target.value = value;
    });

    function formatCurrency(value) {
        // Convertir el valor a número
        let number = parseFloat(value.replace(/[,.]/g, '').replace(',', '.'));

        // Verificar si es un número válido
        if (!isNaN(number)) {
            // Limitar el valor dentro del rango del peso colombiano
            number = Math.max(0, Math.min(number, 1000000000));
            
            // Formatear el número con separadores de miles y sin decimales
            return number.toLocaleString('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 });
        } else {
            return '';
        }
    }
</script>

        <div class="form-group">
    <label for="unit_of_measurement">{{ __('Unidad de Medida') }}</label>
    <select name="unit_of_measurement" class="form-control @error('unit_of_measurement') is-invalid @enderror" id="unit_of_measurement">
    <option value="">Select Unidad de Medida</option>
    <option value="Tonelada" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Tonelada' ? 'selected' : '' }}>Tonelada</option>
    <option value="Kilogramo" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Kilogramo' ? 'selected' : '' }}>Kilogramo</option>
    <option value="Libra" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Libra' ? 'selected' : '' }}>Libra</option>
    <!-- Agrega más opciones según sea necesario -->
</select>
{!! $errors->first('unit_of_measurement', '<div class="invalid-feedback">:message</div>') !!}

    {!! $errors->first('unit_of_measurement', '<div class="invalid-feedback">:message</div>') !!}
</div>
        <div class="form-group">
            <label for="suppliers_id">{{ __('Provedores Id') }}</label>
           <select name="suppliers_id" class="form-control @error('suppliers_id') is-invalid @enderror" id="suppliers_id">
    <option value="">Select Proveedor</option>
    @foreach($suppliers as $supplier)
        <option value="{{ $supplier->id }}" {{ $product->suppliers_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
    @endforeach
</select>

<br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Crear Product') }}</button>
    </div>
</div>
