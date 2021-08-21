@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Post Section</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
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
            <div class="sl-page-title">
                <h5>New Post Add
                    <a href="{{route('all.blogpost')}}" class="btn btn-success btn-sm pull-right">All Post</a>
                </h5>
                <br>
                <p>New Post Add Form</p>
            </div><!-- sl-page-title -->
            <div class="form-layout">
                <form action="{{route('store.blogpost')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (ENGLISH): <span class="tx-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="post_title_en" value=""
                                    placeholder="Enter Post Title">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (VIETNAM): <span class="tx-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="post_title_vi" value=""
                                    placeholder="Enter Post Title">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12 center">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Blog Category: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose Category"
                                    name="category_id">
                                    <option label="Choose Category"></option>
                                    @foreach($blogcategory as $row)
                                    <option value="{{$row->id}}">{{$row->category_name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Details (ENGLISH): <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="details_en" id="summernote"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Details (VIETNAM): <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="details_vi" id="summernote1"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12 ">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Post Image: <span class="tx-danger">*</span>
                                </label>
                                <br>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="post_image"
                                        onchange="readURL_one(this);">
                                    <span class="custom-file-control"></span>
                                </label>
                                <img src="#" id="one" style="display:none;">
                            </div>
                        </div><!-- col-4 -->


                    </div><!-- row -->
                    <hr>
                    <br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Submit Form</button>
                    </div><!-- form-layout-footer -->
                </form>
            </div><!-- form-layout -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
    @include('admin.footer')
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<script type="text/javascript">
function readURL_one(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#one').attr('src', e.target.result)
                .width(80)
                .height(80)
                .css('display', 'block');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection