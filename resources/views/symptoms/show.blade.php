@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-20">Symptoms in {{$areaOfLife->name}}</h4>
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>Instant Help</th>
                            <th>ResPrio</th>
                            <th>Fear</th>
                            <th>Fear</th>
                            <th>Anger</th>
                            <th>Sadness</th>
                            <th>Belief</th>
                            <th>Book url</th>
                            <th>Book img </th>
                            <th>Book description </th>
                            <th>Recom Program url</th>
                            <th>Recom Program image</th>
                            <th>Recom Program description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areaOfLife->symptoms as $symptom)
                            <tr>
                                <td>{{$symptom->text}}</td>
                                <td>{{$symptom->instant_help}}</td>
                                <td>{{$symptom->res_prio}}</td>
                                <td>{{$symptom->fear}}</td>
                                <td>{{$symptom->anger}}</td>
                                <td>{{$symptom->sadness}}</td>
                                <td>{{$symptom->belief}}</td>
                                <td>{{$symptom->recom_book_url}}</td>
                                <td>{{$symptom->recom_book_image}}</td>
                                <td>{{$symptom->recom_book_description}}</td>
                                <td>{{$symptom->recom_program_url}}</td>
                                <td>{{$symptom->recom_program_image}}</td>
                                <td>{{$symptom->recom_program_description}}</td>
                                <td>
                                    <a href="/symptom/{{$symptom->id}}/area-of-life/{{$areaOfLife->id}}/edit" style="color:green;">Edit</a>
                                    <a href="/symptom/{{$symptom->id}}/area-of-life/{{$areaOfLife->id}}/delete" style="color:red;">Delete</a>
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