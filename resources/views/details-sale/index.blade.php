@extends('layouts.app')

@section('template_title')
    Details Sale
@endsection

@section('content')
<style>
  /* Estilos adicionales para la tabla */
  #detailsSalesTable {
    width: 100%;
    border-collapse: collapse;
  }
  #detailsSalesTable th,
  #detailsSalesTable td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  #detailsSalesTable th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
  #detailsSalesTable tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  #detailsSalesTable tr:hover {
    background-color: #ddd;
  }
  .pagination-container {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px; 
  }
  
  /* Estilos para los botones de acciones */
  .btn-group {
    display: flex;
    justify-content: flex-start;
  }
  .btn-group .btn {
    margin-right: 5px;
    border-radius: 20px !important;
    max-width: 80px; 
  }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Details Sale') }}
                        </span>

                        <div class="float-right">
                            <button class="btn btn-info btn-sm mr-2" onclick="exportToExcel()">
                              <i class="fas fa-file-excel"></i> {{ __('Export to Excel') }}
                            </button>
                            <button class="btn btn-info btn-sm d-print-none" type="button" onclick="printTable()">
                              <i class="fas fa-print"></i> {{ __('Print') }}
                            </button>
                            <a href="{{ route('details_sale.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                              {{ __('Create New') }}
                            </a>
                          </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="detailsSalesTable" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Products Id</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Sales Id</th>
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailsSales as $detailsSale)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $detailsSale->products_id }}</td>
                                        <td>{{ $detailsSale->amount }}</td>
                                        <td>{{ $detailsSale->discount }}</td>
                                        <td>{{ $detailsSale->sales_id }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                <a class="btn btn-sm btn-primary" href="{{ route('details_sale.show', $detailsSale->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('details_sale.edit', $detailsSale->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteDetailsSale('{{ $detailsSale->id }}')"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                <form id="delete-form-{{ $detailsSale->id }}" action="{{ route('details_sale.destroy', $detailsSale->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container">
                        {!! $detailsSales->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- XLSX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
    function printTable() {
        var printContents = document.getElementById("detailsSalesTable").outerHTML; // Obtén el HTML de la tabla
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function exportToExcel() {
        var currentDate = new Date();
        var dateString = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
        var fileName = 'details_sales_' + dateString + '.xlsx';

        var data = [];
        var table = document.getElementById('detailsSalesTable');
        var rows = table.rows;
        for (var i = 0; i < rows.length; i++) {
            var rowData = [];
            for (var j = 0; j < rows[i].cells.length - 1; j++) { // Cambio aquí para excluir la última celda (Acciones)
                rowData.push(rows[i].cells[j].innerText);
            }
            data.push(rowData);
        }

        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet JS");
        XLSX.writeFile(wb, fileName);
    }

    function confirmDeleteDetailsSale(detailsSaleId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }) .then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + detailsSaleId).submit();
            }
        });
    }
</script>
@endsection
