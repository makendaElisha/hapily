@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mB-20">Users</h4>
    <div class="row">
        <div class="col-md-8">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                <td>{{$user->roleName()}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn" href="{{ url('/user/' . $user->id . '/edit')}}"><i class="c-blue-500 ti-pencil-alt"></i></a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn" onclick="return confirm('Are you sure you want to delete this user?')"><i class="c-red-500 ti-trash"></i></button>
                                        </form>
                                      </div>
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