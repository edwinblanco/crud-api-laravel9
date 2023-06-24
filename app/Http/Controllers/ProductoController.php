<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Producto::all();
        return view('producto.index')->with('productos', $productos);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('producto.create')->with('categorias', $categorias);
    }

    public function store(Request $request)
    {
        $producto = new Producto();

        $producto->codigo = $request->get('codigo');
        $producto->descripcion = $request->get('descripcion');
        $producto->cantidad = $request->get('cantidad');
        $producto->precio = $request->get('precio');
        $producto->categoria_id = $request->get('categoria_id');

        // Guardar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $path = $imagen->store('public/imagenes');
            $producto->imagen = Storage::url($path);
        }

        $producto->save();

        return redirect('/productos');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categorias = Categoria::all();
        $producto = Producto::find($id);
        return view('producto.edit')->with('producto', $producto)->with('categorias', $categorias);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        $producto->codigo = $request->get('codigo');
        $producto->descripcion = $request->get('descripcion');
        $producto->cantidad = $request->get('cantidad');
        $producto->precio = $request->get('precio');
        $producto->categoria_id = $request->get('categoria_id');

        // Guardar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $path = $imagen->store('public/imagenes');
            $producto->imagen = Storage::url($path);
        }

        $producto->save();

        return redirect('/productos');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();

        return redirect('/productos')->with('eliminar', 'ok');
    }
}
