@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="padding: 2rem">
                    <div class="card-title"><h1 style="font-weight: 700; font-family: Montserrat; font-size: 50px; text-align: center">List of <span class="main_color">Users</span></h1></div>
                    <hr style="margin-bottom: 2rem">

                    <div class="card-body">
                        <br>
                        <div class="table-wrapper">
                            <table id="datatable1" class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="wd-15p">Name</th>
                                    <th class="wd-15p">Email</th>
                                    <th class="wd-20p">Role</th>
                                    <th class="wd-20p">Creation Date</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as  $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><span class="badge badge-secondary">{{ $user->user_type }}</span></td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <a id="delete" href="{{ route('user.delete', $user->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
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




