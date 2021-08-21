@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Return Order</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{$title}}</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Return List
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
                            <th class="wd-15p">Return </th>
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
                                @if($row->return_order == 1)
                                <span class="badge badge-warning">Pending</span>
                                @elseif($row->return_order == 2)
                                <span class="badge badge-success">Success</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-success">Return Success</span>
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