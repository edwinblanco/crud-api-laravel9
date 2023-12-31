@extends('adminlte::page')

@section('title', 'CRUD de productos con Laravel')

@section('content_header')
    <h1 class="titulo-encabezado">Crear producto</h1>
@stop

@section('content')
    <form class="shadow-lg p-3" action="/productos" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
            <div class="mb-3">
                <label for="" class="form-label">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Precio:</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="any" value="0.00" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Categoria:</label>
                    @if(count($categorias) >0 )
                    <select class="form-select" id="categoria" name="categoria_id" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @else
                    <p class="text-danger">¡No hay categorías agregadas! Agrega una <a href="{{ route('categorias.create') }}">aquí</a></p>
                    @endif
                </div>
                
            </div>
        </div>
        <div class="m-auto">
            <a class="btn btn-info" href="/productos">Cancelar</a>
        <button class="btn btn-primary" type="submit">Crear</button>  
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@stop