<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Categoria;


class CategoriaApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {

        $categorias = Categoria::all();

        return response()->json([
            "results" => $categorias
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nombre"=>"required"
        ]);

        $categoria = Categoria::create([
            "nombre"=>$request->nombre
        ]);

        return response()->json([
            "result" => $categoria
        ], Response::HTTP_OK);

    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return $categoria;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "nombre"=>"required"
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return response()->json([
            "result" => $categoria
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json([
            "result" => "categoría elminicada"
        ], Response::HTTP_OK);
    }
}
