<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfesorRequest;
use App\Http\Requests\UpdateProfesorRequest;
use App\Models\Profesor;
use Illuminate\Support\Facades\Request;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesor::paginate(7);
        $page = Request::get('page') ?? 1;
        return view("profesores.listado", compact("profesores", "page"));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = Request::get('page');
        return view("profesores.create", compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfesorRequest $request)
    {
        $page = Request::get('page');
        $valores = $request->input();
        $profesor = new Profesor($valores);
        $profesor->save();
        session()->flash("status", "Se ha creado el profesor $profesor->nombre");

        return redirect(route('profesores.index' ,['page'=>$page]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor)
    {
        $page = Request::get("page");

        return view ("profesores.editar", ["profesor"=>$profesor,"page"=>$page]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfesorRequest $request, Profesor $profesor)
    {
        $page = $request->input('page');
        $valores = $request->input();
        $profesor->update($valores);
       /*  return response()->redirectTo(route("profesores.index",["page"=>$page])); */
       return response()->redirectTo(route("profesores.index",["page"=>$page]));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesor)
    {
        $profesor->delete();
        return back();
// return redirect (route("alumnos.index"));
//
    }
}
