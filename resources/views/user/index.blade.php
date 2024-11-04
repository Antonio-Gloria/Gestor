@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('content')
    <div class="container">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="row">
            <h2 class="text">Lista de Usuarios</h2>
            <hr>
            <br>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('users.create') }}" class="btn btn-outline-success me-2">Crear nuevo usuario</a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary">Regresar</a>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roles</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
          
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <p id="nombre"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="borrar"></div> 
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
    $('#nombre').html('¿Está seguro de eliminar al usuario con ID ' + parametro + '?');

    let url = "{{ route('users.destroy', ':id') }}";
    url = url.replace(':id', parametro);

    let formHtml = `
        <form id="deleteForm" action="` + url + `" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    `;

    document.getElementById('borrar').innerHTML = formHtml;
}


        var data = @json($users);

        $(document).ready(function() {
            $('#example').DataTable({
                data: data,
                pageLength: 10,
                order: [
                    [0, "desc"]
                ],
                responsive: true,
                dom: '<"row mb-3"<"col-lg-3"l><"col-lg-5"B><"col-lg-4"f>>rtip',
                buttons: ['copy', 'excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LETTER'
                }],
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
        });
    </script>
@endsection
