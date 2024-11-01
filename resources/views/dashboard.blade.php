@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1><strong>Dashboard</strong></h1>
@stop

@section('content')
    <p><strong>Bienvenido al panel de administración</strong></p>
    <canvas id="myChart" width="400" height="200"></canvas>
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
                    backgroundColor: "rgba(70, 255, 51, 0.9)",
                    borderColor: "rgba(17, 152, 37, 1)",
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Días',
                            color: 'black'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            color: 'black',
                            text: 'Semanas'
                        }
                    }
                }
            }
        });
    });
</script>


@stop