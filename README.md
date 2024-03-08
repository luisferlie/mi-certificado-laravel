## Creando un CRUD para profesores

### Creo en ecosistema

```bash
php artisan make:model Profesor --all
```

Esto crea los siguientes elementos:
* migracion (para creer las tablas)
* factoria (Crear valores para una fila de la tabla)
* seeder (invocar a la factoria de un model e insertar los valores en la tabla)
* controlador (los métodos que voy a ejecutar ante solicitudes del cliente) 
* modelo (clase para ineteractuar con una tabla de la bd y hacer acciones típicas como insertar, borrar, consultar, actualizar)
* request (autoriza, valida los datos del formulario)
* policy (ni idea, suena a políticas que definirás acceso)
* rutas (tengo que crearlas y dirán que recursos ofrece mi aplicación)

## Ajusto los valores por defecto

Cómo el modelo se llama Profesor y la tabla queiro que se llame prefores y no profesors, tengo que indicarlo:

### creando un crud de profesores
## creo ecosistema
```
 php artisan make:Profesor --all

``` 
con ello creamos el modelo,el controlador,el seeder, el factory,la migration,y el Policy,el StoreRequest y el UpdateRequest asociados al modelo.Quedando pendiente solo las rutas,que veremos posteriormente como crearlas para acer un crud.

levantamos contenedores con el servidor de base de datos y el gestor phpmyadmin

```
docker compose up -d --build
```

Bases de datos
- 
 -diseñamos la tabla en

 poblamos la tabla y realizamos las migraciones con 
 ```
 php migrate:migrate --seed
 ```
 ### Rutas

 fallback->nos permite ejecutar algo si al ruta no existe
```
Route::fallback(function(){})
Route::resouces('profesores',Alumnno::class)
```
Routes ::resources crea las rutas necesarias para hacer el crud(eliminar ,crear y almacenar en base de datos,editar un elemento base de datos)

### Poblar la base de datos 

en la migracion mofdificamos la funcion up() poniendo lklos campos de la tabla 
```
public function up(): void
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apellidos");
            $table->string("email")->unique();
            $table->string("dni")->unique();
            $table->string("departamento"); //['informática', "comercio", "imagen"]
            $table->timestamps();
        });
    }
```
con ello generamos la estructura de la tabla profesores

en la clase ProfesorFactory ponemos como se generarqan los datos
o bien a traves de Faker,como en los siguientes campos:

```
public function definition(): array
    {
        $departamentos = ['Infomática', "Comercio", "Imagen"];
        return [
            "nombre" => fake()->name(),
            "dni" => $this->getDni(),
            "apellidos" => fake()->lastName(),
            "email" => fake()->unique()->safeEmail(),
            "departamento" => fake()->randomElement($departamentos),


        ];
    }

```

    o bien generando una funcion especifica para algun campo:
```
    "dni" => $this->getDni(),
```

usando una funcion a medida:
```
     private function getDni(): string
    {

        $letras= "TRWAGMYFPDXBNJZSQVHLCKE";
        $numero = fake()->randomNumber(8);
        $letra = $letras[$numero%23];
        $dni = "$numero-$letra";
        return $dni;
    }
```
para poblar la base de datos usamos las clases seeder ,usualmente la Database seeder que lanza todas las demas

```
 public function run(): void
    {
        $this->call([
            AlumnoSeeder::class,
            ProfesorSeeder::class
        ]);
    }
```
En el ProfesorSeeder tenemos el poblado de la base de datos
```
public function run(): void
    {
        Profesor::factory()->count(100)->create();
    }
```


### CSS
Al instalar breeze con

```
composer require laravel/breeze --dev
 
php artisan breeze:install blade
```
se instala tailwindcss

si lo queremos instalar sin breeze
```
npm install -D tailwindcss postcss autoprefixerc
```
instalamos daisy ui para tener componentes desarrollados en tailwind
```
npm i -D daisyui@latest
plugins: [forms,require("daisyui")], en tailwind.config
```
para paginar y que cargue mi propio css desde vendor/pagination aplico
```
php artisan vendor:publish --tag=laravel-pagination
```
y modifico alli el css.Por defecto coge tailwind.blade.css.pudiendo copiar alli otras alternativas de otras plantillas de la misma carpeta

