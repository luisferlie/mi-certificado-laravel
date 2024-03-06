<x-layouts.layout>
    {{$errors}}
    <div class="min-h-full flex justify-center items-center">
        <form action="/profesores?page=$page"  method="post" class="space-y-4 flex flex-col" >
            @csrf
            <input type="text" value="{{old('nombre')}}"  name="nombre" placeholder="Nombre" class="input input-bordered input-info w-full max-w-xs text-xl" />
            @foreach($errors->get('nombre') as $error)
                <div class="text-sm text-red-600">
                    {{$error}}
                </div>
            @endforeach
            <input type="text" value="{{old('apellidos')}}"  name="apellidos" placeholder="Apellidos" class="input input-bordered input-info w-full max-w-xs text-xl" />
            @foreach($errors->get('apellidos') as $error)
                <div class="text-sm text-red-600">
                    {{$error}}
                </div>
            @endforeach
            <input type="text" value="{{old('email')}}"  name="email" placeholder="email" class="input input-bordered input-info w-full max-w-xs text-xl" />
            @foreach($errors->get('email') as $error)
                <div class="text-sm text-red-600">
                    {{$error}}
                </div>
            @endforeach

            <input type="text" value="{{old('dni')}}"  name="dni" placeholder="dni" class="input input-bordered input-info w-full max-w-xs text-xl" />
            @foreach($errors->get('dni') as $error)
                <div class="text-sm text-red-600">
                    {{$error}}
                </div>
            @endforeach

            <select value="{{old("departamento")}}" name="departamento" id="">
                <option disabled selected >Selecciona dapartamento</option>
                <option value="Informática">Informática</option>
                <option value="comercio">Comercio</option>
                <option value="imagen">Imagen</option>
            </select>
            @foreach($errors->get('departamento') as $error)
                <div class="text-sm text-red-600">
                    {{$error}}
                </div>
            @endforeach
            <input class="btn btn-outline btn-primary" type="submit" value="Crear">
        </form>
    </div>
</x-layouts.layout>
