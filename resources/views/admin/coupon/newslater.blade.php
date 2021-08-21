@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.home')}}">Home</a>
        <span class="breadcrumb-item">Newslaters</span>
        <!-- <span class="breadcrumb-item active">Category List</span>  -->
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Subcriber List</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <form  method="post">
                @csrf  
                @method('DELETE')          
            <h6 class="card-body-title">Subcriber List
                <button formaction="{{route('deleteall')}}" type="submit" class="btn btn-sm btn-warning" style="float:right;">Delete All</button>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Email</th>
                            <th class="wd-15p">Subcribing Time</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($newslaters as $key=>$newslater)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" value="{{$newslater->id}}">
                                {{$key + 1}}
                            </td>
                            <td>{{$newslater->email}}</td>
                            <td>{{Carbon\Carbon::parse($newslater->created_at)->diffForHumans()}}</td>
                            <td>
                                <a href="{{URL::to('delete/newslater/'.$newslater->id)}}" class="btn btn-sm btn-danger"
                                    id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
            </form>
        </div><!-- card -->
    </div><!-- sl-pagebody -->
    @include('admin.footer')
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection