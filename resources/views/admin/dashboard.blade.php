@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración</p>
    <canvas id="myChart" width="400" height="400"></canvas>
@stop

@section('js')
    <!-- Carga de Chart.js -->
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    

    <script>
        // Valores de ejemplo; reemplázalos por valores enviados desde el controlador
        const labels = ["col1", "col2", "col3"];
        const data = [10, 9, 15];

        // Configuración del gráfico
        const ctx = document.getElementById("myChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [col1, col2. col3],
                datasets: [{
                    label: "Num datos",
                    data: [10, 9, 15],
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop
