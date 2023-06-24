@extends('adminlte::page')

@section('title', 'CRUD de productos con Laravel')

@section('content_header')
    <h1 class="titulo-encabezado">Lista de categorías</h1>
@stop

@section('content')
  <a class="btn btn-primary mb-2" href="categorias/create">Crear Categoría</a>
  <table id="productos" class="table table-hover table-bordered shadow-lg">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categorias as $categoria)
          <tr>
          <th scope="row">{{$categoria->id}}</th>
          <td>{{$categoria->nombre}}</td>
          <td>
              <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="categorias/{{$categoria->id}}/edit" class="btn btn-info mb-1 titulo-encabezado">Editar</a>
                <button type="submit" class="btn btn-danger mb-1">Eliminar</button>
              </form>
          </td>
          </tr>
      @endforeach
    </tbody>
  </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"></script>
  <script>
    $(document).ready(function () {
      $('#productos').DataTable({
        "language": {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',},
        "lengthMenu": [[5, 10, 100, -1], [5, 10, 100, "Todos"]]
      });
    });
  </script>
@stop