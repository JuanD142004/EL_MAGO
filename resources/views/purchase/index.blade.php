@extends('layouts.app')

@section('template_title')
    Purchase
@endsection

@section('content')
    <br>
    <script>
        window.csrfToken = '{{ csrf_token() }}';
    </script>

    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body{
        background-image: url('/img/El_mago.jpg');
        background-size: cover; /* Ajusta la imagen para que cubra todo el fondo */
        background-position: center; /* Centra la imagen */
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        background-attachment: fixed;
        height: 100vh; /* Ajusta la altura al 100% de la ventana */
        width: 100vw; /* Ajusta el ancho al 100% de la ventana */
        padding:0;
        margin:0;
        overflow-x: hidden; /* Evita el desbordamiento horizontal */
    }


    .card {
            background-color: rgba(255, 255, 255, 0.7); /* Fondo blanco con 80% de opacidad */
            border: none; /* Sin bordes para la tarjeta */
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
        }


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

        .btn-dark-blue.disabled, 
        .btn-dark-blue:disabled {
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
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Compras') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear Nuevo') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
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
                                        <th>Mostrar</th>
                                        <th>Anular</th>
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
                                                <form id="form-anular-{{ $purchase->id }}" class="frData" action="{{ route('purchase.destroy', $purchase->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-sm btn-dark-blue" href="{{ route('purchase.show', $purchase->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i><span class="tooltiptext">Mostrar</span>
                                                    </a>

                                                    <td>
                                                    <button id="toggle-button-{{ $purchase->id }}" type="button"
                                                            class="btn btn-sm {{ $purchase->disable ? 'btn-warning' : 'btn-success' }}"
                                                            onclick="togglePurchaseStatus({{ $purchase->id }}, {{ $purchase->disable ? 1 : 0 }})"
                                                            {{ $purchase->disable ? 'disabled' : '' }}>
                                                        <i class="fa fa-fw {{ $purchase->disable ? 'fa-times-circle' : 'fa-ban' }}"></i>
                                                        <span class="tooltiptext">{{ $purchase->disable ? 'Anulado' : 'Anular' }}</span>
                                                    </button>
                                                    </td>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col-sm-12 -->
        </div> <!-- row -->
    </div> <!-- container-fluid -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        $(document).ready(function () {
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
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres anular esta compra?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, anular',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/toggle-purchase-status/' + purchaseId,
                type: 'POST',
                data: {
                    _token: window.csrfToken,
                    current_status: currentStatus
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Anulado', 'La compra se ha anulado correctamente.', 'success')
                        .then(() => {
                            let button = document.getElementById('toggle-button-' + purchaseId);
                            if (currentStatus === '1') {
                                button.classList.remove('btn-success');
                                button.classList.add('btn-warning');
                                button.disabled = true;
                                button.innerHTML = '<i class="fa fa-fw fa-times-circle"></i><span class="tooltiptext">Anulado</span>';
                            } else {
                                button.classList.remove('btn-warning');
                                button.classList.add('btn-success');
                                button.disabled = false;
                                button.innerHTML = '<i class="fa fa-fw fa-ban"></i><span class="tooltiptext">Anular</span>';
                            }
                             location.reload(); // Recarga la página después de la confirmación
                        });
                    } else {
                        Swal.fire('Error', 'Hubo un error al anular la compra.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire('Error', 'Error de servidor. Por favor, inténtalo de nuevo más tarde.', 'error');
                }
            });
        }
    });
}
    </script>
@endsection
