@extends('layouts.app')

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item col-md-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Update Area</h6>
                <div class="mT-30">
                    <form action="{{route('area.update', $areaOfLife)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" name="name" value="{{old('name', $areaOfLife->name)}}" class="form-control" id="name" placeholder="Enter text">
                            <p style="color: red;"> @error('name') {{$message}} @enderror</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection