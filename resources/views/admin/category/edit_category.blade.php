@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Category</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Category Edit</h6>
            <div class="table-wrapper">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{url('update/category/'.$category->id)}}" method="post">
                @csrf
                <div class="modal-body pd-20">
                    <label for="cate_name">Category Name</label>
                    <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control" id="cate_name" placeholder="category">
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