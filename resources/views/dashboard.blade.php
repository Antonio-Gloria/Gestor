@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración</p>
    <canvas id="myChart" width="50" height="50"></canvas>
@stop

@section('js')
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById("myChart").getContext("2d");

            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: @json($labels), 
                    datasets: [{
                        label: "Diferencia promedio en días por semana",
                        data: @json($daysDifference), 
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