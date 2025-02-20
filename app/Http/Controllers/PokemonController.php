<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;




class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function fetchAllPokemon()
    {

        $response = Http::get("https://pokeapi.co/api/v2/pokemon");
        // $data = $response->json();
        // $totalPokemon = $data['count'];
        //Se limita a 50 pokemones
        $totalPokemon = 50;
        $size = 25;


        for ($start = 1; $start <= $totalPokemon; $start += $size) {
            for ($id = $start; $id < $start + $size && $id <= $totalPokemon; $id++) {
                $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");

                if ($response->failed()) {
                    continue;
                }

                $pokemonData = $response->json();
                // dd($pokemonData);

                $name = $pokemonData['name'];
                $image = $pokemonData['sprites']['front_default'];
                $type = $pokemonData['types'][0]['type']['name'];

                // Guardar en la base de datos
                Pokemon::updateOrCreate(
                    ['name' => $name],
                    [
                        'type' => $type,
                        'image' => $image
                    ]
                );
            }

            sleep(2);
        }

        return redirect()->route('pokemons.index')->with('success', 'Todos los Pokémon han sido guardados correctamente.');
    }


    public function index()
    {
        $pokemons = Pokemon::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user();
        // dd($user);
        return view('pokemons.index', compact('pokemons', 'user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pokemon,name|max:255',
            'type' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->file('image')->store('pokemon_images', 'public');
        Pokemon::create([
            'name' => $request->name,
            'type' => $request->type,
            'image' => $imagePath
        ]);

        return redirect()->route('pokemons.index')->with('success', 'Pokémon agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $user = Auth::user();

        return view('pokemons.show', compact('pokemon', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return view('pokemons.edit', compact('pokemon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pokemon = Pokemon::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:pokemon,name,' . $pokemon->id,
            'type' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Si se sube una nueva imagen, se guarda en el storage
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pokemon_images', 'public');
            $pokemon->image = $imagePath;
        }

        $pokemon->update($request->except('image'));

        return redirect()->route('pokemons.index')->with('success', 'Pokémon actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $pokemon->delete();

        return redirect()->route('pokemons.index')->with('success', 'Pokémon eliminado.');
    }

    // funcion para eliminar todos los pokemones
    public function deleteAll()
    {
        // dd('deleteAll');
        $pokemons = Pokemon::all();
        foreach ($pokemons as $pokemon) {
            $pokemon->delete();
        }

        return redirect()->route('pokemons.index')->with('success', 'Todos los Pokémon han sido eliminados.');
    }
}
