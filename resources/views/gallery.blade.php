@extends('layouts.app')

@section('content')

    <div class="container">
        @include('includes.flash_message')
        <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; color: white">{{ $album->name }} <span>({{ count($album->photos) }})</span></h1></div>
        <br>
        <div class="row">
            @foreach($photos as $photo)
                <div class="col-md-3">
                    <a href="{{ asset($photo->path) }}" data-lightbox="roadtrip"><img src="{{ asset($photo->path) }}" style="width: 100%;" class="img-fluid img-thumbnail"></a>
                </div>
            @endforeach
        </div>
        <br>
        <div class="row justify-content-center">
            {{ $photos->render() }}
        </div>
    </div>

@endsection

