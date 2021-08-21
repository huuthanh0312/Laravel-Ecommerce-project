@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Category</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        @error('category_name')

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @enderror
        <div class="sl-page-title">
            <h5>Category Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Category List
                <a href="" class="btn btn-sm btn-warning" style="float:right;" data-toggle="modal"
                    data-target="#modal_add_cate">Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Category Name</th>
                            <th class="wd-15p">Created Date</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $key=>$cate)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$cate->category_name}}</td>
                            <td>{{Carbon\Carbon::parse($cate->created_at)->diffForHumans()}}</td>
                            <td>
                                <a href="{{URL::to('edit/category/'.$cate->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{URL::to('delete/category/'.$cate->id)}}" class="btn btn-sm btn-danger"
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
<div id="modal_add_cate" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Category Add New</h6>
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
            <form action="{{route('store.category')}}" method="post">
                @csrf
                <div class="modal-body pd-20">
                    <label for="cate_name">Category Name</label>
                    <input type="text" name="category_name" class="form-control" id="cate_name" placeholder="category">
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