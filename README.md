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
