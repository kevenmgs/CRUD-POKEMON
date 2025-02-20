
{{--incluir el dashboard--}}
@include('dashboard')


<a href="{{ route('pokemons.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-14 md:w-14 text-gray-500 hover:text-gray-700" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 19l-7-7m0 0l7-7m-7 7h18">
        </path>
    </svg>
</a>

<div class="relative w-60 h-60 md:w-96 md:h-96 rounded-full shadow-md mx-auto mt-4 overflow-hidden border-4 border-secondary">
    <div class="absolute top-0 left-0 w-full h-1/2 bg-primary flex flex-col justify-center items-center text-white p- md:p-4">
        <h1 class="text-lg md:text-2xl font-bold">{{ $pokemon->name }}</h1>
        <p class="text-sm md:text-lg">Tipo: {{ $pokemon->type }}</p>
    </div>

    <div class="absolute top-1/2 left-0 w-full h-6 bg-secondary -translate-y-1/2"></div>

    <div class="absolute top-1/2 left-1/2 w-10 h-10 md:w-20 md:h-20 bg-tertiary border-4 border-secondary rounded-full -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
        <div class="w-5 h-5 md:w-10 md:h-10 bg-secondary rounded-full"></div>
    </div>


    <div class="relative flex justify-center items-end h-full">
        {{-- Si la imagen es de la API, se carga directamente, si no, se carga desde el storage --}}
        @if (strpos($pokemon->image, 'https://raw.githubusercontent.com/PokeAPI') !== false)
            <img src="{{ $pokemon->image }}"  class="relative   md:bottom-5 z-10 w-28 md:w-36 ">
        @else
            <img src="{{ asset('storage/' . $pokemon->image) }}"  class="relative  md:bottom-8 z-10 w-28 md:w-36">
        @endif
    </div>
</div>

