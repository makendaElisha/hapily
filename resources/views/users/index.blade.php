@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mB-20">Users</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('delete-msg'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('delete-msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @hasanyrole('super-admin|admin')
                    <a href= "{{route('user.create')}}" type="button" class="btn btn-primary c-white mB-10">Add New User</a>
                @endrole
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>email</th>
                            <th>Joined on</th>
                            <th>Role</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at }}</td>
                                <td>{{$user->getRoleNames()->first()}}</td>
                                <td>
                                    <a href="/user/{{$user->id}}/edit" class="btn btn-primary">Edit User</a>
                                </td>
                                <td>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
                                    </form>
                                    {{-- <a href="/user/{{$user->id}}/delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection