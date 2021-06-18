@extends('layouts.app')

@section('content')

    <h1 class="my-4 container">Videos</h1>
    <div class="d-flex flex-wrap w-100 justify-content-center">

        @forelse ($videos as $video)
            <div class="card mx-4" style="width:400px">
                <div class="card-body">
                    <a class="text-decoration-none text-dark" href="{{ route('video.show', $video->id) }}"><h4
                            class="card-title">{{ $video->title }}</h4></a>
                    <video width="100%">
                        <source src="{{ 'public/storage' . $video->cont }}" type="video/mp4">
                        Your browser does not support HTML video.
                    </video>
                    <br>
                    <a href="{{ route('video.show', $video->title) }}" class="card-text">{{ $video->name }}</a><br>
                    <a href="{{ route('video.show', $video->id) }}" class="btn btn-primary">Ver Video</a>
                    @auth
                        @if (Auth::user()->hasRole('admin'))
                            <a class="btn btn-primary" href="{{ route('vidAdmin.edit', $video->id) }}">Edit</a>
                            <form action="{{ route('vidAdmin.destroy', $video->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td>
                                    <button class="btn btn-danger mt-2">Borrar</button>
                                </td>
                            </form>

                        @elseif (Auth::user()->hasRole('editor'))
                            <a class="btn btn-primary" href="{{ route('vidEdit.edit', $video->id) }}">Edit</a>
                            <form action="{{ route('vidEdit.destroy', $video->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td>
                                    <button class="btn btn-danger mt-2">Borrar</button>
                                </td>
                            </form>

                        @elseif(Auth::user()->name == $video->getUserName())
                            <a class="btn btn-primary" href="{{ route('vidEdit.edit', $video->id) }}">Edit</a>
                            <form action="{{ route('vidEdit.destroy', $video->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td>
                                    <button class="btn btn-danger">Borrar</button>
                                </td>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
            <br>
        @empty
            <h4 class="my-4">No hay videos</h4>
        @endforelse
    </div>

@endsection
