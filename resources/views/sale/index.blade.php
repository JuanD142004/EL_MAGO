@extends('layouts.app')

@section('template_title')
Venta
@endsection

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">

<style>
  body,
  input,
  select,
  label,
  button {
    font-family: sans-serif;
  }
</style>

<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">
              {{ __('Gestionar Ventas') }}
            </h5>
            <div class="float-right">
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
            <table id="salesTable" class="table table-striped table-hover dataTable">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Cliente</th>
                  <th>Total Precio</th>
                  <th>Método de Pago</th>
                  <th class="d-print-none">Acciones</th>
                  <th style="display: none;">Estado</th>
                </tr>
              </thead>
              <tbody id="salesTableBody">
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
                      <button type="button" id="toggle-button-{{ $sale->id }}" class="btn rounded-pill {{ $sale->enabled ? 'btn-danger' : 'btn-secondary' }}" onclick="toggleSaleStatus('{{ $sale->id }}', '{{ $sale->enabled }}')">
                        <i class="fa fa-fw {{ $sale->enabled ? 'fa-ban' : 'fa-times-circle' }}"></i> {{ $sale->enabled ? __('Anular') : __('Anulado') }}
                      </button>
                      <form id="toggle-form-{{ $sale->id }}" action="{{ route('sales.toggle', $sale->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                      </form>
                    </div>
                  </td>
                  <td style="display: none;">{{ $sale->enabled ? 1 : 0 }}</td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    sortSalesTable();

    window.toggleSaleStatus = function(saleId, status) {
      var form = document.getElementById('toggle-form-' + saleId);
      var action = status ? 'inhabilitar' : 'habilitar';

      Swal.fire({
        title: '¿Estás seguro?',
        text: `Esta acción cambiará el estado de la venta a ${status ? 'inhabilitado' : 'habilitado'}.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Sí, ${action}`,
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    }
  });

  function sortSalesTable() {
    var tbody = document.getElementById('salesTableBody');
    var rows = Array.from(tbody.getElementsByTagName('tr'));

    rows.sort((a, b) => {
      var aStatus = parseInt(a.cells[5].innerText);
      var bStatus = parseInt(b.cells[5].innerText);
      return bStatus - aStatus; // Cambiado para que los anulados se muestren al final
    });

    rows.forEach(row => tbody.appendChild(row));
  }
</script>

@endsection