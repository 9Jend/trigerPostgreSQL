<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;

class StatisticController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('userBusketCount');
    }

    public function index()
    {
        $statistic = Statistic::all();
        return view('statistic/index', compact('statistic'));
    }
}
