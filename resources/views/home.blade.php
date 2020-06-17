@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="padding: 2rem">
                    <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; text-align: center">Photo <span class="main_color">Gallery</span></h1></div>
                    <hr style="margin-bottom: 2rem">

                    <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Name of Album <span style="color: darkred">*</span></label>
                                <div class="form-control" style="margin-bottom: 3rem">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter album name here..." value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="name">Cover Image<span style="color: darkred">*</span></label>
                                <div class="form-control" style="margin-bottom: 3rem">
                                    <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" onchange="readURL(this)">
                                    <img id="one" src="" style="border-radius: 10px; float:right;">
                                    <br>
                                    @error('cover_image')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cover_image') }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="background-color: #14896a"><i class="fa fa-check"></i> Create Album</button>
                        </div>

                        {{--                        <div class="form-control input-group initial-add-more">--}}
                        {{--                            <input type="file" name="path[]" class="form-control" id="image">--}}
                        {{--                            <div class="input-group-btn">--}}
                        {{--                                <button class="btn btn-success btn-add-more" type="button"><span style="font-weight: bold">+</span> Add More</button>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="copy" style="display: none;">--}}
                        {{--                            <div class="form-control input-group control-group add-more" style="margin-top: 15px">--}}
                        {{--                                <input type="file" name="path[]" class="form-control" id="image">--}}
                        {{--                                <div class="input-group-btn">--}}
                        {{--                                    <button class="btn btn-danger btn-remove" type="button"><span style="font-weight: bold">-</span> Remove</button>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <br>--}}


                    </form>

                    <div class="card-body">
                        <br>
                        <div class="table-wrapper">
                            <table id="datatable1" class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="wd-15p">Album Cover Image</th>
                                    <th class="wd-15p">Album name</th>
                                    <th class="wd-20p">Creation Date</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($albums as  $album)
                                    <tr>
                                        <td><a href="{{ asset($album->cover_image) }}" data-lightbox="{{ uniqid() }}"><img src="{{ asset($album->cover_image) }}" class="img-fluid" width="100"></a></td>
                                        <td>{{ $album->name }}</td>
                                        <td>{{ $album->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('album.show', $album->id) }}" class="btn btn-sm btn-success" style="background-color: #14896a;"><i class="fa fa-eye"></i> View</a>
                                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal2{{$album->id}}"><i class="fa fa-edit"></i> Edit</a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal2{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('album.edit') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Album Name</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <input type="hidden" name="id" value="{{ $album->id }}">

                                                                <div class="form-group">
                                                                    <label for="name">Name of Album <span style="color: darkred">*</span></label>
                                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter album name here..." value="{{ old('name', $album->name) }}">
                                                                    @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>


                                                                <div class="form-group" style="margin-bottom: 3rem">
                                                                    <label for="name">Cover Image<span style="color: darkred">*</span></label>
                                                                    <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" onchange="readURL2(this)">
                                                                    <img id="two" src="{{ asset($album->cover_image) }}" style="border-radius: 10px; width: 150px; height: 130px;">
                                                                    <br>
                                                                    @error('cover_image')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('cover_image') }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" style="background-color: #14896a;">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <a id="delete" href="{{ route('album.delete', $album->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <!-- Ajax code to preview images -->
    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(180)
                        .height(130);
                };
                reader.readAsDataURL(input.files[0]);

            }
        }
    </script>

    <script type="text/javascript">
        function readURL2(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(130);
                };
                reader.readAsDataURL(input.files[0]);

            }
        }
    </script>

    {{--    <script type="text/javascript">--}}

    {{--        $(document).ready(function (e) {--}}
    {{--            $(".btn-add-more").click(function () {--}}
    {{--                var html=$(".copy").html();--}}
    {{--                $(".initial-add-more").after(html);--}}
    {{--            });--}}
    {{--            $("body").on("click", ".btn-remove", function () {--}}
    {{--                $(this).parents(".control-group").remove();--}}
    {{--            })--}}
    {{--        });--}}

    {{--    </script>--}}

    {{--    <script type="text/javascript">--}}

    {{--        $(document).ready(function (e) {--}}
    {{--            $("#form").on('submit', (function (e) {--}}
    {{--                e.preventDefault();--}}

    {{--                $.ajax({--}}
    {{--                    url:'/album',--}}
    {{--                    type:'POST',--}}
    {{--                    data = new FormData(this),--}}
    {{--                    contentType:false,--}}
    {{--                    cache:false,--}}
    {{--                    processData:false,--}}

    {{--                    success: function (response) {--}}
    {{--                        $('.show').html(response);--}}
    {{--                        $("#form")[0].reset();--}}
    {{--                    },--}}
    {{--                    error:function (res) {--}}
    {{--                        alert('Error!')--}}
    {{--                    }--}}
    {{--                });--}}
    {{--            }));--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection



