@extends('adminlte::page')

@section('title', 'CRUD de productos con Laravel')

@section('content_header')
    <h1 class="titulo-encabezado">Editar producto</h1>
@stop

@section('content')
    <form class="shadow-lg p-3" action="/categorias/{{$categoria->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$categoria->nombre}}" required>
        </div>
            
        <div class="m-auto">
            <a class="btn btn-info" href="/categorias">Cancelar</a>
            <button class="btn btn-primary" type="submit">Editar</button>  
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