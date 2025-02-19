@extends('layouts.app')
@section('content')
    <div class="p-4 m-3 bg-white shadow-md rounded-md">
        <div class="flex justify-between items-center">
            <h2>{{ $user->name }}</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="hover:text-red-500 hover:font-bold" type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>
@endsection
