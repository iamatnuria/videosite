@extends('layouts.app')

@section('content')
    <div class=" container-fluid w-50 text-center">

        <h1 class="my-4">Nuevo video</h1>
        <form action="{{route('vidEdit.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="title">Titulo</label>
        <br/>
            <input type="text" name="title" id="title" value="" class="mt-4 form form-control" required>
            <br/>
        <label for="desc">Descripcion</label>
            <input type="text" name="desc" id="desc" value="" class="mt-4 form form-control" required>
            <br/>
    <label for="video">Video</label>
            <input type="file" id="video" name="video" class="">
            <br/>
            <input type="submit" class="btn btn-primary btn-lg px-xl-5" value="Subir">
            <br/>
            <br/>
        </form>
    <br/>
    </div>

    @endsection
