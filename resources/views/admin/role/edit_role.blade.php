@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">User Role</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Admin Edit </h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <div class="sl-page-title">
                <h5>
                    <a href="{{route('admin.all.user')}}" class="btn btn-success btn-sm pull-right">All User Role </a>
                </h5>
                <br>
                <p>Edit Admin </p>
            </div><!-- sl-page-title -->
            <div class="form-layout">
                <form action="{{url('update/user/role/'.$user->id)}}" method="post" >
                    @csrf
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{$user->name}}"
                                    placeholder="Enter Name" required>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone" value="{{$user->phone}}"
                                    placeholder="Enter Phone Number" required>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{$user->email}}"
                                    placeholder="Enter Email" required>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="password" name="password" value="{{$user->password}}"
                                    placeholder="Enter Password" required>
                            </div>
                        </div><!-- col-6 -->

                    </div><!-- row -->
                    <hr>
                    <br>
                    <br>
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="category" value="1" <?php if($user->category == 1) {echo"checked";} ?> >
                                    <span>Category</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="coupon" value="1" <?php if($user->coupon == 1) {echo"checked";} ?>>
                                    <span>Coupon</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="product" value="1" <?php if($user->product == 1) {echo"checked";} ?>>
                                    <span>Product</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="order" value="1" <?php if($user->order == 1) {echo"checked";} ?>>
                                    <span>Order</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="blog" value="1" <?php if($user->blog == 1) {echo"checked";} ?>>
                                    <span>Blog</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="report" value="1" <?php if($user->report == 1) {echo"checked";} ?>>
                                    <span>Report</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="return" value="1" <?php if($user->return == 1) {echo"checked";} ?>>
                                    <span>Return</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="stock" value="1" <?php if($user->stock == 1) {echo"checked";} ?>>
                                    <span>Stock</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="contact" value="1" <?php if($user->contact == 1) {echo"checked";} ?>>
                                    <span>Contact</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="comment" value="1" <?php if($user->comment == 1) {echo"checked";} ?>>
                                    <span>Comment</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="setting" value="1" <?php if($user->setting == 1) {echo"checked";} ?>>
                                    <span>Setting</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="role" value="1" <?php if($user->role == 1) {echo"checked";} ?>>
                                    <span>Role</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="other" value="1" <?php if($user->other == 1) {echo"checked";} ?>>
                                    <span>Other</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <hr>
                    <br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Update</button>
                    </div><!-- form-layout-footer -->
                </form>
            </div><!-- form-layout -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->
    @include('admin.footer')
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection