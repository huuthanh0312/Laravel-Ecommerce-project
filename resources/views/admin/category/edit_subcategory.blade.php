@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Sub Category</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Data Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Sub Category List
            </h6>
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

            <form action="{{url('update/subcategory/'.$subcategory->id)}}" method="post">
                @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label for="subcategory_name">Sub Category Name</label>
                        <input type="text" name="subcategory_name" value="{{$subcategory->subcategory_name}}" class="form-control" id="subcategory_name"
                            placeholder="Sub Category Name">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category Name</label>
                        <select name="category_id" class="form-control" id="category_id" >
                            @foreach($category as $cate)
                            <option value="{{$cate->id}}" <?php if($cate->id == $subcategory->category_id){echo "selected";} ?>  >
                                {{$cate->category_name}}</option>
                            @endforeach
                        </select>
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