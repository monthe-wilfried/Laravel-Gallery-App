@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <form action="{{ route('album.store') }}" class="dropzone" method="post">
                @csrf

                <input type="hidden" name="album_id" value="1">

            </form>

            @foreach($photos as $photo)
                <div class="card-img">
                    <img src="{{ asset($photo->path) }}" class="img-thumbnail" width="150">
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection

