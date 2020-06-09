@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.flash_message')
                <div class="card" style="padding: 2rem">
                    <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; text-align: center">Photo Gallery App</h1></div>
                    <hr style="margin-bottom: 2rem">

                    <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="name">Name of Album <span style="color: darkred">*</span></label>
                        <div class="form-control" style="margin-bottom: 3rem">
                            <input type="text" name="name" class="form-control" placeholder="Enter album name here...">
                            @if($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        </div>

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

                            <button type="submit" class="btn btn-primary">Create Album</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
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



