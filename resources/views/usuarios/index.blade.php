@extends('adminlte::page')
@section('title', 'MY LARAVEL SYSTEM')

@section('content')
<section class="section" align="center">
    <div class="section-header">
    <h3 class="page_heading">Usuarios</h3>    
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary"> Nuevo</a>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">

                            <head>
                                <tr align="left">
                                    <th style="display:none;">ID</th>
                                    <th>Nombre</th>
                                    <th>E-mail</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </head>
                            <tbody>
                                @foreach ($usuarios as $details)
                                <tr>
                                    <td style="display:none;">{{ $details->id }}</td>
                                    <td>{{ $details->name }}</td>
                                    <td>{{ $details->email }}</td>
                                    <td>
                                        @if(!empty($details->getRoleNames()))
                                        @foreach($details->getRoleNames() as $roleName)
                                        <h5><span class="btn btn-dark btn-sm">{{$roleName}}</span></h5>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('usuarios.edit',$details->id)}}" class="btn btn-info">Editar</a>
                                        <form action="{{ route('usuarios.destroy',$details->id) }}" method="post" class="d-inline form-delete">
                                            @method('DELETE')
                                            @csrf
                                            <BUTTON type="submit" class="btn btn-danger" >Eliminar</BUTTON>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center"> {!! $usuarios->links() !!}   </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('js')
<script src="{{asset('js/app.js')}}"></script>
@if (Session::has('user_deleted'))
<script>
  Swal.fire(
    'Borrado!',
    'El usuario ha sido eliminado.',
    'Exito'
  )
</script>
@endif
@if (Session::has('user_edited'))
<script>
  Swal.fire(
    'Editado!',
    'El usuario ha sido editado.',
    'Exito'
  )
</script>
@endif
@if (Session::has('user_added'))
<script>
  Swal.fire(
    'Agregado!',
    'El usuario ha sido agregado.',
    'Exito'
  )
</script>
@endif
<script>
  $('.form-delete').submit(function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Está seguro?',
      text: "No se podrá revertir!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, Eliminarlo!'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
  });
</script>
@stop