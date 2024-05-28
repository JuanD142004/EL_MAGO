@extends('layouts.app')

@section('template_title')
Purchase
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/dataTables.bootstrap5.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Purchase') }}
                        </span>

                        <div class="float-right">
                            <button name="boton_excel" class="btn btn-info btn-sm mr-2" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> {{ __('Exportar a Excel') }}
                            </button>

                            <button name="boton_imprimir" class="btn btn-info btn-sm d-print-none" type="button" onclick="printTable()">
                                <i class="fas fa-print"></i> {{ __('Imprimir') }}
                            </button>

                            <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="myTable">
                        <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>Supplier</th>
                                <th>Date</th>
                                <th>Total Value</th>
                                <th>Num Bill</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $purchase->supplier->supplier_name }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td>{{ $purchase->total_value }}</td>
                                <td>{{ $purchase->num_bill }}</td>



                                <td>
                                    <form class="frData" action="{{ route('purchase.destroy', $purchase->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-sm btn-primary {{ $purchase->enabled ? 'enable' : '' }}" href="{{ route('purchase.show', $purchase->id) }}">
                                            <i class="bi bi-eye-fill"></i><span class="tooltiptext">Mostrar</span>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-sm {{ $purchase->enabled ? 'enable' : '' }}">
                                            <i class="bi bi-x-circle"></i><span class="tooltiptext">Anular</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $purchases->links() !!}
    </div>
</div>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- XLSX JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        });
    });

    function togglePurchaseStatus(purchaseId, currentStatus) {
        // Confirmar con el usuario antes de realizar la acción
        if (!confirm('¿Estás seguro de anular esta compra?')) {
            return;
        }
        // Realizar una solicitud AJAX para actualizar el estado de la compra
        $.ajax({
            url: '/toggle-purchase-status/' + purchaseId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                current_status: currentStatus
            },
            success: function(response) {
                // Si la solicitud es exitosa, actualizar el estado del botón y recargar la página si es necesario
                if (response.success) {
                    var button = document.getElementById('toggle-button-' + purchaseId);
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-secondary');
                    button.innerHTML = '<i class="fa fa-fw fa-times-circle"></i> Anulado';
                    button.disabled = true;
                    alert('La compra se ha anulado correctamente.');
                } else {
                    alert('Hubo un error al anular la compra.');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Error de servidor. Por favor, inténtalo de nuevo más tarde.');
            }
        });
    }

    function printTable() {
        var printContents = document.getElementById("myTable").outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function exportToExcel() {
        var currentDate = new Date();
        var dateString = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
        var fileName = 'compras_' + dateString + '.xlsx';

        var data = [];
        var table = document.getElementById('myTable');
        var rows = table.rows;
        for (var i = 0; i < rows.length; i++) {
            var rowData = [];
            for (var j = 0; j < rows[i].cells.length - 1; j++) {
                rowData.push(rows[i].cells[j].innerText);
            }
            data.push(rowData);
        }

        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet JS");
        XLSX.writeFile(wb, fileName);
    }
</script>
@endsection