<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function IndexSupervisor(){
        $slide = Slide::all();
        return view('layouts.supervisor.index', compact(['slide']));
    }

    public function IndexOperator(){
        return view('layouts.operator.index');
    }
}
