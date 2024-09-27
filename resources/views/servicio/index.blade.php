@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{asset('build/assets/app.css')}}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{asset('build/assets/app.js')}}"></script>

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
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('realizar-servicio') }}" method="POST" id="formRealizado">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRealizadoLabel">Descripción del Servicio Realizado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="servicioId" name="servicioId" value="">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                          <div class="form-group">
                    <label for="tipo_servicio_id">Técnico</label>
                    <select class="form-control" id="tecnico_id" name="tecnico_id" required>
                        <option value="" disabled selected>Asigna un técnico</option>
                        @foreach($tecnicos as $tecnico)
                            <!-- Recorre los tecnicos disponibles y crea una opción para cada uno -->
                            <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
<!-- Button trigger modal -->


 @section('js')


<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script type="text/javascript">
function modal(parametro){
   console.log(parametro);
   $('#nombre').html(parametro);


   let url = "{{route('realizado-servicio', ':id')}}";
   url = url.replace(':id',parametro);
   document.getElementById('borrar').href= url;
  
}
   var data = @json($servicios);

   $(document).ready(function() {
       $('#example').DataTable({
           "data": data,
           "pageLength": 100,
           "order": [
               [0, "desc"]
           ],
           "language": {
               "sProcessing": "Procesando...",
               "sLengthMenu": "Mostrar _MENU_ registros",
               "sZeroRecords": "No se encontraron resultados",
               "sEmptyTable": "Ningún dato disponible en esta tabla",
               "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
               "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
               "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
               "sInfoPostFix": "",
               "sSearch": "Buscar:",
               "sUrl": "",
               "sInfoThousands": ",",
               "sLoadingRecords": "Cargando...",
               "oPaginate": {
                   "sFirst": "Primero",
                   "sLast": "Último",
                   "sNext": "Siguiente",
                   "sPrevious": "Anterior"
               },
               "oAria": {
                   "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                   "sSortDescending": ": Activar para ordenar la columna de manera descendente"
               }
           },
           responsive: true,
           dom: 'Bfrtip',
           dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
           buttons: [
               'copy', 'excel',
               {
                   extend: 'pdfHtml5',
                   orientation: 'landscape',
                   pageSize: 'LETTER',
               }




           ]
       })




   });




   jQuery.extend(jQuery.fn.dataTableExt.oSort, {
       "portugues-pre": function(data) {
           var a = 'a';
           var e = 'e';
           var i = 'i';
           var o = 'o';
           var u = 'u';
           var c = 'c';
           var special_letters = {
               "Á": a,
               "á": a,
               "Ã": a,
               "ã": a,
               "À": a,
               "à": a,
               "É": e,
               "é": e,
               "Ê": e,
               "ê": e,
               "Í": i,
               "í": i,
               "Î": i,
               "î": i,
               "Ó": o,
               "ó": o,
               "Õ": o,
               "õ": o,
               "Ô": o,
               "ô": o,
               "Ú": u,
               "ú": u,
               "Ü": u,
               "ü": u,
               "ç": c,
               "Ç": c
           };
           for (var val in special_letters)
               data = data.split(val).join(special_letters[val]).toLowerCase();
           return data;
       },
       "portugues-asc": function(a, b) {
           return ((a < b) ? -1 : ((a > b) ? 1 : 0));
       },
       "portugues-desc": function(a, b) {
           return ((a < b) ? 1 : ((a > b) ? -1 : 0));
       }
   });
   //"columnDefs": [{ type: 'portugues', targets: "_all" }],
</script>
@endsection