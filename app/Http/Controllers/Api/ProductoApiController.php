<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class ProductoApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    
    //Leer
    public function index()
    {
        $productos = Producto::all();

        return response()->json([
            "results" => $productos
        ], Response::HTTP_OK);
    }

    //Crear
    public function store(Request $request)
    {
        $request->validate([
            'codigo'=>'required', 
            'descripcion'=>'required', 
            'cantidad'=>'required|numeric|min:0',
            'precio'=>'required|numeric',
            'imagen'=>'required'
        ]);

        $categoria = Categoria::findOrFail($request->categoria_id);

        $imagenPath = $request->file('imagen')->store('public/imagenes');
        $imagenUrl = Storage::url($imagenPath); // Obtiene la URL completa de la imagen

        $producto = $categoria->productos()->create([
            "codigo"=>$request->codigo,
            "descripcion"=>$request->descripcion,
            "cantidad"=>$request->cantidad,
            "precio"=>$request->precio,
            "imagen" => $imagenUrl
        ]);

        return response()->json([
            "result" => $producto
        ], Response::HTTP_OK);
    }

    //Leer
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return $producto;
    }

    //Actualizar
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'codigo'=>'required', 
            'descripcion'=>'required', 
            'cantidad'=>'required|numeric|min:0',
            'precio'=>'required|numeric',
            'imagen'=>'required'
        ]);

        $categoria = Categoria::findOrFail($request->categoria_id);

        $imagenPath = $request->file('imagen')->store('public/imagenes');
        $imagenUrl = Storage::url($imagenPath); // Obtiene la URL completa de la imagen

        $categoria->productos()->where('id', $id)->update([
            "codigo"=>$request->codigo,
            "descripcion"=>$request->descripcion,
            "cantidad"=>$request->cantidad,
            "precio"=>$request->precio,
            "imagen" => $imagenUrl
        ]);

        return response()->json([
            "result" => "producto actualizado"
        ], Response::HTTP_OK);

    }

    //Eliminar
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id)->delete();
        return response()->json([
            "result" => "producto eliminado"
        ], Response::HTTP_OK);
    }
}
