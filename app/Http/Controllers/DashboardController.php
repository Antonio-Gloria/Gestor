<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.index')->only('index');
   
    }
    public function index()
    {
       
        $data = Servicio::select(
                DB::raw('YEAR(fecha) as year'),
                DB::raw('WEEK(fecha) as week'),
                DB::raw('AVG(DATEDIFF(fechaRealizado, fecha)) as avg_days')
            )
            ->whereNotNull('fechaRealizado') 
            ->groupBy('year', 'week') 
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        $labels = $data->map(fn($item) => 'Semana ' . $item->week . ' - ' . $item->year);
        $daysDifference = $data->map(fn($item) => round($item->avg_days, 2));

        return view('dashboard', compact('labels', 'daysDifference'));
    }
}
