{{--inclución del dashboard--}}
@include('dashboard')

<h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Pokemones</h1>

<div id="spinner" class="hidden fixed inset-0 bg-gray-200 bg-opacity-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-primary"></div>
</div>
<div class="flex flex-col md:flex-row justify-between my-4">
    {{-- Si no hay pokemones sincronizados, mostrar el botón para sincronizarlos si no, mostrar el botón para eliminarlos --}}
    @if (count($pokemons) === 0)
        <form id="syncForm" action="{{ route('pokemons.fetchAll') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-primary hover:bg-primaryHover text-white font-medium rounded-lg text-sm px-5 py-2.5">Sincronizar
                Pokemones</button>
        </form>
    @else
        <form action="{{ route('pokemons.deleteAll') }}" method="POST">
            @csrf
            <button
                class="bg-primary
                hover:bg-primaryHover text-white font-medium rounded-lg text-sm px-5 py-2.5 w-full mb-3 md:mb-0">Eliminar
                todos los
                Pokemones</button>
        </form>
    @endif

    {{-- Botón para agregar un nuevo pokémon --}}
    <button onclick="openModalCreate()"
        class="text-white bg-secondary hover:bg-secondaryHover font-medium rounded-lg text-sm px-5 py-2.5 ">
        Agregar Pokémon
    </button>
</div>

<div class="w-full relative overflow-x-auto">
    {{-- Tabla de pokemones --}}
    <table class="w-full whitespace-nowrap">
        <thead>
            <tr class="bg-primary text-tertiary rounded-t-md">
                <th class="px-4 py-2 text-center text-sm truncate rounded-tl-lg">
                    ID
                </th>
                <th class="px-4 py-2 text-center text-sm truncate">
                    Nombre
                </th>
                <th class="px-4 py-2 text-center text-sm truncate">
                    Imagen
                </th>
                <th class="px-4 py-2 text-center text-sm truncate">
                    Tipo
                </th>

                <th class="px-4 py-2 text-center text-sm truncate rounded-tr-lg">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="text-sm">
            {{-- Si hay pokemones, mostrarlos en la tabla si no mostrar que no hay pokemones --}}
            @if (count($pokemons) > 0)
                @foreach ($pokemons as $pokemon)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-4 py-3 text-center">
                            {{ $pokemon->id }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            {{ $pokemon->name }}
                        </td>
                        <td class="px-4 py-3 flex justify-center items-center text-center">
                            {{-- Si la imagen es de la API, mostrarla directamente, si no, mostrarla desde el storage --}}
                            @if (strpos($pokemon->image, 'https://raw.githubusercontent.com/PokeAPI') !== false)
                                <img src="{{ $pokemon->image }}" width="100">
                            @else
                                <img src="{{ asset('storage/' . $pokemon->image) }}" width="100">
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            {{ $pokemon->type }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('pokemons.show', $pokemon->id) }}"
                                class="text-white bg-secondary hover:bg-secondaryHover font-medium rounded-lg text-sm px-5 py-2.5 m-1">Ver</a>
                            {{-- Botones para editar mandando los parámetros necesarios --}}
                            <button
                                onclick="openModalEdit('{{ $pokemon->id }}', '{{ $pokemon->name }}', '{{ $pokemon->type }}', '{{ route('pokemons.update', $pokemon->id) }}')"
                                class="text-white bg-secondary hover:bg-secondaryHover font-medium rounded-lg text-sm px-5 py-2.5 m-1">
                                Editar
                            </button>
                            {{-- Formulario para eliminar --}}
                            <form action="{{ route('pokemons.destroy', $pokemon->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-primary hover:bg-primaryHover font-medium rounded-lg text-sm px-5 py-2.5 m-1">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="px-4 py-3 text-center" colspan="5">
                        No hay pokemones
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

{{-- Paginación --}}
<div class="flex w-full justify-center my-3 ">
    {{ $pokemons->links('') }}
</div>


<!-- Main modal -->
<div id="modal-pokemon" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden flex justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Contenido del modal -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Encabezado del modal -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar Pokémon
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="toggleModal('modal-pokemon')">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                {{-- Formulario para editar o crear un pokémon --}}
                <form id="edit-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pokemon_id" id="pokemon_id">

                    <label class="mb-2" for="pokemon_name">Nombre:</label>
                    <input type="text" name="name" id="pokemon_name" class="border p-2 w-full rounded-lg mb-2">

                    <label class="mb-2" for="pokemon_type">Tipo:</label>
                    <input type="text" name="type" id="pokemon_type" class="border p-2 w-full rounded-lg mb-2">

                    <label class="mb-2">Imagen:</label>
                    <input type="file" name="image" class="w-full" accept="image/*">
                </form>
            </div>
            <!-- Modal footer -->
            <div
                class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button onclick="toggleModal('modal-pokemon')" type="button"
                    class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary">Cancelar</button>
                <button onclick="submitForm()" type="button"
                    class=" py-2.5 text-sm px-5 ms-3 text-white bg-primary hover:bg-primaryHover font-medium rounded-lg ">Guardar</button>
            </div>
        </div>
    </div>
</div>

{{-- Mostrar alertas de éxito o error --}}
@if (session('success'))
    <script>
        Swal.fire({
            title: "¡Éxito!",
            text: "{{ session('success') }}",
            confirmButtonColor: "#ee1515",
            icon: "success"
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            title: "¡Error!",
            text: "{{ session('error') }}",
            confirmButtonColor: "#ee1515",
            icon: "error"
        });
    </script>
@endif


<script>

    // Función para abrir el modal con los datos del pokémon a editar
    function openModalEdit(id, name, type, url) {
        document.getElementById('pokemon_id').value = id;
        document.getElementById('pokemon_name').value = name;
        document.getElementById('pokemon_type').value = type;
        document.getElementById('edit-form').action = url;
        document.getElementById('modal-title').innerText = "Editar Pokémon";
        toggleModal('modal-pokemon');
    }

    // Función para abrir el modal para crear un nuevo pokémon
    function openModalCreate() {
        document.getElementById('pokemon_id').value = '';
        document.getElementById('pokemon_name').value = '';
        document.getElementById('pokemon_type').value = '';
        document.getElementById('edit-form').action = "{{ route('pokemons.store') }}";
        document.getElementById('modal-title').innerText = "Agregar Pokémon";

        toggleModal('modal-pokemon');
    }

    // Función para abrir y cerrar el modal
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }

    // Enviar formulario
    function submitForm() {
        document.getElementById('edit-form').submit();
    }

    // Mostrar spinner
    document.getElementById('syncForm').addEventListener('submit', function() {
        document.getElementById('spinner').classList.remove('hidden');
    });
</script>
