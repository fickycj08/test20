<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class jadwalservis extends Controller
{
    public function index ()
    {
        return view('jadwalservis.index');
    }
}
