<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imagenes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datos = imagenes::all();
          return view('subir-imagen',compact('datos'));
    }
    public function welcome()
    {
        $datos = imagenes::all();
          return view('welcome',compact('datos'));
    }
}
