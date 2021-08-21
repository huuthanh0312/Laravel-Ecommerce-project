@extends('layouts.app')

@section('content')
<!-- Login and Register Form -->
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8 card">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Status Code</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Return</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $row)
                        <tr>
                            <td scope="col">{{$row->status_code}}</td>
                            <td scope="col">{{$row->payment_type}}</td>
                            <td scope="col">
                                @if($row->return_order == 0)
                                <span class="badge badge-warning">No Request</span>
                                @elseif($row->return_order == 1)
                                <span class="badge badge-warning">Pending</span>
                                @elseif($row->return_order == 2)
                                <span class="badge badge-success">Success</span>
                                @endif
                            </td>
                            <td scope="col">{{$row->total}}$</td>
                            <td scope="col">{{$row->date}}</td>
                            <td scope="col">
                                @if($row->status == 0)
                                <span class="badge badge-warning">Pending</span>
                                @elseif($row->status == 1)
                                <span class="badge badge-info">Payment Accept</span>
                                @elseif($row->status == 2)
                                <span class="badge badge-warning">Progress</span>
                                @elseif($row->status == 3)
                                <span class="badge badge-success">Delevered</span>
                                @else
                                <span class="badge badge-danger">Cancel</span>
                                @endif
                            </td>
                            <td scope="col">
                                @if($row->return_order == 0)
                                <a href="{{url('request/return/'.$row->id)}}" class="btn btn-danger" id="return">Return</a>
                                @elseif($row->return_order == 1)
                                <span class="badge badge-warning">Pending</span>
                                @elseif($row->return_order == 2)
                                <span class="badge badge-success">Success</span>
                                @endif
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4 ">
                <div class="card ">
                    <img src="{{ asset('public/frontend/images/send.png')}}" alt="" class="card-img-top mt-2" 
                        style="width:80px; height:80px; margin-left:34%;">

                    <div class="card-body text-center">
                        <h5 class="card-title">{{Auth::user()->name}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center"> 
                            <a href="{{route('password.change')}}">Change Password</a> 
                        </li>
                        <li class="list-group-item text-center">
                            <a href="{{route('password.change')}}">Edit Profile</a> 
                        </li>
                        <li class="list-group-item text-center">
                            <a href="{{route('success.orderlist')}}">Return Order</a> 
                        </li>
                    </ul>
                    <div class="card-footer ">
                        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>
@endsection