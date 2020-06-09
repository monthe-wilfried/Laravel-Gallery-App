@extends('layouts.app')

@section('content')

    <div class="container">
        @include('includes.flash_message')
        <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; color: grey">{{ $album->name }} <span>({{ count($album->photos) }})</span></h1></div>

        @auth()
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add Photos
            </button>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $album->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('album.add.photo') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="album_id" value="{{ $album->id }}">

                                <div class="form-control input-group initial-add-more">
                                    <input type="file" name="path[]" class="form-control" id="image">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success btn-add-more" type="button"><span style="font-weight: bold">+</span> Add More</button>
                                    </div>
                                </div>

                                <div class="copy" style="display: none;">
                                    <div class="form-control input-group control-group add-more" style="margin-top: 15px">
                                        <input type="file" name="path[]" class="form-control" id="image">
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger btn-remove" type="button"><span style="font-weight: bold">-</span> Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Photos</button>
                                </div>
                            </form>

                        </div>


                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
                        <script type="text/javascript">

                            $(document).ready(function (e) {
                                $(".btn-add-more").click(function () {
                                    var html=$(".copy").html();
                                    $(".initial-add-more").after(html);
                                });
                                $("body").on("click", ".btn-remove", function () {
                                    $(this).parents(".control-group").remove();
                                })
                            });

                        </script>
                    </div>
                </div>
            </div>
        @endauth


        <div class="row">
            @foreach($album->photos as $photo)
                <div class="col-sm-4">
                    <div class="item">
                        <img src="{{ asset($photo->path) }}" class="img-thumbnail">
                    </div>

                @auth()
                    <!-- Button trigger modal -->
                        <button type="button" style="margin-top: 3px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $photo->id }}">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $photo->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want to delete?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('photo.delete', $photo->id) }}" method="post">
                                            @csrf
                                            <button data-toggle="modal" data-target="#exampleModal" style="margin-top: 3px;" type="submit" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </form>

                                    </div>
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

</style>
