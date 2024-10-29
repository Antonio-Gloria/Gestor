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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Si usas CDN, o ignora si ya lo tienes instalado -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById("myChart").getContext("2d");
            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Label1", "Label2", "Label3"], // Etiquetas de ejemplo
                    datasets: [{
                        label: "Datos de ejemplo",
                        data: [10, 20, 30], // Datos de ejemplo
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
        });
    </script>
@stop
