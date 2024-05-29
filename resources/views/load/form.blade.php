<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Carga</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <style>
        .form-container {
            margin: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .remove-product-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 32px;
            width: 32px;
            border: none;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .remove-product-btn:hover {
            background-color: #c82333;
        }
        .remove-product-btn i {
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Formulario de Carga</h2>
                        <form action="{{ route('loads.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="date">{{ __('Fecha') }}</label>
                                <input type="text" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', optional($load->date)->format('Y-m-d')) }}" id="date" placeholder="Fecha">
                                {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="routes_id">{{ __('ID de Ruta') }}</label>
                                <select name="routes_id" class="form-control @error('routes_id') is-invalid @enderror" id="routes_id">
                                    <option value="">Selecciona la ruta</option>
                                    @foreach($routes as $route)
                                        <option value="{{ $route->id }}" {{ old('routes_id', optional($load)->routes_id) == $route->id ? 'selected' : '' }}>{{ $route->route_name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('routes_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="truck_types_id">{{ __('ID de Tipo de Camión') }}</label>
                                <select name="truck_types_id" class="form-control @error('truck_types_id') is-invalid @enderror" id="truck_types_id">
                                    <option value="">Selecciona el tipo de camión</option>
                                    @foreach($truckTypes as $truckType)
                                        <option value="{{ $truckType->id }}" {{ old('truck_types_id', optional($load)->truck_types_id) == $truckType->id ? 'selected' : '' }}>
                                            {{ $truckType->truck_brand }}
                                        </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('truck_types_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group btn-container">
                                <button type="submit" class="btn btn-success">{{ __('Enviar') }}</button>
                                <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-arrow-left"></i> {{ __('Atrás') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-container">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Detalles de la Carga</h2>
                        <form action="{{ route('details.store') }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('ID de Producto') }}</th>
                                            <th>{{ __('Loads Id') }}</th>
                                            <th>{{ __('Acciones') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="productos">
                                        <tr>
                                            <td>
                                                <input type="text" name="amount[]" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" placeholder="Amount">
                                                {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
                                            </td>
                                            <td>
                                                <select name="products_id[]" class="form-control @error('products_id') is-invalid @enderror">
                                                    <option value="">Selecciona el producto</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('products_id', '<div class="invalid-feedback">:message</div>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="loads_id[]" class="form-control" value="{{ $currentLoad ? $currentLoad->id : '' }}" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-product-btn d-none">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer mt20">
                                <button type="button" class="btn btn-primary" id="agregarProducto">Agregar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        flatpickr('#date', {
            dateFormat: 'Y-m-d',
            defaultDate: 'today', // Establecer la fecha actual por defecto
            minDate: 'today',     // Restringir la fecha mínima a la fecha actual
            maxDate: 'today',     // Restringir la fecha máxima a la fecha actual
            allowInput: true,     // Permitir al usuario ingresar manualmente la fecha
            clickOpens: true,     // Habilitar el calendario desplegable al hacer clic en el campo de fecha
            onClose: function(selectedDates, dateStr, instance) {
                // Validar si se ha seleccionado una fecha distinta al día actual
                if (selectedDates.length && selectedDates[0].getDate() !== new Date().getDate()) {
                    instance.setDate('today', true); // Establecer la fecha actual si se selecciona otra fecha
                }
            }
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('agregarProducto').addEventListener('click', function() {
            var productos = document.querySelector('.productos');
            var nuevoProducto = productos.querySelector('tr').cloneNode(true);
            nuevoProducto.querySelector('input[name="amount[]"]').value = '';
            nuevoProducto.querySelector('select[name="products_id[]"]').selectedIndex = 0;
            nuevoProducto.querySelector('.remove-product-btn').classList.remove('d-none');
            productos.appendChild(nuevoProducto);

            nuevoProducto.querySelector('.remove-product-btn').addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });

        document.querySelectorAll('.remove-product-btn').forEach(function(button, index) {
            if (index === 0) {
                button.classList.add('d-none');
            } else {
                button.addEventListener('click', function() {
                    this.closest('tr').remove();
                });
            }
        });

        document.getElementById('enviarFormulario').addEventListener('click', function() {
            var detalles = [];
            document.querySelectorAll('.productos tr').forEach(function(detalle) {
                var amount = detalle.querySelector('input[name="amount[]"]').value;
                var productId = detalle.querySelector('select[name="products_id[]"]').value;

                detalles.push({
                    amount: amount,
                    products_id: productId
                });
            });

            var formData = {
                date: document.querySelector('input[name="date"]').value,
                routes_id: document.querySelector('select[name="routes_id"]').value,
                truck_types_id: document.querySelector('select[name="truck_types_id"]').value,
                detalles: detalles
            };

            enviarDatos(formData);
        });
    });

    function enviarDatos(formData) {
        $.ajax({
            type: 'POST',
            url: '{{ route("loads.store") }}',
            data: {
                _token: '{{ csrf_token() }}',
                formData: formData
            },
            success: function(response) {
                console.log('Carga creada exitosamente:', response);
            },
            error: function(err) {
                console.error('Error al crear la carga:', err);
            }
        });
    }
</script>


