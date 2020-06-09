@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @foreach($albums as $album)
                <div class="col-sm-4">
                    <div class="item">
                        <a href="{{ route('album.show', $album->id) }}">
                            <img src="{{ asset($album->cover_image) }}" class="img-thumbnail">
                            <span class="centered">{{ $album->name }}</span>
                        </a>
                    </div>

                    @auth()
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $album->id }}">
                            Add Album Cover Image
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $album->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $album->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('album.cover') }}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $album->id }}">
                                        <div class="modal-body">
                                            <div class="form-control">
                                                <input type="file" name="cover_image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
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
