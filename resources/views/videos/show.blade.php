@extends('layouts.app')

@section('content')
    <div class="row container-fluid rounded-lg d-flex flex-column align-content-center align-items-center">
        <div class="col-sm-8">
            <div class="w-75">
                <video width="100%" controls>
                    <source src="{{ asset('').$videos->cont}}" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
                <br>
                <h1 class="my-4">{{ $videos->title }}</h1>
                <h5 class="text-muted mb-5">Creado por: {{ $videos->getUserName() }}</h5>
                <span>{{ $videos->desc }}</span><br>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('video.show', $videos->title) }}" class="card-text">{{ $videos->name }}</a>
                    <span class="mb-2">Visitas: {{ $videos->visitas }}
                </div>
                @auth
                    <div class="d-flex flex-row mb-4">
                        @if (Auth::user()->hasRole('admin'))
                            <a class="btn btn-primary mr-4" href="{{ route('vidAdmin.edit', $videos->id) }}">Edit</a>
                            <form action="{{ route('vidAdmin.destroy', $videos->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td>
                                    <button class="btn btn-danger">Borrar</button>
                                </td>
                            </form>
                        @elseif (Auth::user()->hasRole('editor'))
                            <a class="btn btn-primary mr-4" href="{{ route('vidEdit.edit', $videos->id) }}">Edit</a>
                            <form action="{{ route('vidEdit.destroy', $videos->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td>
                                    <button class="btn btn-danger">Borrar</button>
                                </td>
                            </form>

                        @endif
                    </div>

                @endauth
            </div>
            <div style="border-radius: 8px;" class="form-floating bg-light py-2 text-dark border text-center w-75">
                <h4>Comentarios</h4>
                <form class="d-flex justify-content-center align-items-center flex-column"
                      action="{{ route('comment.update', $videos->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 text-center text-dark form-group">
                        <label for="name">Comenta el video:</label>
                        <textarea maxlength="255" required class="form-control" rows="4" id="comment"
                                  name="comment"></textarea>
                    </div>
                    <button type="submit" name="newPost" class="btn btn-primary bg-dark font-weight-bold">Comentar
                    </button>
                    <br/>
                    <br/>
                </form>
                <br>
                <div class="flex-column d-flex align-items-center">
                    @foreach ($comments->get() as $comment)
                        <div
                            style="margin-bottom:10px; padding: 10px; background-color: #dbdbdb; border: 1px solid #c8c8c8; border-radius: 8px; "
                            class="w-75 shadow text-dark text-left">
                            <div class="d-flex justify-content-end w-25 float-right">
                                <div class="d-flex flex-column h-50 justify-content-around">

                                    <span class="text-muted">Hace:
                                    {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                    <div class="align-self-center mt-4">
                                        @if (Auth::user()->hasRole('admin'))
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <td>
                                                    <button class="btn btn-danger">Borrar</button>
                                                </td>
                                            </form>
                                        @elseif(Auth::user()->name == $comment->getUserName())
                                            <form class="mt-5" action="{{ route('comment.destroy', $comment->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <td>
                                                    <button class="btn btn-danger">Borrar</button>
                                                </td>
                                            </form>
                                        @endif
                                    </div>


                                </div>
                            </div>
                            <br>
                            <div>
                                <p><strong>{{ $comment->getUserName() }}</strong></p>
                                <p>{{ $comment->comment }}</p>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
