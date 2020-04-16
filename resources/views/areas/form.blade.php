@extends('layouts.app')

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item col-md-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Create New Area</h6>
                <div class="mT-30">
                    <form action="{{route('area.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="inputAddress">Title</label>
                            <input type="text" name="title" value="{{old('symptom', $area->text)}}" class="form-control" id="inputAddress" placeholder="Enter text">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection