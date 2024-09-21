<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Servicio Solicitado</title>
</head>
<body>
    <h1>Confirmación de Servicio Solicitado</h1>

    <p>Hola, {{ $servicio->nombre_solicitante }} {{ $servicio->apellido_solicitante }}</p>
    
    <p>Tu solicitud de servicio ha sido recibida con éxito. Aquí están los detalles del servicio:</p>
    
    <ul>
        <li>Tipo de servicio: {{ $servicio->tiposervicio->nombre }}</li>
        <li>Fecha: {{ $servicio->fecha }}</li>
        <li>Hora: {{ $servicio->hora }}</li>
        <li>Estado: {{ $servicio->estado }}</li>
    </ul>
    
    <p>Gracias por solicitar nuestros servicios.</p>
</body>
</html>
