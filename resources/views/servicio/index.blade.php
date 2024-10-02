@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="{{asset('build/assets/app.css')}}">



<!-- app-DBdvkBoY.js  app-D-sv12UV.css -->
@endsection
@section('content')
   <div class="container">
       <div class="row">
           @if (session('message'))
               <div class="alert alert-success">
                   {{ session('message') }}
               </div>
           @endif
       </div>

       <div class="container py-8">
      
        <h1 class="text-3xl font-bold text-red-500 shadow-lg text-center">Lista de Servicios por Realizar</h1>


           <hr>
           <br>
           <p align="right">
               <a href="{{ route('servicios.create') }}" class="btn btn-success">Solicitar servicio</a>
               <a href="{{ route('servicios.realizado')}}" class="btn btn-info">Ir a servicios realizados</a>
               <a href="{{ route('home') }}" class="btn btn-primary">
                   Regresar
               </a>
           </p>
           <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                   <tr>
                       <th>Acciones</th>
                       <th>Id Servicio</th>
                       <th>Tipo de servicio solicitado</th>
                       <th>Fecha</th>
                       <th>Hora</th>
                       <th>Nombre del solicitante</th>
                       <th>Apellido del solicitante</th>
                       <th>Tipo</th>
                       
                   </tr>
               </thead>
               <tbody>
                    @foreach($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio[0] }}</td> <!-- Acciones -->
                        <td>{{ $servicio[1] }}</td> <!-- Id Servicio -->
                        <td>{{ $servicio[2] }}</td> <!-- Tipo de servicio solicitado -->
                        <td>{{ $servicio[3] }}</td> <!-- Fecha -->
                        <td>{{ $servicio[4] }}</td> <!-- Hora -->                     
                        <td>{{ $servicio[5] }}</td> <!-- Nombre del solicitante -->
                        <td>{{ $servicio[6] }}</td> <!-- Apellido del solicitante -->
                        <td>{{ $servicio[7] }}</td>
                        
                    </tr>
                    @endforeach

                </tbody>
                <script>
                    function openRealizadoModal(id) {
                        document.getElementById('servicioId').value = id;
                        var modal = new bootstrap.Modal(document.getElementById('modalRealizado'));
                        modal.show();
                    }
                </script>
                
           </table>
       </div>
   </div>
  
 <!-- Modal -->
 <div class="modal fade" id="modalRealizado" tabindex="-1" aria-labelledby="modalRealizadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('realizar-servicio') }}" method="POST" id="formRealizado">
                @csrf
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalRealizadoLabel">
                        <i class="fas fa-file-alt"></i> Detalles del Servicio Realizado
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <option value="" disabled selected>Selecciona un técnico</option>
                            @foreach($tecnicos as $tecnico)
                                <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                            @endforeach
                        </select>
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

@endsection

@section('js')

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script type="text/javascript">
   
    function modal(parametro) {
        console.log(parametro);
        $('#nombre').html(parametro);

        let url = "{{ route('realizado-servicio', ':id') }}";
        url = url.replace(':id', parametro);
        document.getElementById('borrar').href = url;
    }

    var data = @json($servicios);

    $(document).ready(function() {
     
        $('#example').DataTable({
            data: data, 
            pageLength: 100, 
            order: [[0, "desc"]], 
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
                    "Á": "a", "á": "a", "Ã": "a", "ã": "a", "À": "a", "à": "a",
                    "É": "e", "é": "e", "Ê": "e", "ê": "e", "Í": "i", "í": "i",
                    "Î": "i", "î": "i", "Ó": "o", "ó": "o", "Õ": "o", "õ": "o",
                    "Ô": "o", "ô": "o", "Ú": "u", "ú": "u", "Ü": "u", "ü": "u",
                    "Ç": "c", "ç": "c"
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
