@extends('layouts.app')

@section('template_title')
    Load
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Load') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('loads.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                  <i class="fas fa-plus"></i> {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Route Name</th>
                                        <th>Truck Type</th>
                                        <th>Estado de la carga</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loads as $load)
                                        <tr>
                                            <td>{{ $load->id }}</td>
                                            <td>{{ $load->date }}</td>
                                            <td>{{ $load->route->route_name }}</td>
                                            <td>{{ $load->truckType->truck_brand }}</td>
                                            <td>
                                                <form id="toggle-form-{{ $load->id }}" action="{{ route('load.update_status', $load) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="button" class="btn btn-sm {{ $load->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleSaleStatus({{ $load->id }}, {{ $load->enabled ? 0 : 1 }}, '{{ $load->date }}')">
                                                        <i class="fa fa-fw {{ $load->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $load->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                                    </button>
                                                    <input type="hidden" name="status" value="{{ $load->enabled ? 0 : 1 }}">
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('load.destroy', $load->id) }}" method="POST">
                                                    @if($load->enabled)
                                                        <a class="btn btn-sm btn-success" href="{{ route('load.edit', $load->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success disabled" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</button>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    <td>
                                                         <a class="btn btn-sm btn-primary" href="{{ route('load.show', $load->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    </td>

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
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar MENU registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del START al END de un total de TOTAL registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de MAX registros)",
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

        function toggleSaleStatus(loadId, status, loadDate) {
            var form = document.getElementById('toggle-form-' + loadId);
            var action = status ? 'habilitar' : 'inhabilitar';

            var now = new Date();
            var loadDateObject = new Date(loadDate);

            var differenceInMilliseconds = now - loadDateObject;
            var differenceInHours = differenceInMilliseconds / (1000 * 60 * 60);

            if (differenceInHours >= 24 || loadDateObject < now.setHours(now.getHours() - 24)) {
                Swal.fire({
                    title: 'No puedes habilitar la carga',
                    text: 'Han pasado más de 24 horas desde la creación de la carga o la fecha es anterior al día actual menos 24 horas.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: Esta acción cambiará el estado de la carga a ${status ? 'habilitado' : 'inhabilitado'}.,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: Sí, ${action},
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        }
    </script>
@endsection