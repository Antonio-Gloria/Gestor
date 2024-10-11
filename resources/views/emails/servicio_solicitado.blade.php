<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Servicio Solicitado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        ul {
            margin: 10px 0;
            padding: 0;
            list-style: none;
        }
        li {
            background: #e7f3fe;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmación de Servicio Solicitado</h1>

        <p>Hola, {{ $servicio->nombre_solicitante }} {{ $servicio->apellido_solicitante }}</p>
        
        <p>Tu solicitud de servicio ha sido recibida con éxito. Aquí están los detalles del servicio:</p>
        
        <ul>
            <li><strong>Tipo de servicio:</strong> {{ $servicio->tiposervicio->nombre }}</li>
            <li><strong>Fecha:</strong> {{ $servicio->fecha }}</li>
            <li><strong>Hora:</strong> {{ $servicio->hora }}</li>
            <li><strong>Estado:</strong> {{ $servicio->estado }}</li>
        </ul>
        
        <p>Gracias por solicitar nuestros servicios.</p>
    </div>
    <div class="footer">
        &copy; 2024 CUCSH
    </div>
</body>
</html>
