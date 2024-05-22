<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Compras</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .form-container {
            margin: auto;
            margin-top: 20px;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
        }

        th,
        td {
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

        /* Estilo para el formulario de detalle de compras */
        .detail-form-container {
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Formulario de Compras</h2>
                        <!-- Primer formulario -->
                        <form id="mainForm" action="{{ route('purchases.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                {{ Form::label('suppliers_id', 'Nombre del Proveedor') }}
                                {{ Form::select('suppliers_id', $suppliers->pluck('supplier_name', 'id'), null, ['class' => 'form-control' . ($errors->has('suppliers_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un proveedor']) }}
                                {!! $errors->first('suppliers_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                {{ Form::label('total_value', 'Precio Total') }}
                                {{ Form::text('total_value', old('total_value'), ['class' => 'form-control' . ($errors->has('total_value') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total', 'readonly' => 'readonly','style' => 'background-color: #f8f9fa; cursor: not-allowed;']) }}
                                {!! $errors->first('total_value', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                {{ Form::label('num_bill', 'Número de Factura') }}
                                {{ Form::text('num_bill', old('num_bill'), ['class' => 'form-control' . ($errors->has('num_bill') ? ' is-invalid' : ''), 'placeholder' => 'Número de Factura']) }}
                                {!! $errors->first('num_bill', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group btn-container">
                                <button type="submit" class="btn btn-success btn-enviar">{{ __('Enviar') }}</button>
                                <a class="btn btn-primary" href="{{ route('purchases.index') }}">
                                    <i class="fas fa-chevron-left"></i> {{ __("Atrás") }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 form-container">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Formulario de Detalles de Compras</h2>
                        <!-- Segundo formulario como tabla -->
                        <form id="detailsForm" action="{{ route('details_purchase.store') }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="table" id="detalle-table">
                                    <thead>
                                        <tr>
                                            <th>ID del Producto</th>
                                            <th>Lote</th>
                                            <th>Cantidad</th>
                                            <th>Valor Unitario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selectedProductsBody">
                                        <tr class="product-row-template">
                                            <td>
                                                {{ Form::select('products_id[]', $products->pluck('product_name', 'id'), null, ['class' => 'form-control products-id', 'placeholder' => 'Selecciona un producto']) }}
                                                {!! $errors->first('products_id', '<div class="invalid-feedback">:message</div>') !!}
                                            </td>
                                            <td>
                                                {{ Form::text('purchase_lot[]', null, ['class' => 'form-control purchase-lot', 'placeholder' => 'Lote']) }}
                                                {!! $errors->first('purchase_lot', '<div class="invalid-feedback">:message</div>') !!}
                                            </td>
                                            <td>
                                                {{ Form::text('amount[]', null, ['class' => 'form-control amount', 'placeholder' => 'Cantidad']) }}
                                                {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
                                            </td>
                                            <td>
                                                {{ Form::text('unit_value[]', null, ['class' => 'form-control unit-value', 'placeholder' => 'Valor Unitario']) }}
                                                {!! $errors->first('unit_value', '<div class="invalid-feedback">:message</div>') !!}
                                            </td>
                                            
                                            <td>
                                                <button type="button" class="btn btn-danger eliminar-detalle" onclick="eliminarDetalle(this)"><i class="fas fa-trash-alt"></i></ <button type="button" class="btn btn-danger eliminar-detalle" onclick="eliminarDetalle(this)"></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer mt20">
                                <button type="button" class="btn btn-primary" id="agregarDetalle">Agregar Producto
                                </button>
                                <!-- <a class="btn btn-primary" href="{{ route('details_purchase.index') }}">
                                    <i class="fas fa-chevron-left"></i> {{ __("Atrás") }}
                                </a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('agregarDetalle').addEventListener('click', function() {
            var container = document.querySelector('#selectedProductsBody');
            var nuevoDetalle = container.children[0].cloneNode(true);

            // Limpiar los campos del nuevo detalle clonado
            nuevoDetalle.querySelectorAll('select, input').forEach(function(element) {
                element.value = '';
                // Agregar un índice único a los nombres de los campos clonados
                element.name = element.name + '_' + container.children.length;
            });

            // Agregar el nuevo detalle a la tabla
            container.appendChild(nuevoDetalle);
        });

        //elminar detalle de la compra 
        function eliminarDetalle(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);

            // Recalcular el total de la compra después de eliminar el detalle
            calcularTotalCompra();
        }

        // Función para calcular el valor total de la compra
        function calcularTotalCompra() {
            var rows = document.querySelectorAll('#selectedProductsBody tr');
            var total = 0;

            rows.forEach(function(row) {
                var cantidad = parseFloat(row.querySelector('.amount').value);
                var valorUnitario = parseFloat(row.querySelector('.unit-value').value);
                var subtotal = cantidad * valorUnitario;
                total += subtotal;
            });

            // Actualizar el campo de valor total
            document.getElementById('total_value').value = total.toFixed(2);
        }

        // Agregar eventos de escucha para recalcular el valor total cuando cambie la cantidad o el valor unitario
        document.addEventListener('input', function(event) {
            var element = event.target;
            if (element.classList.contains('amount') || element.classList.contains('unit-value')) {
                calcularTotalCompra();
            }
        });
    </script>
</body>

</html>