<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Realizado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
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
        <h1>Servicio Realizado</h1>
        <p><strong>Tipo de Servicio:</strong> {{ $data['tipo_servicio'] }}</p>
        <p><strong>Nombre del Solicitante</strong> {{ $data['nombre_solicitante']}} </p>
        <p><strong>Apellido del Solicitante:</strong> {{ $data['apellido_solicitante'] }}</p>
        <p><strong>Fecha:</strong> {{ $data['fecha'] }}</p>
        <p><strong>Descripción:</strong> {{ $data['descripcion'] }}</p>
        <p><strong>Técnico:</strong> {{ $data['tecnico'] }}</p>
    </div>

    <p>Gracias por solicitar nuestros servicios.</p>
    <div class="footer">
        &copy; 2024 CUCSH
    </div>
</body>
</html>
