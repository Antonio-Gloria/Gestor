@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="row">
            <h2 class="text">Lista de servicios por realizar</h2>
            <hr>
            <br>
            <!-- <div class="d-flex justify-content-center"> -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('servicios.create') }}" class="btn btn-outline-success me-2">Solicitar Servicio</a>
                <a href="{{ route('servicios.realizado') }}" class="btn btn-outline-info me-2">Ir a Servicios Realizados</a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary">Regresar</a>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Id Servicio</th>
                                <th>Tipo de Servicio Solicitado</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Nombre del Solicitante</th>
                                <th>Apellido del Solicitante</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicios as $servicio)
                                <tr>
                                    <td>{{ $servicio[0] }}</td>
                                    <td>{{ $servicio[1] }}</td>
                                    <td>{{ $servicio[2] }}</td>
                                    <td>{{ $servicio[3] }}</td>
                                    <td>{{ $servicio[4] }}</td>
                                    <td>{{ $servicio[5] }}</td>
                                    <td>{{ $servicio[6] }}</td>
                                    <td>{{ $servicio[7] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                function openRealizadoModal(id) {
                    document.getElementById('servicioId').value = id;
                    var modal = new bootstrap.Modal(document.getElementById('modalRealizado'));
                    modal.show();
                }
            </script>

            <!-- Modal -->
            <div class="modal fade" id="modalRealizado" tabindex="-1" aria-labelledby="modalRealizadoLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <form action="{{ route('realizar-servicio') }}" method="POST" id="formRealizado">
                            @csrf
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="modalRealizadoLabel">
                                    <i class="fas fa-file-alt"></i> Confirmación
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-light">
                                <input type="hidden" id="servicioId" name="servicioId" value="">
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción del Servicio</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="tecnico_id" class="form-label">Asignar Técnico</label>
                                    <select class="form-select" id="tecnico_id" name="tecnico_id" required>
                                        <option value="" disabled selected>Selecciona un Técnico</option>
                                        @foreach ($tecnicos as $tecnico)
                                            <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha"
                                        value="{{ old('fecha') }}">
                                </div>
                            </div>
                            <div class="modal-footer bg-dark text-white">
                                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Cerrar
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="nombre"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="" id="borrar" class="btn btn-danger">Borrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function modal(parametro) {
            $('#nombre').html('¿Está seguro de eliminar el servicio con ID ' + parametro + '?');
            let url = "{{ route('delete-servicio', ':id') }}";
            url = url.replace(':id', parametro);
            document.getElementById('borrar').href = url;
        }

        var data = @json($servicios);

        $(document).ready(function() {
            $('#example').DataTable({
                data: data,
                pageLength: 10,
                order: [
                    [0, "desc"]
                ],
                responsive: true,
                dom: '<"row mb-3[]"<"col-lg-3"l><"col-lg-5"B><"col-lg-4"f>>rtip',
                buttons: [
                    'copy', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LETTER'
                    }
                ],
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sSearch: "Buscar:",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

            $('#modalRealizado').on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInput = document.getElementById('fecha');
            fechaInput.value = new Date().toISOString().split('T')[0];
            fechaInput.readOnly = true;
        });
    </script>
@endsection
