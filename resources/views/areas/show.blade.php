@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-20">Bootstrap Data Table</h4>
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areasOfLife->symptoms as $symptom)
                            <tr>
                                <td>{{$areaOfLife->name}}</td>
                                <td>
                                    <a href="/mapping/area-of-life/{{$areaOfLife->id}}/symptom/{{$symptom->id}}/edit" style="color:green;">Edit</a>
                                    <a href="/mapping/area-of-life/{{$areaOfLife->id}}/symptom/{{$symptom->id}}/delete" style="color:red;">Go to mapping</a>
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