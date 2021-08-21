@extends('admin.admin_layouts')

@section('admin_content')

@php
$blogcategory = DB::table('post_category')->get();
@endphp

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
                <a href="{{route('all.blogpost')}}" class="btn btn-success btn-sm pull-right">All Post</a>
            </h6>
            <div class="table-wrapper">
                <form action="{{url('update/post/'.$post->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (ENGLISH): <span class="tx-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="post_title_en"
                                    value="{{$post->post_title_en}}" placeholder="Enter Post Title">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (VIETNAM): <span class="tx-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="post_title_vi"
                                    value="{{$post->post_title_vi}}" placeholder="Enter Post Title">
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
                                    <option value="{{$row->id}}"
                                        <?php if($row->id == $post->category_id){ echo "selected"; } ?>>
                                        {{$row->category_name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Details (ENGLISH): <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="details_en"
                                    id="summernote">{!! $post->details_en !!}</textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Details (VIETNAM): <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="details_vi"
                                    id="summernote1">{!! $post->details_vi !!}</textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6 ">
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
                        <div class="col-lg-6 ">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Old Post Image: <span class="tx-danger">*</span>
                                </label>
                                <br>
                                <label class="custom-file">
                                    <input type="hidden" class="custom-file-input" name="old_post_image"
                                        value="{{$post->post_image}}">
                                </label>
                                <img src="{{URL::to($post->post_image)}}" width="70px;" height="80px;">
                            </div>
                        </div><!-- col-4 -->


                    </div><!-- row -->
                    <hr>
                    <br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Update</button>
                    </div><!-- form-layout-footer -->
                </form>
            </div><!-- table-wrapper -->
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