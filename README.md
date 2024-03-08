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
* policy (políticas que definirás accesos)
* rutas (tengo que crearlas y dirán que recursos ofrece mi aplicación,habitualmennte retornan vistas a las que pasamos variable,o controladores que procesan/obtienen  los datos y que se incorpran a alguna vista a mostrar)

## Ajusto los valores por defecto

Cómo el modelo se llama Profesor y la tabla quiero que se llame profesores y no profesors, tengo que indicarlo:

### creando un crud de profesores
## creo ecosistema
```
 php artisan make:Profesor --all

``` 
con ello creamos el modelo,el controlador,el seeder, el factory,la migration,y el Policy,el StoreRequest y el UpdateRequest asociados al modelo.Quedando pendiente solo las rutas,que veremos posteriormente como crearlas para acer un crud.

levantamos contenedores con el servidor de base de datos y el gestor phpmyadmin para comprobar qur se han creado y poblado correctamente

```
docker compose up -d --build
```

Bases de datos
- 
 -diseñamos la tabla en la migracion indicando campos y caracteristica( tipo de dato , unique(),notnull()....)

 poblamos la tabla y realizamos las migraciones con 
 ```
 php migrate:migrate --seed
 ```
 

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

### Rutas

 fallback->nos permite ejecutar algo si al ruta no existe
```
Route::fallback(function(){})
Route::resouces('profesores',Alumnno::class)
```
Routes ::resources crea las rutas necesarias para hacer el crud(eliminar ,crear y almacenar en base de datos,editar un elemento base de datos)
blos metodos del controlador para ello son : index, create, store, show, edit, update y destroy.
index->nos muestra los registros de la tabla
create->nos muestra una vista con los campor a cumplinentar para crear un registro
store->recibe los campos que vamos a enviar por post para guardarlos en la BD
show->muestra los detalles de un solo registro
edit->formulario para editar un registro
update->actualizar los cambios realizados en el formulario edit
destroy->eliminar un registro de la BD
Para trabajar con las rutas se utiliza el comando php artisan route:list --path="profesores" que nos muestra las rutas de profesores.
podemos nombrarlas con ->name('nombre de la ruta'.) y usarlas con el helper route('nombre de la ruta')
las tutas creadas con resource de profesores son:

  GET|HEAD        profesores ............ profesores.index › ProfesorController@index  
  POST            profesores ............ profesores.store › ProfesorController@store  
  GET|HEAD        profesores/create ..... profesores.create › profesorController@create  
  GET|HEAD        profesores/{profesor} ..profesores.show › ProfesorController@show  
  PUT|PATCH       profesores/{profesor} ..profesores.update › ProfesorController@update  
  DELETE          profesores/{profesor} ..profesores.destroy › ProfesorController@destroy  
  GET|HEAD        profesores/{profesor}/edit .profesores.edit › ProfesorController@edit 

### Controlador
En el controlador los metodos quedarian(ya con paginacion incluidad):

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
[$profesor->id,'page'=>$page] puede sustituirse por compact('profesor','page’)
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
6- Para la ruta profesor.destroy el metodo destry del controlador quedaría:
```
public function destroy(Alumno $alumno)
    {
        $profesor->delete();
        return back();

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

en tailwind.config
plugins: [forms,require("daisyui")], en tailwind.config
```
para paginar y que cargue mi propio css desde vendor/pagination aplico
```
php artisan vendor:publish --tag=laravel-pagination
```
y modifico alli el css.Por defecto coge la plantilla  tailwind.blade.css pudiendo elegir otras alternativas de otras plantillas de la misma carpeta

### JS

podemos cargar sweet alert para que aparezcan y desaparezcan
lo instalamos
```
npm install sweetalert2

```
y utilizarlo dentro de un script en la pagina:
```
 function confirmDelete(event, button) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrarlo!'
            }).then((result) => {
                    console.log("Resultado " + result);
                    if (result.isConfirmed)
                        button.closest('form').submit();
                }

            )

        }
```
y ejecutamos la funcion al hacer  click en el boton guardar o eliminar


### REACT
en caso de trabajar con REACT TENEMOS QUE :

```
EL VITE.CONFIG deberia quedar asi:

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

le hemos añadido el plugin de react al empaquetador vite
```

instalamos react-dom y react-dom
```

npm install --save-dev @vitejs/plugin-react
 npm install react@latest react-dom@latest
```
En el layout base(componente layouts.layout) incorporamos los js  con :
```
@viteReactRefresh
@vite(["resources/css/app.css","resources/js/app.jsx"])  

```
INSERTAMOS los bloques de react en sus puntos en App.jsx
```
import './bootstrap';
// import 'Code.jsx';

import React from "react";
import {createRoot} from "react-dom/client";

import Saludo from "./Pages/Saludo.jsx";
import Numero from "./Pages/Numero.jsx";
import Alumnos from "./Pages/Alumnos.jsx";

const react_numero = document.getElementById("react-numero");
const react_saludo = document.getElementById("react-saludo");
const react_alumnos = document.getElementById("react-alumnos");

if (react_numero){
    const numero= react_numero.getAttribute('numero');
    createRoot(react_numero).render(<Numero numero={numero}/>);
}

if (react_saludo){
    createRoot(react_saludo).render(<Saludo />);
}
if (react_alumnos){
    const alumnos=JSON.parse(react_alumnos.getAttribute('alumnos'));

    createRoot(react_alumnos).render(<Alumnos alumnos={alumnos} />);
```
y para que tailwind aplique estilos:
```
para que tailwind aplique estilos en los jsx

incorporamos en tailwind.config

	content: [
'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
'./storage/framework/views/*.php',
'./resources/views/**/*.blade.php',
'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
'./storage/framework/views/*.php' ,
'./resources/views/**/*.blade.php' ,
'./resources/js/**/*.jsx' ,             <-----se añade>
    ]
```
si queremos pasar datos a react desde el back - laravel ,pasamos los datos a la vista desde el controlador(MainController) --por ejemplo--el metodo inoque es un metodo magico que se ejecuta cuando no se invoca un metodo especifico de la clase
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

OJO! comillas sencillas para interpretar el json correctamente ya que este ya viene con comillas dobles
```



###  Como se realiza la paginacion en Profesores

ver ejemplo en rutas
