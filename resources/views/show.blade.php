@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="padding: 2rem">
                    <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; text-align: center"><span class="main_color">{{ $album->name }}({{ count($album->photos) }})</span></h1></div>
                    <hr style="margin-bottom: 2rem">

                    <div class="card-header"><strong><h3>Upload Images</h3></strong></div>

                    <div class="card-body">
                        <form action="{{ route('photos.store') }}" method="post" class="dropzone" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                        </form>
                        <div class="container">
                            <br>
                            <div class="row">
                                @foreach($photos as $photo)
                                    <div class="col-md-3">
                                        <a href="{{ asset($photo->path) }}" data-lightbox="roadtrip"><img src="{{ asset($photo->path) }}" style="width: 100%;" class="img-fluid img-thumbnail"></a>
                                        <a id="delete" href="{{ route('photo.delete', $photo->id) }}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash-o"></i> Delete</a>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                {{ $photos->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>

@endsection




