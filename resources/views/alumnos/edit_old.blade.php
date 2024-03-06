<x-layouts.layout>
    <div></div>
    <div class="max-w-full mx-auto p-5">
        <form action="{{route('alumnos.update', $alumno->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card bg-base-100 shadow-xl ">
                <div class="card-body">
                    <h2 class="card-title text-2xl">Detalles del Alumno</h2>
                    <div class="grid grid-cols-2">
                        {{-- Primera columna --}}
                        <fieldset>
                            <legend>Datos personales</legend>
                            <div class="flex flex-row">
                                <label class="label">
                                    <span class="label-text">Nombre:</span>
                                </label>
                                <input type="text" name="nombre" value="{{$alumno->nombre}}"
                                       class="input input-bordered input-info w-full max-w-xs"/>

                            </div>
                            <div class="flex flex-row">
                                <label class="label">
                                    <span class="label-text">Apellidos:</span>
                                </label>

                                <input type="text" name="apellidos" value="{{$alumno->apellidos}}"
                                       class="input input-bordered input-info w-full max-w-xs"/>


                            </div>
                            <div class="flex flex-row">
                                <label class="label">
                                    <span class="label-text">Dirección:</span>
                                </label>
                                <input type="text" name="direccion" value="{{$alumno->direccion}}"
                                       class="input input-bordered input-info w-full max-w-xs"/>

                            </div>
                            {{-- Segunda columna --}}

                            <div class="flex flex-row">
                                <div>
                                    <label class="label">
                                        <span class="label-text">Teléfono:</span>
                                    </label>
                                    <input type="text" name="telefono" value="{{$alumno->telefono}}"
                                           class="input input-bordered input-info w-full max-w-xs"/>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text">Email:</span>
                                    </label>
                                    <input type="email" name="email" value="{{$alumno->email}}"
                                           class="input input-bordered input-info w-full max-w-xs"/>
                                </div>
                            </div>
                        </fieldset>

                        {{-- Segunda columna --}}

                        <fieldset class="border p-4 rounded w-1/2">
                            <legend class="text-xl font-semibold">Idiomas</legend>
                            {{--Listado de idiomas que actualmente habla el alumno--}}
                            @foreach($alumno->idiomas as $idioma)
                                <div class="flex justify-between items-center mb-2"
                                     data-idioma="{{ $idioma->idioma }}">
                                    {{ $idioma->idioma}}
                                    <button onclick="del_idioma('{{ $idioma->idioma }}')" type="button" class="btn btn-error btn-xs">Eliminar</button>
                                </div>
                            @endforeach

                            {{-- Formulario para añadir un nuevo idioma --}}
                            <div class="mt-4">
                                    <select onchange="add_idioma(this.value)"  name="idioma_id" class="select select-bordered w-full max-w-xs">
                                        <option value="" selected disabled>Selecciona un idioma</option>
                                        @foreach($idiomas_disponibles as $idioma)
                                            <option value="{{ $idioma }}">{{ $idioma }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </fieldset>
                    </div><!--find grid 2-->
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary ml-2">Cancelar</a>
                </div>
            </div>
            <input type="hidden" id="idiomas_seleccionados" name="idiomas_seleccionados" value="">

        </form>
    </div>
    <script>
    var idiomasSeleccionados = @json ($alumno->idiomas->pluck('idioma'));
    console.log (`idiomas ${idiomasSeleccionados}`);

    function actualizarCampoOculto() {
        document.getElementById('idiomas_seleccionados').value = JSON.stringify(idiomasSeleccionados);
    }
        function del_idioma(idioma){
            const element = document.querySelector(`[data-idioma="${idioma}"]`);
            console.log(element);
            if (element)
                element.remove();
            // Aquí deberías también eliminar el idioma de la lista de idiomas seleccionados

            // Esto dependerá de cómo estás manejando esta lista, por ejemplo:
            idiomasSeleccionados = idiomasSeleccionados.filter(i => i !== idioma);
            console.log(`idiomas selecconads ${idiomasSeleccionados}`);

            // Y actualizar el campo oculto
            actualizarCampoOculto(); // Asegúrate de implementar esta función

        }
        function add_idioma(idioma){
            // Aquí, idiomaSeleccionado es el valor del idioma seleccionado en el select
            console.log("Idioma seleccionado:", idioma); // Para propósitos de depuración

            // Aquí puedes añadir lógica para manejar el idioma seleccionado,
            // como agregarlo a una lista en la interfaz de usuario, actualizar un campo oculto, etc.

            // Por ejemplo, agregar el idioma a idiomasSeleccionados si aún no está en la lista
            if (!idiomasSeleccionados.includes(idioma)) {
                idiomasSeleccionados.push(idioma);
                actualizarCampoOculto(); // Asegúrate de que esta función actualiza el campo oculto con la lista actualizada
            }
        }

    </script>
</x-layouts.layout>
