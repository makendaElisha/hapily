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
                            <th>Actions</th>
                            <th>Name</th>
                            <th>Instant Help</th>
                            <th>ResPrio</th>
                            <th>Belief</th>
                            <th>Book </th>
                            <th>Book description</th>
                            <th>Recom Program</th>
                            <th>Recom Program description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $supportImageExtensions = ['gif','jpg','jpeg','png'];
                            $imgUrl                 = 'https://process.fs.teachablecdn.com'; //for valid image per its url
                        @endphp
                        @foreach ($areaOfLife->symptoms as $key => $symptom)
                            <tr>
                                <td>
                                    <a href="/area/{{$areaOfLife->id}}/symptom/{{$symptom->id}}/edit" style="color:green;"><i class="btn c-blue-500 ti-pencil-alt"></i></a>
                                    <form action="{{ route('symptom.destroy', [$areaOfLife->id, $symptom->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn" onclick="return confirm('!! Are you sure you want to delete this symtom and all its mappings? !! ')"><i class="c-red-500 ti-trash"></i></button>
                                    </form>
                                </td>
                                <td>{{$symptom->name}}</td>
                                <td>
                                    @php
                                        $text = $symptom->instant_help;
                                        $position = false;
                                        if (strlen($text) > 51) {
                                            $position = strpos($text, ' ', 50);
                                        }
                                    @endphp
                                    @if ($position !== false)
                                        <span>
                                            {{substr($text, 0, $position)}}
                                        </span>
                                        <span id="{{$key + 100}}" style="display:none">
                                            {{substr($text, $position)}}
                                        </span>
                                        <button class="btn btn-link" onclick="showMore({{$key + 100}})">Read more...</button>
                                    @else
                                        {{$text}}   
                                    @endif

                                </td>
                                <td>{{$symptom->res_prio}}</td>
                                <td>{{$symptom->belief}}</td>
                                <td>
                                    <a href="{{$symptom->recom_book_url}}" target="_blank"><img src="{{$symptom->recom_book_image}}" height="150" width="100" /></a>
                                </td>
                                <td>
                                    @php
                                        $text = $symptom->recom_book_description;
                                        $position = false;
                                        if (strlen($text) > 51) {
                                            $position = strpos($text, ' ', 50);
                                        }
                                    @endphp
                                    @if ($position !== false)
                                        <span>
                                            {{substr($text, 0, $position)}}
                                        </span>
                                        <span id="{{$key + 200}}" style="display:none">
                                            {{substr($text, $position)}}
                                        </span>
                                        <button class="btn btn-link" onclick="showMore({{$key + 200}})">Read more...</button>
                                    @else
                                        {{$text}}   
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $ext = strtolower(pathinfo($symptom->recom_program_image, PATHINFO_EXTENSION));
                                        $pos = strpos($symptom->recom_program_image, $imgUrl);
                                    @endphp
                                    @if(in_array($ext, $supportImageExtensions))
                                        <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{$symptom->recom_program_image}}" height="150" width="100" /></a>
                                    @elseif($pos !== false)
                                        <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{$symptom->recom_program_image}}" height="100" width="150" /></a>
                                    @else
                                        <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{ asset('all/images/hapily-coach-image2.png')}}" alt=""  height="150" width="100"></a>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $text = $symptom->recom_program_description;
                                        $position = false;
                                        if (strlen($text) > 51) {
                                            $position = strpos($text, ' ', 50);
                                        }
                                    @endphp
                                    @if ($position !== false)
                                        <span>
                                            {{substr($text, 0, $position)}}
                                        </span>
                                        <span id="{{$key + 300}}" style="display:none">
                                            {{substr($text, $position)}}
                                        </span>
                                        <button class="btn btn-link" onclick="showMore({{$key + 300}})">Read more...</button>
                                    @else
                                        {{$text}}   
                                    @endif
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
            // "scrollY":        "600px",
            // "scrollCollapse": true,
            // "scrollX": true
        });
    });
</script>
<script>
    function showMore(id) {
        var x = document.getElementById(id);
        var nextBtn = x.nextElementSibling;
        if (x.style.display === "none") {
            x.style.display = "inline";
            nextBtn.innerHTML = "Read less...";
        } else {
            x.style.display = "none";
            nextBtn.innerHTML = "Read more...";
        }
    }
</script>