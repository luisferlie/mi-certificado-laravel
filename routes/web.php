<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfesorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::view("main", "main");
//Route::get("main", function(){
//    return view ("main");
//});
//Route::get("main", fn()=>view ("main"));
//Route::get("main", [MainController::class=>"index"]);


Route::view("/about", "about");
Route::view("saludo", "saludo");
Route::get("main",  MainController::class);

Route::resource("alumnos", AlumnoController::class);

Route::get("noticias/{id}", fn($numero)=>"<h1>Nocicioa numero $numero</h1>");

Route::resource("profesores", ProfesorController::class);
Route::resource("idiomas", \App\Http\Controllers\IdiomaController::class);

//Route::get("profesores",[ProfesorController::class, "index"]);
//Route::get("profesores/create",[ProfesorController::class, "create"]);
//Route::post("profesores",[ProfesorController::class, "store"]);
//Route::get("profesores/{profesor}/edit",[ProfesorController::class, "edit"]);
//Route::put("profesores/{profesor}",[ProfesorController::class, "update"]);
//Route::get("profesores/{profesor}",[ProfesorController::class, "show"]);
//Route::delete("profesores/{profesor}",[ProfesorController::class, "delete"]);






Route::get('/', function () {
    return view('main');
})->name("index");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get("param/{pxxx}", fn($valor)=>"<h1>Valor de la ruta $valor</h1>" );











