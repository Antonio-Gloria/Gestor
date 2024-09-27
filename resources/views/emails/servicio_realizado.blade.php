<!DOCTYPE html>
<html>
<head>
    <title>Servicio Realizado</title>
</head>
<body>
    <h1>Servicio Realizado</h1>
    <p>Tipo de Servicio: {{ $data['tipo_servicio'] }}</p>
    <p>Nombre del Solicitante: {{ $data['nombre_solicitante'] }}</p>
    <p>Apellido del Solicitante: {{ $data['apellido_solicitante'] }}</p>
    <p>Fecha: {{ $data['fecha'] }}</p>
    <p>Descripción: {{ $data['descripcion'] }}</p>
    <p>Tecnico: {{$data['tecnico']}} </p>
</body>

</html>
