@extends('adminlte::page')

@section('title', 'CRUD de productos con Laravel')

@section('content_header')
    <h1 class="titulo-encabezado">Lista de productos</h1>
@stop

@section('content')
  <a class="btn btn-primary mb-2" href="productos/create">Crear producto</a>
  <table id="productos" class="table table-hover table-bordered shadow-lg">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Código</th>
        <th scope="col">Descripción</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Precio</th>
        <th scope="col">Imagen</th>
        <th scope="col">Categoría</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($productos as $producto)
          <tr>
          <th scope="row">{{$producto->id}}</th>
          <td>{{$producto->codigo}}</td>
          <td>{{$producto->descripcion}}</td>
          <td>{{$producto->cantidad}}</td>
          <td>{{$producto->precio}}</td>
          <td>
            <a href="{{$producto->imagen}}" target="_blanck">
            <img src="{{$producto->imagen}}" class="img-thumbnail custom-image" alt="">
            </a></td>
          <td>{{$producto->categoria->nombre}}</td>  
          <td>
          
              <form action="{{ route('productos.destroy', $producto->id) }}" class="form-del" method="POST">
                @csrf
                @method('DELETE')
                <a href="productos/{{$producto->id}}/edit" class="btn btn-info mb-1 titulo-encabezado">Editar</a>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function () {
      $('#productos').DataTable({
        "language": {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',},
        "lengthMenu": [[5, 10, 100, -1], [5, 10, 100, "Todos"]]
      });
    });
  </script>

  @if(session('eliminar') == 'ok')
      <script>
        Swal.fire(
            '!Registro eliminado!',
            '!Registro eliminado con exito!',
            'success'
        )
      </script>
  @endif

  <script>

    $('.form-del').submit(function(e){
      e.preventDefault();

      Swal.fire({
      title: '¿Estás seguro?',
      text: "¡El registro se eliminará definitivamente!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Si, eliminar!',
      cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      })

    })

  </script>

@stop