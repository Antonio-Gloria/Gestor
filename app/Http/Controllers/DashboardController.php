<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Servicio; // Importa el modelo de la tabla "servicios"
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtén los datos y calcula la diferencia en días entre "fecha" y "fechaRealizado"
        $data = Servicio::select(
                DB::raw('YEAR(fecha) as year'),
                DB::raw('WEEK(fecha) as week'),
                DB::raw('AVG(DATEDIFF(fechaRealizado, fecha)) as avg_days')
            )
            ->whereNotNull('fechaRealizado') // Excluye registros sin fecha de realización
            ->groupBy('year', 'week') // Agrupa por año y semana
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        // Crea las etiquetas (semanas) y los datos (diferencias de días promedio)
        $labels = $data->map(fn($item) => 'Semana ' . $item->week . ' - ' . $item->year);
        $daysDifference = $data->map(fn($item) => round($item->avg_days, 2));

        // Pasa las variables a la vista
        return view('dashboard', compact('labels', 'daysDifference'));
    }
}
