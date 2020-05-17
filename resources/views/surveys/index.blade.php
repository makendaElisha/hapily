@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mT-10 mB-20">Survey Results</h4>
    {{-- <a href="/survey/submit" type="button" class="btn btn-primary c-white mB-10" style="background-color:purple;">Simulate Survey :)</a> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                {{-- <h4 class="c-grey-900 mB-20">Survey Results</h4> --}}
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%" data-order="[]">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Submission date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{$customer->prename}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{ \Carbon\Carbon::parse($customer->submit_date)->format('d-M-Y') }}</td>
                                <td><a href="{{ url($customer->survey_url) }}" class="btn btn-link" style="color:purple;">&gt; Go To Results</a></td>
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
