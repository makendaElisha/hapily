@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mT-10 mB-20">Data Tables</h4>
    <a href="/survey/submit" type="button" class="btn btn-primary c-white mB-10" style="background-color:purple;">Simulate Survey :)</a>

    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-20">Survey Results</h4>
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{$customer->prename}}</td>
                                <td>{{$customer->email}}</td>
                                <td><a href="{{ url($customer->survey_url) }}" class="btn btn-link" style="color:purple;">Go To Results</a></td>
                                {{-- <td>
                                    <form action="{{$customer->survey_url}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link" style="color:purple;">Go To Results</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection