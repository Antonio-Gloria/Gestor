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
            <h2 class="text">Lista de servicios realizados</h2>
            <hr>
            <br>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('servicios.index') }}" class="btn btn-outline-primary">
                    Regresar
                </a>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Id Servicio</th>
                                <th>Tipo de servicio solicitado</th>
                                <th>Fecha de solicitud</th>
                                <th>Hora</th>
                                <th>Nombre del solicitante</th>
                                <th>Apellido del solicitante</th>                             
                                <th>Fecha de realización</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicios as $servicio)
                                <tr>
                                    <td>{{ $servicio[0] }}</td> <!-- Acciones -->
                                    <td>{{ $servicio[1] }}</td> <!-- Id Servicio -->
                                    <td>{{ $servicio[2] }}</td> <!-- Tipo de servicio solicitado -->
                                    <td>{{ $servicio[3] }}</td> <!-- Fecha -->
                                    <td>{{ $servicio[4] }}</td> <!-- Hora -->
                                    <td>{{ $servicio[5] }}</td> <!-- Nombre del solicitante -->
                                    <td>{{ $servicio[6] }}</td> <!-- Apellido del solicitante -->
                                    <td> {{$servicio[7]}} </td> <!-- FechaRealizado -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            <a href="" id="borrar" class="btn btn-danger">Eliminar</a>
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
            console.log(parametro);
            $('#nombre').html('¿Está seguro de eliminar este servicio realizado con ID ' + parametro + '?');
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
                dom: '<"row mb-3"<"col-lg-3"l><"col-lg-5"B><"col-lg-4"f>>rtip',
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

            jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                "portugues-pre": function(data) {
                    var specialLetters = {
                        "Á": "a",
                        "á": "a",
                        "Ã": "a",
                        "ã": "a",
                        "À": "a",
                        "à": "a",
                        "É": "e",
                        "é": "e",
                        "Ê": "e",
                        "ê": "e",
                        "Í": "i",
                        "í": "i",
                        "Î": "i",
                        "î": "i",
                        "Ó": "o",
                        "ó": "o",
                        "Õ": "o",
                        "õ": "o",
                        "Ô": "o",
                        "ô": "o",
                        "Ú": "u",
                        "ú": "u",
                        "Ü": "u",
                        "ü": "u",
                        "Ç": "c",
                        "ç": "c"
                    };
                    for (var val in specialLetters) {
                        data = data.split(val).join(specialLetters[val]).toLowerCase();
                    }
                    return data;
                },
                "portugues-asc": function(a, b) {
                    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                },
                "portugues-desc": function(a, b) {
                    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                }
            });
        });
    </script>
@endsection
