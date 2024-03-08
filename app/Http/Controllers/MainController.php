<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $n=rand(1,100);
        $alumnos=Alumno::all();
        return view('saludo',compact('n','alumnos'));
    }
}
