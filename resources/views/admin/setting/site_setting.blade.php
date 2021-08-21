@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Website Setting</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Site Setting</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <div class="sl-page-title">
                <h5>
                    Site Setting Form
                </h5>
                
            </div><!-- sl-page-title -->
            <div class="form-layout">
                <form action="{{route('update.site.setting')}}" method="post" >
                    @csrf
                    <input type="hidden" name="id" value="{{$setting->id}}">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Company Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="company_name" value="{{$setting->company_name}}"
                                    placeholder="Enter Company Name" required>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Company Address: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="company_address" value="{{$setting->company_address}}"
                                    placeholder="Enter Company Address" required>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{$setting->email}}"
                                    placeholder="Enter Email" required>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone One: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_one" value="{{$setting->phone_one}}"
                                    placeholder="Enter Phone Number" >
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone Two: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_two" value="{{$setting->phone_two}}"
                                    placeholder="Enter Phone Number" >
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Facebook: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="facebook" value="{{$setting->facebook}}"
                                    placeholder="Enter Facebook Link" >
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Youtube: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="youtube" value="{{$setting->youtube}}"
                                    placeholder="Enter Youtube Link" >
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Instagram: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="instagram" value="{{$setting->instagram}}"
                                    placeholder="Enter Instagram Link" >
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Twitter: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="twitter" value="{{$setting->twitter}}"
                                    placeholder="Enter Twitter Link" >
                            </div>
                        </div><!-- col-6 -->

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