@extends('layouts.app')

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item col-md-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">My Profile</h6>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="mT-30">
                    <form action="{{route('user.update', [auth()->user()->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" id="name" placeholder="Enter name">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @if ($errors->has('name'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" id="email" placeholder="Enter email">
                            @if ($errors->has('email'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Role</label>
                            <select id="role" name="role" class="form-control">
                                <option value="">Select user role</option>
                                @php
                                    $roles = \Spatie\Permission\Models\Role::all();
                                @endphp
                                @foreach ($roles as $role) 
                                    <option value="{{ $role->name }}" {{ old('role', auth()->user()->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('role') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary" disabled>Update Profile</button>
                    </form>
                </div>
                <br /><br />

                <div class="mT-30">
                    <h6 class="c-grey-900">Update Password</h6>
                    <form action="{{route('user.update', [auth()->user()->id])}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">New Password</label>
                            <input type="password" name="password" value="" class="form-control" id="password" placeholder="Enter password">
                            @if ($errors->has('password'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Confirm New Password</label>
                            <input type="password" name="password_confirm" value="" class="form-control" id="password" placeholder="Confirm Password">
                            @if ($errors->has('password_confirm'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('password_confirm') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary" disabled>Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection