@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{asset('build/assets/app.css')}}">

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

       <div class="row">
           <h2>Lista de técnicos </h2>
           <hr>
           <br>
           <p align="right">
               <a href="{{ route('tecnicos.create') }}" class="btn btn-success">Agregar a un nuevo técnico</a>
               <a href="{{ route('home') }}" class="btn btn-primary">
                   Regresar
               </a>
           </p>
           <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                   <tr>
                       <th>Acciones</th>
                       <th>Id Técnico</th>
                       <th>Nombre</th>
                       <th>Apellido</th> 
                       <th>Email</th> 
                       <th>Telefono</th>          
                   </tr>
               </thead>
               <tbody>

               </tbody>

           </table>
       </div>
   </div>
  
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <span id="nombre"></span>
        
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <a href="" id="borrar" class="btn btn-danger">borrar</a>
        
       </div>
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

    var data = @json($tecnicos);

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
