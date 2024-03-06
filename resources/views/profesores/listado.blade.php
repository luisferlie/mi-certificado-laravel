<x-layouts.layout>

    <div class="overflow-x-auto max-h-full">
        @if (session('status'))
            <script>
                Swal.fire("{{ session('status') }}");
            </script>


            {{--            <div id="alertSession" role="alert" class="alert alert-success"> --}}
            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> --}}
            {{--                <span>{{session('status')}}</span> --}}
            {{--            </div> --}}
        @endif
        <a class="btn btn-primary" href="{{ route('profesores.create', ['page' => $page]) }}">Nuevo Profesor</a>
        <table class="table table-xs table-pin-rows ">

            <tr>
                <th>nombre</th>
                <th>apellidos</th>
                <th>email</th>
                <th>dni</th>
                <th> departamento</th>
            </tr>

            @foreach ($profesores as $profesor)
                <tr>
                    <td>{{ $profesor->nombre }}</td>
                    <td>{{ $profesor->apellidos }}</td>
                    <td>{{ $profesor->email }}</td>
                    <td>{{ $profesor->dni }}</td>
                    <td>{{ $profesor->departamento }}</td>
                    <td>
                        <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onClick="confirmDelete(event, this) " class="btn" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('profesores.edit', [$profesor->id, 'page' => $page]) }}">
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
        {{$profesores->links()}}
    </div>


    <script>
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

        // window.onload=funcion()
        // {
        //     setTimeout(function()  {
        //         document.getElementById("alertSession").style.display = "none"},5000);
        // }
        // window.onload=()=>
        //     setTimeout(()=>
        //         document.getElementById("alertSession").style.display = "none",5000);
    </script>


</x-layouts.layout>
