<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokemonController;


//Route to show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Route to login
Route::post('/login', [AuthController::class, 'login']);
//Route to logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PokemonController::class, 'index'])->name('home');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

    //Route to fetch all pokemons from API
    Route::post('/pokemons/fetch', [PokemonController::class, 'fetchAllPokemon'])->name('pokemons.fetchAll');
    //Rouete to get all pokemons from database
    Route::get('/pokemons', [PokemonController::class, 'index'])->name('pokemons.index');
    //Route to create a new pokemon
    Route::post('/pokemons', [PokemonController::class, 'store'])->name('pokemons.store');
    //Route to view pokemon
    Route::get('/pokemons/{id}', [PokemonController::class, 'show'])->name('pokemons.show');
    //Route to edit pokemon
    Route::post('/pokemons/{id}', [PokemonController::class, 'update'])->name('pokemons.update');
    //Route to delete pokemon
    Route::delete('/pokemons/{id}', [PokemonController::class, 'destroy'])->name('pokemons.destroy');
    //Route to delete all pokemons
    Route::post('/pokemonsDelateAll', [PokemonController::class, 'deleteAll'])->name('pokemons.deleteAll');
});
