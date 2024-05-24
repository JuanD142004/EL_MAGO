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
                        <form id="mainForm" action="{{ route('purchases.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                {{ Form::label('suppliers_id', 'Nombre del Proveedor') }}
                                {{ Form::select('suppliers_id', $suppliers->pluck('supplier_name', 'id'), null, ['class' => 'form-control' . ($errors->has('suppliers_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un proveedor']) }}
                                {!! $errors->first('suppliers_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('date', 'Fecha') }}
                                {{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
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
                    </div>
                    <div class="box-footer" style="margin: 20px;">
                        <button type="button" class="btn btn-success" onclick="enviarDetalles()">Enviar</button>
                        <a type="submit" class="btn btn-primary" href="{{ route('purchases.index') }}">Volver</a>
                    </div>
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
                                                <button type="button" class="btn btn-danger eliminar-detalle" onclick="eliminarDetalle(this)"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer mt20">
                                <button type="button" class="btn btn-primary" id="agregarDetalle">Agregar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var agregarDetalleButton = document.getElementById('agregarDetalle');
            if (agregarDetalleButton) {
                agregarDetalleButton.addEventListener('click', function() {
                    var container = document.querySelector('#selectedProductsBody');
                    var nuevoDetalle = container.children[0].cloneNode(true);

                    // Limpiar los campos del nuevo detalle clonado
                    nuevoDetalle.querySelectorAll('select, input').forEach(function(element) {
                        element.value = '';
                        // Agregar un índice único a los nombres de los campos clonados
                        element.name = element.name.split('[')[0] + '[]';
                    });

                    container.appendChild(nuevoDetalle);
                    addEventListeners(nuevoDetalle); // Añadir eventos de escucha a la nueva fila
                });

                const initialDetail = document.querySelector('#detalle-table tbody tr');
                if (initialDetail) {
                    addEventListeners(initialDetail);
                }
            }
        });

        function addEventListeners(row) {
            row.querySelectorAll('input.amount, input.unit-value').forEach(function(input) {
                input.addEventListener('input', function() {
                    if (isNaN(input.value) || input.value < 0) {
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                    calcularTotalCompra();
                });
            });
        }

        function eliminarDetalle(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            calcularTotalCompra();
        }

        function calcularTotalCompra() {
            var rows = document.querySelectorAll('#selectedProductsBody tr');
            var total = 0;

            rows.forEach(function(row) {
                var cantidad = parseFloat(row.querySelector('.amount').value) || 0;
                var valorUnitario = parseFloat(row.querySelector('.unit-value').value) || 0;
                var subtotal = cantidad * valorUnitario;
                total += subtotal;
            });

            document.querySelector('input[name="total_value"]').value = total.toFixed(2);
        }

        function enviarDetalles() {
            const detalles = [];
            document.querySelectorAll('#detalle-table tbody tr').forEach(function(detalle) {
                const Producto = detalle.querySelector('select[name^="products_id"]').value;
                const Lote = detalle.querySelector('input[name^="purchase_lot"]').value;
                const Cantidad = detalle.querySelector('input[name^="amount"]').value;
                const ValorUnitario = detalle.querySelector('input[name^="unit_value"]').value;

                detalles.push({
                    Producto: Producto,
                    Lote: Lote,
                    Cantidad: Cantidad,
                    ValorUnitario: ValorUnitario,
                });
            });

            const Proveedor = document.querySelector('select[name="suppliers_id"]').value;
            const fecha = document.querySelector('input[name="date"]').value;
            const Valortotal = document.querySelector('input[name="total_value"]').value;
            const NumeroFactura = document.querySelector('input[name="num_bill"]').value;

            const data = {
                nombre_proveedor: Proveedor,
                fecha: fecha,
                ValorTotal: Valortotal,
                NumeroFactura: NumeroFactura,
                detalles: detalles
            };
            console.log(data);
        }
    </script>
</body>

</html>
