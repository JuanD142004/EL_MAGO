@extends('layouts.app')

@section('template_title')
Purchase
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            <div class="col-sm-12">
                <form class="d-flex my-2" action="{{ route('purchase.index') }}" method="GET">
                    <div class="mr-2">
                        <input type="text" class="form-control" name="search" placeholder="Buscar por nombre">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary ms-2" value="Buscar">
                    </div>
                </form>
            </div>


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

                            <a href="{{ route('purchase.create') }}" class="btn  btn-primary btn-sm float-right" data-placement="left">
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
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="purchaseTable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Total Value</th>
                                    <th>Num Bill</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $purchase->supplier->supplier_name }}</td>
                                    <td>{{ $purchase->date }}</td>
                                    <td>{{ $purchase->total_value }}</td>
                                    <td>{{ $purchase->num_bill }}</td>
                                    <td>
                                        <form id="toggle-form-{{ $purchase->id }}" action="{{ route('purchase.update_status', $purchase->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn btn-sm {{ $purchase->enabled ? 'btn-warning' : 'btn-success' }}" onclick="togglePurchaseStatus('{{ $purchase->id }}', '{{ $purchase->enabled ? 0 : 1 }}')">
                                                <i class="fa fa-fw {{ $purchase->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $purchase->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                            </button>

                                            <input type="hidden" name="status" value="{{ $purchase->enabled ? 0 : 1 }}">
                                        </form>
                                    </td>
                                    <td>
                                        @if ($purchase->enabled)
                                        <a class="btn btn-sm btn-success" href="{{ route('purchase.show', $purchase->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Show') }}</a>
                                        @else
                                        <button class="btn btn-sm btn-success" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Show') }}</button>
                                        @endif
                                    
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
</div>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    function printTable() {
        var printContents = document.getElementById("purchaseTable").outerHTML; // Obtén el HTML de la tabla
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
        var table = document.getElementById('purchaseTable');
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

    function togglePurchaseStatus(purchaseId, status) {
        var form = document.getElementById('toggle-form-' + purchaseId);
        var action = status ? 'habilitar' : 'inhabilitar';

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción cambiará el estado del proveedor a ' + (status ? 'habilitado' : 'inhabilitado') + '!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Sí, " + action,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection