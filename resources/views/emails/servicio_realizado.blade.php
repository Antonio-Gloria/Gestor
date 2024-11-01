<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Realizado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
    
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 25px;
            transition: box-shadow 0.3s ease;
        }
    
        .container:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
    
        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 24px;
            font-size: 28px;
            font-weight: bold;
        }
    
        p {
            font-size: 17px;
            line-height: 1.7;
            margin: 12px 0;
            color: #555;
        }
    
        ul {
            margin: 15px 0;
            padding: 0;
            list-style: none;
        }
    
        li {
            background: #e7f3fe;
            margin: 6px 0;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    
        li:before {
            content: "✔️";
            color: #4CAF50;
            font-size: 16px;
        }
    
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #777;
        }
    
        .footer a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
    
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
    
</head>

<body>
    <div class="container">
        <h1>Confirmación de Servicio Realizado</h1>

        <p>Hola, {{ $data['nombre_solicitante'] }} {{ $data['apellido_solicitante'] }}</p>

        <p>Tu solicitud de servicio ha sido realizado con éxito. Aquí están los detalles del servicio:</p>

        <ul>
            <li><strong>Tipo de Servicio: </strong> {{ $data['tipo_servicio'] }}</li>
            <li><strong>Fecha: </strong> {{ $data['fecha'] }}</li>
            <li><strong>Descripción: </strong> {{ $data['descripcion'] }}</li>
            <li><strong>Técnico: </strong> {{ $data['tecnico'] }}</li>
            <li><strong>Fecha de realización: </strong> {{ $data['fechaRealizado'] }} </li>
        </ul>

        <p>Gracias por solicitar nuestros servicios.</p>
    </div>


    <div class="footer">
        &copy; 2024 CUCSH
    </div>
</body>

</html>
