<?php

    namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtén el conteo de servicios por mes
        $serviciosPorMes = Servicio::selectRaw('MONTH(fecha) as mes, COUNT(*) as cantidad')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Extrae las etiquetas y los datos en formato adecuado para el gráfico
        $meses = $serviciosPorMes->pluck('mes')->map(function ($mes) {
            return Carbon::create()->month($mes)->locale('es')->monthName; // Muestra nombre del mes en español
        });

        $cantidades = $serviciosPorMes->pluck('cantidad');

        // Pasar los datos como JSON a la vista
        return view('dashboard', compact('meses', 'cantidades'));
    }
}

