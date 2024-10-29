@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración</p>
    <canvas id="myChart" width="100" height="100"></canvas>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById("myChart").getContext("2d");

            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: @json($labels), // Etiquetas de las semanas
                    datasets: [{
                        label: "Diferencia promedio en días por semana",
                        data: @json($daysDifference), // Diferencias de días promedio por semana
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Días'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Semanas'
                            }
                        }
                    }
                }
            });
        });
    </script>
@stop
