@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mB-20">Hapily - Areas of life</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <a href= "{{route('area.create')}}" type="button" class="btn btn-primary c-white mB-10">Add New Area</a>
                <br />
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areasOfLife as $areaOfLife)
                            <tr>
                                <td>{{$areaOfLife->name}}</td>
                                <td>
                                    @role('super-admin')
                                        <a href="/area-of-life/{{$areaOfLife->id}}/edit" class="btn btn-primary">Edit Symptom</a>
                                    @endrole
                                    <a href="/area/{{$areaOfLife->id}}/symptom" class="btn btn-info">Go to Symptoms</a>
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