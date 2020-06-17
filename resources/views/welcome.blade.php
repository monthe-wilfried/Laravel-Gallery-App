@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @foreach($albums as $album)
                <div class="col-sm-4">
                    <div class="item">
                        <a href="{{ route('album.view', $album->id) }}">
                            <img src="{{ asset($album->cover_image) }}" class="img-thumbnail">
                            <span class="centered">{{ $album->name }}</span>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection

<style>
    .item{
        left: 0;
        top: 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
    }

    .item img{
        -webkit-transition: 0.6s ease;
        transition: 0.6s ease;
        border-radius: 10px !important;
    }

    .item img:hover{
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }

    .centered{
        position: absolute;
        top: 40%;
        left: 40%;
        transform: translate(-40%, -40%);
        color: #fff;
        font-size: 30px;
        line-height: 50px;
        font-weight: 700;
        font-family: Montserrat;

    }

</style>