### JS

podemos cargar sweet alert para que aparezcan y desaparezcan
lo instalamos
```
npm install sweetalert2

```
### REACT
en caso de trabajar con REACT TENEMOS QUE :

```
EL VITE.CONFIG deberia quedar asi


import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from "@vitejs/plugin-react";

export default defineConfig({
plugins: [
react(),
laravel({
input: [
'resources/css/app.css',
'resources/js/app.js',
],
refresh: true,
}),
],
});
```

instalamos react-dom y react-dom
```

npm install --save-dev @vitejs/plugin-react
 npm install react@latest react-dom@latest
```
En el layout base(componente layouts.layout) incorporamos los js  con :
```
@vite(["resources/css/app.css","resources/js/app.jsx"])  
@viteReactRefresh
```
INCORPORAMOS los bloques de react en sus puntos en App.jsx
```
import './bootstrap';
// import 'Code.jsx';

import React from "react";
import {createRoot} from "react-dom/client";

import Saludo from "./Pages/Saludo.jsx";
import Numero from "./Pages/Numero.jsx";

const react_numero = document.getElementById("react-numero");
const react_saludo = document.getElementById("react-saludo");

if (react_numero)
createRoot(react_numero).render(<Numero />);

if (react_saludo)
createRoot(react_saludo).render(<Saludo />);
```
y para que tailwind aplique estilos:
```
para que tailwind aplique estilos en los js

incorporamos en tailwind.config

	content: [
'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
'./storage/framework/views/*.php',
'./resources/views/**/*.blade.php',
'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
'./storage/framework/views/*.php' ,
'./resources/views/**/*.blade.php' ,
'./resources/js/**/*.jsx' ,
    ]
```
si queremos pasar datos a react desde el back - laravel ,pasamos los datos a la vista desde el controlador(MainController) --por ejemplo
```
 public function __invoke(Request $request)
    {
        $n=rand(1,100);
        $alumnos=Alumno::all();
        return view('saludo',compact('n','alumnos'));
    }
```
y en la vista incorporamos las datos como atributos..que luego recuperaremos 

en la vista
```
    <div id="react-saludo" ></div>
    <div id="react-numero" numero={{$n}}></div>
    <div id="react-alumnos" alumnos='@json($alumnos)'></div>
```
los recuperamos en el componente de la siguiente manera:
```
if (react_alumnos){
    const alumnos=JSON.parse(react_alumnos.getAttribute('alumnos'));

    createRoot(react_alumnos).render(<Alumnos alumnos={alumnos} />);
}
OJO! comillas dobles-sencillas para interpretar el json correctamente
```



###  Como se realiza la paginacion en Profesores

1-modificamos el metodos index() para que recupere la pagina en la que estamos

$Profesores = Profesor::paginate(5);

$page = Request::get('page')??1;

return view("profesores.listado" , compact("profesores","page"));

2-añadimos al final de la vista 
```
{{ $profesores->links() }}
```
3-hay que publicar las vistas con
```
php artisan vendor:publish --tag=laravel-pagination
```
con lo que se crean unas vistas utilizables en views/vendor/pagination
que por defecto coge tailwind.blade.php ,si bien se puede coger cualquier otra  e incluso modificarlas

4-Para editar el alumno en la vista alumno.edit le inyectamos la pagina para poder pasarla despues
```
<a href="{{route("profesor.edit" ,[$profesor->id,'page'=>$page])}}">
```

5-En el metodo edit recuperamos la pagina que hemos recibido por get para poder pasarsela al metodo update
```
$page = Request::get("page");
return view ("profesores.edit" , compact("profesor","page"));
```
En el metodo update recuperamos la pagina,pasada por get para podersela pasar a la ruta profesores con el listado paginado
```
$page =$request->input('page');
$datos_nuevos = $request->input();
$profesor->updateOrFail ($datos_nuevos );
return redirect ("profesores?page= $page");
```
