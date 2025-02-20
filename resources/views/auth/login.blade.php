@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center h-full text-center">
    <div class="flex justify-between items-center w-full">
        <div class="relative w-28 h-28 rounded-full shadow-md mx-auto mt-4 overflow-hidden border-4 border-secondary">
            <div class="absolute top-0 left-0 w-full h-1/2 bg-primary flex flex-col justify-center items-center text-white p-4">
            </div>

            <div class="absolute top-1/2 left-0 w-full h-3 md:h-6 bg-secondary -translate-y-1/2"></div>

            <div class="absolute top-1/2 left-1/2 w-10 h-10 md:w-14 md:h-14 bg-tertiary border-4 border-secondary rounded-full -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                <div class="w-4 h-4 md:w-6 md:h-6 bg-secondary rounded-full"></div>
            </div>
        </div>
    </div>

    <div class="p-6 my-4 bg-white shadow-md rounded-md items-center text-center h-auto w-auto max-w-96 mx-auto">
        {{-- Formulario de inicio de sesión --}}
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label class="text-xl md:text-2xl text-secondary font-bold text-start mb-2">Correo :</label>

            <input class="w-full p-2 border border-gray-300 rounded-md mb-5 focus:border-primary" type="email" id="email"
                name="email" required>
            <label class="text-xl md:text-2xl text-secondary font-bold text-start mb-2">Contraseña :</label>

            <input class="w-full p-2 border border-gray-300 rounded-md focus:border-primary" type="password" id="password" name="password"
                required>

            @if ($errors->any())
                <div>
                    <span class="text-primary mt-3">{{ $errors->first() }}</span>
                </div>
            @endif

            <button class="bg-primary hover:bg-primaryHover  text-white font-medium rounded-lg text-sm px-5 py-2.5 mt-3"
                type="submit">Ingresar</button>
        </form>
    </div>
</div>

@endsection
