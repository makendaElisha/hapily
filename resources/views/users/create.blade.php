@extends('layouts.app')

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item col-md-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Add New User</h6>
                <div class="mT-30">
                    <form action="{{route('user.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter name">
                            @if ($errors->has('name'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email">
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
                                @foreach ($roles as $role) 
                                    <option value="{{ $role->name }}" {{ old('role', Session::get('role')) == $role->name ? 'selected' : '' }}>
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

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" name="password" value="" class="form-control" id="password" placeholder="Enter password">
                            @if ($errors->has('password'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Confirm Password</label>
                            <input type="password" name="password_confirm" value="" class="form-control" id="password" placeholder="Confirm Password">
                            @if ($errors->has('password_confirm'))
                                <span style="color: #DC3545;">
                                    {{ $errors->first('password_confirm') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection