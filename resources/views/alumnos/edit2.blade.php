<x-layouts.layout>
    <div class="max-w-full mx-auto p-5">
        <form action="{{route('alumnos.update', $alumno->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card bg-base-100 shadow-xl ">
                <div class="card-body">
                    <h2 class="card-title text-2xl">Detalles del Alumno</h2>
                    <div class="grid grid-cols-3">
                        {{-- Primera columna --}}
                        <div class="border border-2 w-1/3">
                            <label class="label">
                                <span class="label-text">Nombre:</span>
                            </label>
                            <input type="text" name="nombre" value="{{$alumno->nombre}}" class="input input-bordered input-info w-full max-w-xs" />

                            <label class="label">
                                <span class="label-text">Apellidos:</span>
                            </label>
                            <input type="text" name="apellidos" value="{{$alumno->apellidos}}" class="input input-bordered input-info w-full max-w-xs" />

                            <label class="label">
                                <span class="label-text">Dirección:</span>
                            </label>
                            <input type="text" name="direccion" value="{{$alumno->direccion}}" class="input input-bordered input-info w-full max-w-xs" />
                        </div>

                        {{-- Segunda columna --}}
                        <div class="border border-2 w-1/3">
                            <label class="label">
                                <span class="label-text">Teléfono:</span>
                            </label>
                            <input type="text" name="telefono" value="{{$alumno->telefono}}" class="input input-bordered input-info w-full max-w-xs" />

                            <label class="label">
                                <span class="label-text">Email:</span>
                            </label>
                            <input type="email" name="email" value="{{$alumno->email}}" class="input input-bordered input-info w-full max-w-xs" />
                        </div>

                        {{-- Tercera columna --}}
                        <div class="border border-2 w-1/3">
                            <fieldset class="border p-4 rounded">
                                <legend class="text-xl font-semibold">Idiomas</legend>
                                @foreach($alumno->idiomas as $idioma)
                                    <div class="flex justify-between items-center mb-2">
                                        {{ $idioma->nombre }}
                                        <form action="{{ route('idiomas.destroy', $idioma->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-xs">Eliminar</button>
                                        </form>
                                    </div>
                                @endforeach

                                {{-- Formulario para añadir un nuevo idioma --}}
                                <div class="mt-4">
                                    <form action="{{ route('idiomas.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="alumno_id" value="{{$alumno->id}}">
                                        <select name="idioma_id" class="select select-bordered w-full max-w-xs">
                                            @foreach($alumno->idiomas as $idioma)
                                                <option value="{{ $idioma->id }}">{{ $idioma->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary mt-2">Añadir Idioma</button>
                                    </form>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary ml-2">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.layout>
