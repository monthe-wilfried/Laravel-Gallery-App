@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="padding: 2rem">
                    <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; text-align: center">My <span class="main_color">Profile</span></h1></div>
                    <hr style="margin-bottom: 2rem">

                    @if(Auth::user()->user_type == 'SUPER ADMINISTRATOR')
                        <div class="card-body">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Name:</strong><span class="float-right">{{ Auth::user()->name }}</span></li>
                                            <li class="list-group-item"><strong>Email:</strong><span class="float-right">{{ Auth::user()->email }}</span></li>
                                            <li class="list-group-item"><strong>User Role:</strong><span class="float-right badge badge-secondary">{{ Auth::user()->user_type }}</span></li>
                                            <li class="list-group-item"><strong>Member since:</strong><span class="float-right">{{ Auth::user()->created_at }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-header"><strong>Create New User</strong></div>
                                    <form action="{{ route('user.register') }}" method="post">
                                        @csrf
                                        <div class="card-body">

                                            <input type="hidden" name="user_type" value="child administrator">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('name') }}</strong>
                                                     </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm">Confirm Password</label>
                                                <input type="password" name="password_confirmation" placeholder="Retype Password" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" style="background-color: #14896a">Create User</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Name:</strong><span class="float-right">{{ Auth::user()->name }}</span></li>
                                            <li class="list-group-item"><strong>Email:</strong><span class="float-right">{{ Auth::user()->email }}</span></li>
                                            <li class="list-group-item"><strong>User Role:</strong><span class="float-right badge badge-secondary">{{ Auth::user()->user_type }}</span></li>
                                            <li class="list-group-item"><strong>Member since:</strong><span class="float-right">{{ Auth::user()->created_at }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection




