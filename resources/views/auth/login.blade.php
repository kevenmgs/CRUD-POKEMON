@extends('layouts.app')

@section('content')
    <h2>Iniciar Sesión</h2>
    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Ingresar</button>
    </form>
@endsection
