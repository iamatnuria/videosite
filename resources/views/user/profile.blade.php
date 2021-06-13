@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="col-sm-4">
        <h1 class="my-4">Perfil</h1>
        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            Name
            <input type="text" name="name" value="{{$user->name}}" class="form form-control">
            <input type="hidden" name="id" value="{{$user->id}}" class="form form-control">
            Email
            <br/>
            <input type="email" name="email" value="{{$user->email}}" class="form form-control">

            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br/>
        </form>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#miModal">
            Cambiar contraseña
        </button>
    </div>

        <div class="col-sm-8 d-flex flex-wrap w-100 justify-content-center">
            @forelse ($videos as $video)
                <div class="card mx-2" style="width:250px;">
                    <div class="card-body">
                        <h4 class="card-title">{{ $video->title }}</h4>
                        <video width="100%" >
                            <source src="{{ asset('storage/' . $video->cont) }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video><br>
                        <a href="{{ route('video.show', $video->id) }}" class="btn btn-primary">Ver Video</a>

                        <a class="btn btn-primary" href="{{ route('vidEdit.edit', $video->id) }}">Edit</a>
                        <form action="{{ route('vidEdit.destroy', $video->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <td><button class="btn btn-danger mt-2">Borrar</button></td>
                        </form>
                    </div>
                </div>
                <br>

            @empty
                <h4 class="mt-4">Todavia no tienes videos</h4>

            @endforelse

        </div>

        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="modal-body" action="{{ route('user.update', Auth::user()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$user->id}}" class="form form-control">
                        Nueva Contraseña
                        <br />
                        <input type="password" name="password" class="form form-control">
                        Confirmar Contraseña
                        <br />
                        <input type="password" name="password_confirmation" class="form form-control">
                        <br />
                        <input type="submit" class="btn btn-primary" value="Save">
                    </form>
                </div>
            </div>
        </div>
        <br />
    </div>

@endsection
