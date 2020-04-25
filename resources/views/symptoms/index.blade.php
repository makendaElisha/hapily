@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mB-20">Symptoms in <span style="color:#DD22EF;">"{{$areaOfLife->name}}"</span> area of life</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                @role('super-admin')
                    <a href="/area/{{$areaOfLife->id}}/symptom/create" type="button" class="btn btn-primary c-white mB-10">Add New Symptom</a>
                @endrole
                <br />
                <div class="col-sm-10">
                </div>
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>Instant Help</th>
                            <th>ResPrio</th>
                            {{-- <th>Fear</th>
                            <th>Anger</th>
                            <th>Sadness</th> --}}
                            <th>Belief</th>
                            <th>Book url</th>
                            <th>Book img </th>
                            <th>Book description</th>
                            <th>Recom Program url</th>
                            <th>Recom Program image</th>
                            <th>Recom Program description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areaOfLife->symptoms as $symptom)
                            <tr>
                                <td>{{$symptom->name}}</td>
                                <td>{{str_limit($symptom->instant_help, $limit = 20, $end = '...')}}</td>
                                <td>{{$symptom->res_prio}}</td>
                                {{-- <td>{{$symptom->fear}}</td>
                                <td>{{$symptom->anger}}</td>
                                <td>{{$symptom->sadness}}</td> --}}
                                <td>{{$symptom->belief}}</td>
                                <td>{{$symptom->recom_book_url}}</td>
                                <td>{{$symptom->recom_book_image}}</td>
                                <td>{{$symptom->recom_book_description}}</td>
                                <td>{{$symptom->recom_program_url}}</td>
                                <td>{{$symptom->recom_program_image}}</td>
                                <td>{{$symptom->recom_program_description}}</td>
                                <td>
                                    <a href="/area/{{$areaOfLife->id}}/symptom/{{$symptom->id}}/edit" style="color:green;"><i class="c-blue-500 ti-pencil-alt"></i></a>
                                    <form action="{{ route('symptom.destroy', [$areaOfLife->id, $symptom->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn" onclick="return confirm('!! Are you sure you want to delete this symtom and all its mappings? !! ')"><i class="c-red-500 ti-trash"></i></button>
                                    </form>
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