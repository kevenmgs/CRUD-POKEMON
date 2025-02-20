@extends('layouts.app')
@section('content')
    <div class="px-4 mb-2 bg-white shadow-md rounded-md flex justify-between items-center text-center h-16">
        <h2 class="flex items-center">{{ $user->name }}</h2>
        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST" class="flex items-center">
            @csrf
            <button class="bg-primary hover:bg-primaryHover text-sm text-white font-bold py-2 px-4 mt-2 rounded"
                type="submit">Cerrar Sesión</button>
        </form>
    </div>
@endsection
