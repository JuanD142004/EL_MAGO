@extends('layouts.app')

@section('template_title')
Venta
@endsection

@section('content')
<br>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">

  <style>
    .btn-dark-blue {
            background-color: #004085;
            border-color: #003768;
            color: #fff;
        }

        .btn-dark-blue:hover,
        .btn-dark-blue:focus,
        .btn-dark-blue:active {
            background-color: #004085;
            border-color: #003768;
            color: #fff;
            opacity: 1;
        }

        .btn-dark-blue.enabled, 
        .btn-dark-blue:enabled {
            background-color: #004085;
            border-color: #003768;
            opacity: 0.65;
        }
  </style>



<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <span id="card_title">{{ __('Ventas') }}</span>
            <div class="float-right">
              <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm ml-2 d-print-none" data-placement="left">
                <i class="fas fa-plus"></i> {{ __('Crear Nuevo') }}
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
                  <th>Mostrar</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sales as $sale)
                <tr>
                  <td>{{ $sale->id }}</td>
                  <td>{{ $sale->customer->id }} - {{ $sale->customer->customer_name }}</td>
                  <td>{{ $sale->price_total }}</td>
                  <td>{{ $sale->payment_method }}</td>
                  <td class="d-print-none">
                      <a class="btn btn-sm btn-dark-blue" href="{{ route('sales.show', $sale->id) }}" {{ $sale->enabled ? '' : 'disabled' }}>
                          <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                      </a>
                  </td>
                  <td>
                      @if($sale->enabled)
                          <button type="button" id="toggle-button-{{ $sale->id }}" class="btn btn-sm btn-success" onclick="toggleSaleStatus('{{ $sale->id }}', {{ $sale->enabled ? 'false' : 'true' }})">
                              <i class="fa fa-fw fa-ban"></i> {{ __('Anular') }}
                          </button>
                      @else
                          <button type="button" id="toggle-button-{{ $sale->id }}" class="btn btn-sm btn-warning" disabled>
                              <i class="fa fa-fw fa-times-circle"></i> {{ __('Anulado') }}
                          </button>
                      @endif
                      <form id="toggle-form-{{ $sale->id }}" action="{{ route('sales.toggle', $sale->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('PUT')
                      </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>

<script>
    $(document).ready(function() {
        $('#salesTable').DataTable({
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

   window.toggleSaleStatus = function(saleId, status) {
      var form = document.getElementById('toggle-form-' + saleId);
      var action = status ? 'Anular' : 'Anulado';

      Swal.fire({
        title: '¿Estás seguro?',
        text: `Esta acción cambiará el estado de la venta a ${status ? 'Anular' : 'Anulado'}.`,
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
    };
  

  function sortSalesTable() {
    var tbody = document.getElementById('salesTableBody');
    var rows = Array.from(tbody.getElementsByTagName('tr'));

    rows.sort((a, b) => {
      var aStatus = parseInt(a.cells[5].innerText);
      var bStatus = parseInt(b.cells[5].innerText);
      return bStatus - aStatus;
    });

    rows.forEach(row => tbody.appendChild(row));
  }
</script>

@endsection
