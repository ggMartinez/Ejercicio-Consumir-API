<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Validator;


class VideojuegoController extends Controller
{
    public function Create(Request $request){
        $validation = Validator::make($request->all(),[
            'nombre' => 'required',
            'genero' => 'required',
            'plataforma' => 'required',
            'distribuidora' => 'required',
            'desarrolladora' => 'required',
            'fecha_lanzamiento' => 'required|date',
            'precio' => 'required|numeric',
            'descripcion' => 'required'
        ]);

        if($validation->fails())
            return response()->json($validation->errors(),401);
        
        $videojuego = new Videojuego();
        $videojuego->nombre = $request->nombre;
        $videojuego->genero = $request->genero;
        $videojuego->plataforma = $request->plataforma;
        $videojuego->distribuidora = $request->distribuidora;
        $videojuego->desarrolladora = $request->desarrolladora;
        $videojuego->fecha_lanzamiento = $request->fecha_lanzamiento;
        $videojuego->precio = $request->precio;
        $videojuego->descripcion = $request->descripcion;
        $videojuego->save();
        return $videojuego;
    }

    public function List(Request $request){
        return Videojuego::all();
    }

    public function Show(Request $request, $id){
        return Videojuego::findOrFail($id);
    }

    public function Delete(Request $request, $id){
        $videojuego = Videojuego::findOrFail($id);
        $videojuego->delete();
        return [ "message" => "Videojuego eliminado" ];
    }

    public function Update(Request $request, $id){
        $videojuego = Videojuego::findOrFail($id);

        $validation = Validator::make($request->all(),[
            'nombre' => 'required',
            'genero' => 'required',
            'plataforma' => 'required',
            'distribuidora' => 'required',
            'desarrolladora' => 'required',
            'fecha_lanzamiento' => 'required|date',
            'precio' => 'required|numeric',
            'descripcion' => 'required'
        ]);

        if($validation->fails())
            return $validation->errors();

        $videojuego->nombre = $request->nombre;
        $videojuego->genero = $request->genero;
        $videojuego->plataforma = $request->plataforma;
        $videojuego->distribuidora = $request->distribuidora;
        $videojuego->desarrolladora = $request->desarrolladora;
        $videojuego->fecha_lanzamiento = $request->fecha_lanzamiento;
        $videojuego->precio = $request->precio;
        $videojuego->descripcion = $request->descripcion;
        $videojuego->save();
        return $videojuego;
    }
}
