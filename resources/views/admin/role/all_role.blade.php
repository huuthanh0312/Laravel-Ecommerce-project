@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">User Role</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Admin Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Admin List
                <a href="{{route('admin.add.user')}}" class="btn btn-sm btn-warning" style="float:right;">Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Name</th>
                            <th class="wd-15p">Phone</th>
                            <th class="wd-15p">Access</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->phone}}</td>
                            <td>
                                @if($row->category == 1)
                                <span class="badge badge-success">Category</span>
                                @endif
                                @if($row->coupon == 1)
                                <span class="badge badge-primary">Coupon</span>
                                @endif
                                @if($row->product == 1)
                                <span class="badge badge-success">Product</span>
                                @endif
                                @if($row->order == 1)
                                <span class="badge badge-info">Order</span>
                                @endif
                                @if($row->blog == 1)
                                <span class="badge badge-danger">Blog</span>
                                @endif
                                @if($row->report == 1)
                                <span class="badge badge-dark">Report</span>
                                @endif
                                @if($row->return == 1)
                                <span class="badge badge-warning">Return</span>
                                @endif
                                @if($row->return == 1)
                                <span class="badge badge-dark">Stock</span>
                                @endif
                                @if($row->contact == 1)
                                <span class="badge badge-warning">contact</span>
                                @endif
                                @if($row->comment == 1)
                                <span class="badge badge-success">Comment</span>
                                @endif
                                @if($row->setting == 1)
                                <span class="badge badge-dark">Setting</span>
                                @endif
                                @if($row->role == 1)
                                <span class="badge badge-warning">Role</span>
                                @endif
                                @if($row->other == 1)
                                <span class="badge badge-info">Other</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{URL::to('edit/user/role/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{URL::to('delete/user/role/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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