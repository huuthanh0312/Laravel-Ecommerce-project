@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Brand</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Brand Edit</h6>
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
            <form action="{{url('update/brand/'.$brand->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" name="brand_name" value="{{$brand->brand_name}}" class="form-control" id="brand_name"
                            placeholder="brand name">
                    </div>

                    <div class="form-group">
                        <label for="brand_logo">Brand Logo</label>
                        <input type="file" name="brand_logo" value="{{URL::to($brand->brand_logo)}}" class="form-control" id="brand_logo">
                    </div>
                    <div class="form-group">
                        <label for="brand_logo">Old Brand Logo</label>
                        <img src="{{URL::to($brand->brand_logo)}}" width="70;" height="80px;">
                        <input type="hidden" value="{{$brand->brand_logo}}" name="old_logo">
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