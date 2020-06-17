@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="padding: 2rem">
                    <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; text-align: center">User <span class="main_color">Settings</span></h1></div>
                    <hr style="margin-bottom: 2rem">

                    <div class="card-body">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-header"><strong>Edit Profile</strong></div>
                                <form action="{{ route('update.user') }}" method="post">
                                    @csrf
                                    <div class="card-body">

                                        <input type="hidden" name="id" value="{{ $user->id }}">

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('name') }}</strong>
                                                     </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" style="background-color: #14896a">Update User</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header"><strong>Change Password</strong></div>
                                <form action="{{ route('user.password.update') }}" method="post">
                                    @csrf
                                    <div class="card-body">

                                        <input type="hidden" name="id" value="{{ $user->id }}">

                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <input type="password" name="password" placeholder="Enter New Password" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" placeholder="Retype New Password" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" style="background-color: #14896a">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection




