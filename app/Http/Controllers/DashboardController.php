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

        $servicios = Servicio::select('fecha', 'fechaRealizado')
            ->get()
            ->groupBy(function ($date) {
                return date('W-Y', strtotime($date->fecha));
            })
            ->sortByDesc(function($_, $key){
                return $key;
            });
            
        $labels = [];
        $daysDifference = [];

        foreach ($servicios as $weekYear => $records) {

            [$week, $year] = explode('-', $weekYear);

            $referenceDate = $records->first()->fecha;
            $startDate = date('Y-m-d', strtotime("{$year}-W{$week}-1"));
            $endDate = date('Y-m-d', strtotime("{$year}-W{$week}-7"));
            $totalDays = 0;
            $count = count($records);

            foreach ($records as $record) {
                $diff = (strtotime($record->fechaRealizado) - strtotime($record->fecha)) / 86400;
                $totalDays += $diff;
            }

            $averageDays = $count ? $totalDays / $count : 0;

            $labels[] = "Semana {$week} ({$startDate} - {$endDate})";
            $daysDifference[] = $averageDays;
        }

        return view('dashboard', compact('labels', 'daysDifference'));
    }
}
