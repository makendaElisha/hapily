@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mB-20">Hapily - Areas of life</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                @role('super-admin')
                    <a href= "{{route('area.create')}}" type="button" class="btn btn-primary c-white mB-10">Add New Area</a>
                @endrole
                <br />
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Area name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areasOfLife as $areaOfLife)
                            <tr>
                                <td>{{$areaOfLife->name}}</td>
                                <td>
                                    @role('super-admin')
                                        <a class="btn" href="{{url('/area-of-life/' . $areaOfLife->id . '/edit')}}"><i class="c-blue-500 ti-pencil-alt"></i></a>
                                        {{-- <a href="/area-of-life/{{$areaOfLife->id}}/edit" class="btn btn-primary">Edit Area of Life</a> --}}
                                    @endrole
                                    <a href="/area/{{$areaOfLife->id}}/symptom" class="btn"><i class="c-purple-500 ti-arrow-circle-right"></i> <span class="c-purple-500">Symptoms</span></a>
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