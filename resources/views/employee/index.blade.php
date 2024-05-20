@extends('layouts.app')

@section('template_title')
    Employee
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
<style>
    @font-face {
        font-family: Metropolis-Bold;
        src: url('{{ URL::asset("fonts/Metropolis-Bold.tff") }}');
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">{{ __('Empleados') }}</span>
                        <div class="float-right">
                                <a href="{{ route('employee.create') }}" class="btn btn-dark text-white btn-sm float-right" data-placement="left" >
                                    <i class="fas fa-plus"></i> {{ __('Crear Nuevo') }}
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
                        <table class="table table-striped table-hover" id="myTable" style="width:100%">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Numero de Documento</th>
                                    <th>Genero</th>
                                    <th>Estado Civil</th>
                                    <th>Eps</th>
                                    <th>Telefono</th>
                                    <th>Hijos</th>
                                    <th>Direccion</th>
                                    <th>Ruta</th>
                                    <th>Acciones</th>
                                    <th>Editar</th>
                                    <th>Mostrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $employee->user->name }}</td>
                                        <td>{{ $employee->user->email }}</td> <!-- Mostrar el correo electrónico -->
                                        <td>{{ $employee->document_number }}</td>
                                        <td>{{ $employee->gender }}</td>
                                        <td>{{ $employee->civil_status }}</td>
                                        <td>{{ $employee->eps }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->children }}</td>
                                        <td>{{ $employee->home }}</td>
                                        <td>{{ $employee->route->route_name }}</td>
                                        <td>
                                            <form id="toggle-form-{{ $employee->id }}" action="{{ route('employee.update_status', $employee->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="btn btn-sm {{ $employee->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleStatus({{ $employee->id }}, {{ $employee->enabled ? 0 : 1 }})">
                                                    <i class="fa fa-fw {{ $employee->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $employee->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                                </button>
                                                <input type="hidden" name="status" value="{{ $employee->enabled ? 0 : 1 }}">
                                            </form>
                                        </td>
                                        <td>
                                            @if ($employee->enabled)
                                                <a class="btn btn-sm btn-success" href="{{ route('employee.edit', $employee->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                            @else
                                                <button class="btn btn-sm btn-success" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($employee->enabled)
                                                <a class="btn btn-sm btn-success" href="{{ route('employee.show', $employee->id) }}"><i class="bi bi-eye"></i>  {{ __('Mostrar') }}</a>
                                            @else
                                                <button class="btn btn-sm btn-success" disabled><i class="bi bi-eye"></i> {{ __('Mostrar') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $employees->links() !!}
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

    function toggleStatus(employeeId, status) {
        const form = document.getElementById(`toggle-form-${employeeId}`);
        Swal.fire({
            title: '¿Estás seguro?',
            text: `Esta acción cambiará el estado del empleado a ${status ? 'habilitado' : 'inhabilitado'}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Sí, ${status ? 'habilitar' : 'inhabilitar'}`,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.querySelector('input[name="status"]').value = status;
                form.submit();
            }
        });
    };
</script>
@endsection
