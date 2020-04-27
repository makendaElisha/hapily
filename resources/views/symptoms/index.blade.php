@extends('layouts.app')

@section('content')

<style>
#symptom-read-more {
    display: none;
}

</style>

<div class="container-fluid">
    <h4 class="c-grey-900 mB-20">Symptoms in <span style="color:#DD22EF;">"{{$areaOfLife->name}}"</span> area of life</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                @role('super-admin')
                    <a href="/area/{{$areaOfLife->id}}/symptom/create" type="button" class="btn btn-primary c-white mB-10">Add New Symptom</a>
                @endrole
                <br />
                <table id="survey" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
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
                        @php
                            $supportImageExtensions = ['gif','jpg','jpeg','png'];
                        @endphp
                        @foreach ($areaOfLife->symptoms as $symptom)
                            <tr>
                                <td>{{$symptom->name}}</td>
                                <td>{{$symptom->instant_help}}</td>
                                <td>{{$symptom->res_prio}}</td>
                                {{-- <td>{{$symptom->fear}}</td>
                                <td>{{$symptom->anger}}</td>
                                <td>{{$symptom->sadness}}</td> --}}
                                <td>{{$symptom->belief}}</td>
                                <td><a href="{{$symptom->recom_book_url}}" target="_blank">{{$symptom->recom_book_url}}</a></td>
                                <td><a href="{{$symptom->recom_book_image}}" target="_blank"><img src="{{$symptom->recom_book_image}}" height="150" width="100" /></a></td>
                                <td>{{$symptom->recom_book_description}}</td>
                                <td><a href="{{$symptom->recom_program_url}}">{{$symptom->recom_program_url}}</a></td>
                                <td>
                                    @php
                                        $ext = strtolower(pathinfo($symptom->recom_program_image, PATHINFO_EXTENSION));
                                    @endphp
                                    @if(in_array($ext, $supportImageExtensions))
                                        <a href="{{$symptom->recom_program_image}}" target="_blank"><img src="{{$symptom->recom_program_image}}" height="150" width="100" /></a>
                                    @else
                                        <a href="{{$symptom->recom_program_image}}">{{$symptom->recom_program_image}}</a>
                                    @endif
                                </td>
                                <td>{{$symptom->recom_program_description}}</td>
                                <td>
                                    <a href="/area/{{$areaOfLife->id}}/symptom/{{$symptom->id}}/edit" style="color:green;"><i class="btn c-blue-500 ti-pencil-alt"></i></a>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#survey').dataTable({
            "scrollY":        "600px",
            "scrollCollapse": true,
            "scrollX": true
        });
    });
</script>