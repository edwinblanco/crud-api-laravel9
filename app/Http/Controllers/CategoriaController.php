<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index')->with('categorias', $categorias);
    }


    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        $categoria = new Categoria();

        $categoria->nombre = $request->get('nombre');

        $categoria->save();

        return redirect('/categorias');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.edit')->with('categoria', $categoria);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        $categoria->nombre = $request->get('nombre');

        $categoria->save();

        return redirect('/categorias');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect('/categorias')->with('eliminar', 'ok');
    }
}
