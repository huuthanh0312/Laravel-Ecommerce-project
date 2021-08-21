@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Blog Category</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Blog Category Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h6 class="card-body-title">Blog Category Edit
                <a href="{{route('list.blog.category')}}" class="btn btn-sm btn-warning" style="float:right;">All Blog
                    Category</a>
            </h6>
            <div class="table-wrapper">
                <form action="{{url('update/category/blog/'.$blogcat->id)}}" method="post">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="cate_name_en">Category Name English </label>
                            <input type="text" name="category_name_en" value="{{$blogcat->category_name_en}}"
                                class="form-control" id="cate_name_en" placeholder="Category name english">
                        </div>
                        <div class="form-group">
                            <label for="cate_name_vi">Category Name Viet Nam</label>
                            <input type="text" name="category_name_vi" value="{{$blogcat->category_name_vi}}"
                                class="form-control" id="cate_name_vi" placeholder="Category Name Viet Nam">
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    </div>
                </form>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->
    @include('admin.footer')
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection