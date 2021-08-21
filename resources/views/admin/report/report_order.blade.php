@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Report</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{$title}}</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">{{$title}}
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Patment Type</th>
                            <th class="wd-15p">Order ID</th>
                            <th class="wd-15p">Subtotal</th>
                            <th class="wd-15p">Shipping </th>
                            <th class="wd-15p">Total</th>
                            <th class="wd-15p">Date</th>
                            <th class="wd-15p">Status </th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $row)
                        <tr>
                            <td>{{$row->payment_type}}</td>
                            <td>{{$row->stripe_order_id}}</td>
                            <td>{{$row->subtotal}}</td>
                            <td>{{$row->shipping}}</td>
                            <td>{{$row->total}}</td>
                            <td>{{$row->date}}</td>
                            <td>                               
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
                            <td>
                                <a href="{{URL::to('admin/view/order/'.$row->id)}}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->
    @include('admin.footer')
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection