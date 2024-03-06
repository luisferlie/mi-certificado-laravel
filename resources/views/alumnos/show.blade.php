<x-layouts.layout>
    <div class="max-w-4xl mx-auto  border border-4 border-green-600 rounded-xl shadow-2xl shadow-slate-950">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body bg-lime-200 rounded-xl">
                <p class="card-title text-2xl bg-yellow-300 p-1 uppercase">Detalles Alumno</p>
                <div class="grid grid-cols-3 gap-4 ">
                    <div>
                        <label class="label ">
                            <span class="label-text font-bold">Nombre:</span>
                        </label>
                        <p>{{ $alumno->nombre }}</p>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text font-bold">Apellidos:</span>
                        </label>
                        <p>{{ $alumno->apellidos }}</p>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text font-bold">Dirección:</span>
                        </label>
                        <p>{{ $alumno->direccion }}</p>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text font-bold">Teléfono:</span>
                        </label>
                        <p>{{ $alumno->telefono }}</p>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text font-bold">Email:</span>
                        </label>
                        <p>{{ $alumno->email }}</p>
                    </div>
                </div>
                <div class="divider h-10 bg-slate-400"></div>
                <h3 class="text-xl font-semibold">Idiomas que habla</h3>
                <ul class="list-disc list-inside bg-green-300 p-5 rounded-3xl">
                    @foreach($alumno->idiomas as $idioma)
                        <li>{{ $idioma->idioma }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-end  bg-orange-500 p-5">
                <a href="{{ route('alumnos.index') }}" class="btn btn-outline-dark mx-auto ">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
</x-layouts.layout>
