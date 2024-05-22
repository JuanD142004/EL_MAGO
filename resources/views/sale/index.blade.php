@extends('layouts.app')

@section('template_title')
Venta
@endsection

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">
              {{ __('Gestionar Ventas') }}
            </h5>
            <div class="float-right">
              <button class="btn btn-info btn-sm mr-2" onclick="exportToExcel()">
                <i class="fas fa-file-excel"></i> {{ __('Exportar a Excel') }}
              </button>
              <button class="btn btn-info btn-sm d-print-none" type="button" onclick="printTable()">
                <i class="fas fa-print"></i> {{ __('Imprimir') }}
              </button>
              <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm ml-2 d-print-none" data-placement="left">
                <i class="fas fa-plus-circle mr-1"></i> {{ __('Crear Nuevo') }}
              </a>
            </div>
          </div>
          @if ($message = Session::get('success'))
          <div class="alert alert-success mt-3">
            <p>{{ $message }}</p>
          </div>
          @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="salesTable" class="table table-striped table-hover">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Cliente</th>
                  <th>Total Precio</th>
                  <th>Método de Pago</th>
                  <th class="d-print-none">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @php $i = 0; @endphp
                @foreach ($sales as $sale)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $sale->customer->id }} - {{ $sale->customer->customer_name }}</td>
                  <td>{{ $sale->price_total }}</td>
                  <td>{{ $sale->payment_method }}</td>
                  <td class="d-print-none">
                    <div class="btn-group" role="group" aria-label="Acciones">
                      <a class="btn btn-primary rounded-pill mr-2" href="{{ route('sales.show', $sale->id) }}" {{ $sale->enabled ? '' : 'disabled' }}>
                        <i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}
                      </a>
                      <button type="button" id="toggle-button-{{ $sale->id }}" class="btn rounded-pill {{ $sale->enabled ? 'btn-danger' : 'btn-secondary' }}" onclick="toggleSaleStatus('{{ $sale->id }}', {{ $sale->enabled }})" {{ $sale->enabled ? '' : 'disabled' }}>
                        <i class="fa fa-fw {{ $sale->enabled ? 'fa-ban' : 'fa-times-circle' }}"></i> {{ $sale->enabled ? __('Anular') : __('Anulado') }}
                      </button>
                      <form id="toggle-form-{{ $sale->id }}" action="{{ route('sales.toggle', $sale->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="pagination-container">
              {!! $sales->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- XLSX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
  function printTable() {
    var printContents = document.getElementById("salesTable").outerHTML; // Obtén el HTML de la tabla
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }

  function exportToExcel() {
    var currentDate = new Date();
    var dateString = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
    var fileName = 'ventas_' + dateString + '.xlsx';

    var data = [];
    var table = document.getElementById('salesTable');
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

  function toggleSaleStatus(saleId, enabled) {
    if (enabled) {
      Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción anulará la venta!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, anular',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          var form = document.getElementById('toggle-form-' + saleId);
          form.submit();
        }
      });
    }
  }
</script>

@endsection