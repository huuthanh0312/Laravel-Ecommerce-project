@extends('admin.admin_layouts')

@section('admin_content')

@php
$category = DB::table('categories')->get();
$brand = DB::table('brands')->get();
$subcategory = DB::table('subcategories')->get();
@endphp
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Product Section</span>
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
                <h5>Update Product
                    <a href="{{route('all.product')}}" class="btn btn-success btn-sm pull-right">All Product</a>
                </h5>
                <br>
                <p>Update Product Form</p>
            </div><!-- sl-page-title -->
            <div class="form-layout">
                <form action="{{URL::to('update/product/withoutphoto/'.$product->id)}}" method="post">
                    @csrf
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name"
                                    value="{{$product->product_name}}" placeholder="Enter Product Name">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code"
                                    value="{{$product->product_code}}" placeholder="Enter Product Code">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Discount Price: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="discount_price"
                                    value="{{$product->discount_price}}" placeholder="Enter Discount Price">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_quantity"
                                    value="{{$product->product_quantity}}" placeholder="Enter Product Quantity">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose Category"
                                    name="category_id">
                                    <option label="Choose Category"></option>
                                    @foreach($category as $row)
                                    <option value="{{$row->id}}"
                                        <?php if($row->id == $product->category_id){echo"selected";} ?>>
                                        {{$row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" name="subcategory_id">
                                    @if($product->subcategory_id != null)
                                    @foreach($subcategory as $row)
                                    <option value="{{$row->id}}"
                                        <?php if($row->id == $product->subcategory_id){echo"selected";} ?>>
                                        {{$row->subcategory_name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose Brand" name="brand_id">
                                    <option label="Choose Brand"></option>
                                    @foreach($brand as $row)
                                    <option value="{{$row->id}}"
                                        <?php if($row->id == $product->brand_id){echo"selected";}?>>{{$row->brand_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_size"
                                    value="{{$product->product_size}}" data-role="tagsinput" id="size">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Color: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_color"
                                    value="{{$product->product_color}}" data-role="tagsinput" id="color">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Selling Price</label>: <span
                                    class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="selling_price"
                                    value="{{$product->selling_price}}" placeholder="Selling Price">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Details: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="product_details"
                                    id="summernote">{{$product->product_details}}</textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="video_link"
                                    value="{{$product->video_link}}" placeholder="Enter video link">
                            </div>
                        </div><!-- col-12 -->

                    </div><!-- row -->
                    <hr>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="main_slider" value="1"
                                        <?php if($product->main_slider == 1){echo "checked";} ?>>
                                    <span>Main Slider</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_deal" value="1"
                                        <?php if($product->hot_deal == 1){echo "checked";} ?>>
                                    <span>Hot Deal</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="best_rated" value="1"
                                        <?php if($product->best_rated == 1){echo "checked";} ?>>
                                    <span>Best Rated</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend" value="1"
                                        <?php if($product->trend == 1){echo "checked";} ?>>
                                    <span>Trend Product</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="mid_slider" value="1"
                                        <?php if($product->mid_slider == 1){echo "checked";} ?>>
                                    <span>Mid Slider</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_new" value="1"
                                        <?php if($product->hot_new == 1){echo "checked";} ?>>
                                    <span>Hot New</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="buyone_getone" value="1"
                                        <?php if($product->buyone_getone == 1){echo "checked";} ?>>
                                    <span>BuyOne GetOne</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <hr>
                    <br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Update Product</button>
                    </div><!-- form-layout-footer -->
                </form>
            </div><!-- form-layout -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
    <div class="sl-pagebody">


        <div class="card pd-20 pd-sm-40">
            <div class="sl-page-title">
                <h5>Update Images</h5>
                <br>
            </div><!-- sl-page-title -->
            <div class="form-layout">
                <form action="{{URL::to('update/product/photo/'.$product->id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mg-b-5">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label">Image One (Main Thumbnail):
                                    <span class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_one"
                                        onchange="readURL_one(this);">
                                    <span class="custom-file-control"></span>
                                </label>
                                <br>
                                <img src="#" id="one" style="display:none;">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <img src="{{URL::to($product->image_one)}}" height="80px;" width="80px;">
                            <input type="hidden" name="old_image_one" value="{{$product->image_one}}">
                        </div><!-- col-6 -->
                    </div><!-- row -->
                    <br>
                    <div class="row mg-b-5">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_two"
                                        onchange="readURL_two(this);">
                                    <span class="custom-file-control"></span>
                                </label>
                                <br>
                                <img src="#" id="two" style="display:none;">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <img src="{{URL::to($product->image_two)}}" height="80px;" width="80px;">
                            <input type="hidden" name="old_image_two" value="{{$product->image_two}}">
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <br>
                    <div class="row mg-b-5">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_three"
                                        onchange="readURL_three(this);">
                                    <span class="custom-file-control"></span>
                                </label>
                                <br>
                                <img src="#" id="three" style="display:none;">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <img src="{{URL::to($product->image_three)}}" height="80px;" width="80px;">
                            <input type="hidden" name="old_image_three" value="{{$product->image_three}}">
                        </div><!-- col-6 -->
                    </div><!-- row -->
                    <hr>
                    <br>

                    <div class="form-layout-footer">
                        <button class="btn btn-warning mg-r-5" type="submit">Update Photo</button>
                    </div><!-- form-layout-footer -->
                </form>
            </div><!-- form-layout -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
    @include('admin.footer')
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
<script src="{{asset('public/backend/lib/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('select[name="category_id"]').on('change', function() {
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                url: "{{url('/get/subcategory/')}}/" + category_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var d = $('select[name="subcategory_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="subcategory_id"]').append(
                            '<option value="' + value.id + '">' +
                            value.subcategory_name + '</option>')
                    });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>
<script type="text/javascript">
function readURL_one(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#one').attr('src', e.target.result)
                .width(80)
                .height(80)
                .css("display", "block");
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readURL_two(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#two').attr('src', e.target.result)
                .width(80)
                .height(80)
                .css("display", "block");
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readURL_three(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#three').attr('src', e.target.result)
                .width(80)
                .height(80)
                .css("display", "block");
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection