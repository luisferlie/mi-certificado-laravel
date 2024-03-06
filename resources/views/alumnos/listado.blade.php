<x-layouts.layout>
    <script>
        function editarFila(id) {
            window.location = "http://localhost:8000/alumnos/" + id;


        }

        function showAlert(mensaje) {
            Swal.fire({
                title: "Éxito!!",
                text: mensaje,
                icon: 'info',
                timer: 2000
            });
        }

        function confirmDeletion(event, button) {
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
                if (result.isConfirmed) {
                    // Buscar el formulario más cercano y enviarlo
                    button.closest('form').submit();

                }
            });
        }

        // window.onload = () => {
        //     setTimeout(() =>
        //         document.getElementById('alertBox').style.display = 'none', 1000
        //     );
        //     setTimeout(() =>
        //         document.getElementById('modal-window').classList.remove('modal-open'), 1000
        //     );
        // }
    </script>
    <div class="max-h-full flex flex-col justify-center items-center ">
        <h1 class=" text-5xl uppercase text-blue-700">Listado de alumnos</h1>


        @if (session('status'))
            <script>
                showAlert("{{ session('status') }}")
            </script>

            {{--            <div id="alertSesion" role="alert" class="alert alert-success"> --}}
            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> --}}
            {{--                <span>{{session("status")}}</span> --}}
            {{--            </div> --}}
            <!-- The button to open modal -->
            {{--            <label for="modal-window" class="btn">open modal</label> --}}

            <!-- Put this part before </body> tag -->
            {{--            <div id="modal-window" class="modal modal-open"> --}}
            {{--                <div class="modal-box"> --}}
            {{--                    <h3 class="font-bold text-lg">¡Éxito!</h3> --}}
            {{--                    <p class="py-4">El registro se ha creado correctamente.</p> --}}
            {{--                    <div class="modal-action"> --}}
            {{--                        <a href="#" class="btn">Cerrar</a> --}}
            {{--                    </div> --}}
            {{--                </div> --}}
            {{--            </div> --}}
            {{--            <!-- Checkbox oculto para controlar la visibilidad de la modal --> --}}
            {{--            <input type="checkbox" id="modal-toggle" class="modal-toggle" /> --}}

            <!-- Modal -->
            {{--            <div class="modal modal-bottom sm:modal-middle"> --}}
            {{--                <div class="modal-box"> --}}
            {{--                    <h3 class="font-bold text-lg">¡Información!</h3> --}}
            {{--                    <p class="py-4">{{session("status")}}</p> --}}
            {{--                    <!-- Label que actúa como botón de cerrar, vinculado al checkbox --> --}}
            {{--                    <div class="modal-action"> --}}
            {{--                        <label for="modal-toggle" class="btn">Cerrar</label> --}}
            {{--                    </div> --}}
            {{--                </div> --}}
            {{--            </div> --}}
        @endif
        <a href="/alumnos/create" class="btn btn-primary  text-3xl"> Añadir Alumno</a>
        <div class="overflow-x-auto ">
            <table class="table p-5 w-3/4 table-pin-rows text-2xl bg-amber-100 mt-5">
                <tr>
                    <th>nombre</th>
                    <th>apellidos</th>
                    <th>dirección</th>
                    <th> teléfono</th>
                    <th> email</th>
                </tr>

                @foreach ($alumnos as $alumno)
                    <tr class="hover:bg-blue-200 hover:cursor-pointer text-sm" onclick="editarFila({{ $alumno->id }})">

                        <td><a class="hover:bg-green-500"
                                href="{{ route('alumnos.show', $alumno->id) }}">{{ $alumno->nombre }}</a></td>
                        <td><a class="hover:alert-success"
                                href="{{ route('alumnos.show', $alumno->id) }}">{{ $alumno->apellidos }}</a></td>
                        <td><a class="hover:alert-success"
                                href="{{ route('alumnos.show', $alumno->id) }}">{{ $alumno->direccion }}</a></td>
                        <td><a class="hover:alert-success"
                                href="{{ route('alumnos.show', $alumno->id) }}">{{ $alumno->telefono }}</a></td>
                        <td><a class="hover:alert-success"
                                href="{{ route('alumnos.show', $alumno->id) }}">{{ $alumno->email }}</a></td>

                        <td>
                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" onclick="confirmDeletion(event, this)" type=" submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('alumnos.edit', $alumno->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>

                            </a>
                        </td>


                    </tr>
                @endforeach

            </table>
        </div>
    </div>

    {{--    {{ $alumnos->links() }} --}}
    <div class="flex justify-left offset-10 ml-32">{{ $alumnos->links() }}</div>
    {{--    <script> --}}
    {{--        window.onload=()=> --}}
    {{--            setTimeout(()=> --}}
    {{--                document.getElementById('alertSesion').style.display='none', 1000); --}}
    {{--    </script> --}}

</x-layouts.layout>
