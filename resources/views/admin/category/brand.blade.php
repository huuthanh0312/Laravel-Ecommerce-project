@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Brand</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>
    
    
    <div class="sl-pagebody">
    @error('brand_name')
 
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @enderror
    @error('brand_logo')

    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @enderror
        <div class="sl-page-title">
            <h5>Brand Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Brand List
                <a href="" class="btn btn-sm btn-warning" style="float:right;" data-toggle="modal"
                    data-target="#modal_add_brand">Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Brand Name</th>
                            <th class="wd-15p">Logo</th>
                            <th class="wd-15p">Created Date</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $key=>$brand)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$brand->brand_name}}</td>
                            <td><img src="{{URL::to($brand->brand_logo)}}" width="50px;" height="50px;"></td>
                            <td>{{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}</td>
                            <td>
                                <a href="{{URL::to('edit/brand/'.$brand->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{URL::to('delete/brand/'.$brand->id)}}" class="btn btn-sm btn-danger"
                                    id="delete">Delete</a>
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
<!-- Add Category MODAL -->
<div id="modal_add_brand" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Brand Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{route('store.brand')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" id="brand_name"
                            placeholder="brand name">
                    </div>
                    <div class="form-group">
                        <label for="brand_logo">Images</label>
                        <input type="file" name="brand_logo" class="form-control" id="brand_logo">
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
@endsection