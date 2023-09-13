<?php

namespace App\Http\Controllers;

use App\Models\Afdeling;
use App\Models\Criteria;
use App\Models\Farm;
use App\Models\Perhitungan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $data = array();
        $data['kriteria'] = Criteria::with('detail_criteria')->get();
        $data['data'] = Perhitungan::with(['afdeling', 'parameter.plant'])->get();

        $kebun = Farm::all();

        return view('pages.home.dashboard', compact('data', 'kebun'));
    }
}
