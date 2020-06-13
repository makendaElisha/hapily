@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h4 class="c-grey-900 mT-10 mB-20">Payments</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                @if (count($payments) > 0)
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%" data-order="[]">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Payment Method</th>
                                <th>Payment Type</th>
                                <th>Product Purchased</th>
                                <th>Amount Paid</th>
                                <th>Order ID</th>
                                <th>Payment date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->buyer_email}}</td>
                                    <td>{{$payment->buyer_first_name}} {{$payment->buyer_last_name}}</td>
                                    <td>{{$payment->payment_method}}</td>
                                    <td>{{$payment->payment_type}}</td>
                                    <td>{{$payment->product_name}}</td>
                                    <td>&euro; {{$payment->transaction_amount}}</td>
                                    <td>{{$payment->order_id}}</td>
                                    <td>{{$payment->order_date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger" role="alert">
                        No payment record found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
