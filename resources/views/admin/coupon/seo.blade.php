@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Seo Setting Section</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="sl-page-title">
                <h5>Seo Setting</h5>
                <br>
                <p>New Post Add Form</p>
            </div><!-- sl-page-title -->
            <div class="form-layout">
                    <form action="{{route('update.seo')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$seo->id}}">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Tilte: <span class="tx-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="meta_title" value="{{$seo->meta_title}}" >
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Author: <span class="tx-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="meta_author" value="{{$seo->meta_author}}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Tag: <span class="tx-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="meta_tag" value="{{$seo->meta_tag}}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Meta Description: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="meta_description" >{{$seo->meta_description}}</textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Google Analytics: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="google_analytics" >{{$seo->google_analytics}}</textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Bing Analytics: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="bing_analytics" >{{$seo->bing_analytics}}</textarea>
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