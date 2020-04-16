@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mT-10 mB-20">Data Tables</h4>
    <a href= "{{route('area.create')}}" type="button" class="btn btn-primary c-white mB-10">New Area</a>

    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-20">Bootstrap Data Table</h4>
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areasOfLife as $areaOfLife)
                            <tr>
                                <td>{{$areaOfLife->title}}</td>
                                <td>
                                    <a href="/area-of-life/{{$areaOfLife->id}}/edit" style="color:green;">Edit</a>
                                    |
                                    <a href="/area/{{$areaOfLife->id}}/symptom" style="color:purple;">Go to Symptoms</a>
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