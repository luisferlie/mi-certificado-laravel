<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Models\Alumno;
use Illuminate\Support\Facades\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::paginate(5);
        $page = Request::get('page') ?? 1;

//         return view("alumnos.listado",["alumnos"=> $alumnos, "page"=>$page]);

        return view("alumnos.listado", compact("alumnos", "page"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = Request::get('page');
        return view("alumnos.create", compact('page'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlumnoRequest $request){
        $page = Request::get('page');
        $alumno = new Alumno($request->input());
        $alumno->saveOrFail();
        return redirect(route('alumnos.index' ,['page'=>$page]));
        }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return view ("alumnos.show", compact("alumno"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        $page = Request::get("page");

        return view("alumnos.editar", ["alumno" => $alumno, "page" => $page]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlumnoRequest $request, Alumno $alumno)
    {

        $page = Request::get("page");
        $valores = $request->input(); //Leo los valores del formulario
        $alumno->update($valores);

        //Opciones alternativas para retornar
//        return redirect(route("alumnos.index", ["page"=>$page]));
//        return redirect(route("alumnos.index", compact("page")));
//        return redirect("/alumnos?page=$page");

        return response()->redirectTo(route("alumnos.index", ["page" => $page]));
//        header ("Location:http://localhost:8000/alumnos?page=$page");

//        return view ("alumnos.listado",["alumnos"=>$alumnos,"page"=>$page]);

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        $alumnos = Alumno::all();
        return view ("alumnos.listado",["alumnos"=>$alumnos]);
       /*  $alumno->delete(); */
        /* $alumnos = Alumno::paginate(5);
        return view ("alumnos.listado",["alumnos"=>$alumnos]); */
        /* return back(); */

    }
}
