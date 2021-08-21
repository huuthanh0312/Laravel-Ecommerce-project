@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_responsive.css
')}}">
@section('content')
@include('layouts.menubar')

<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Your Wishlist Product</div>
                    <div class="cart_items">
					@if(count($product) === 0)
						<br>
						<div class="alert alert-primary" role="alert">
							<h3>Please add wishlist to cart !!!</h3>
						</div>
						<div class="cart_buttons">
							<a href="{{url('/')}}" class="btn btn-outline-secondary btn-lg">All Cancel</a>
							
						</div>
						
						@else
						
                        <ul class="cart_list">
                            @foreach($product as $row)
                            <li class="cart_item clearfix">
                                <div class="cart_item_image text-center">
                                    <br>
                                    <img src="{{URL::to($row->image_one)}}" alt="" style="width:80px; height:80px;">
                                </div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title">Name</div>
                                        <div class="cart_item_text">{{$row->product_name}}</div>
                                    </div>
                                    @if($row->product_color == null)
                                    @else
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Color</div>
                                        <div class="cart_item_text">{{$row->product_color}}</div>
                                    </div>
                                    @endif
                                    @if($row->product_size == null)
                                    @else
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Size</div>
                                        <div class="cart_item_text">{{$row->product_size}}</div>
                                    </div>
                                    @endif

                                    <div class="cart_item_total cart_info_col text-center">
                                        <div class="cart_item_title">Action</div>
                                        <div class="cart_item_text">

                                            <button class="btn btn-sm btn-primary" id="{{$row->id}}" data-toggle="modal"
                                                data-target="#cardmodal" onclick="productView(this.id)">Add
                                                to Cart</button>
                                            <a href="{{url('delete/wishlist/'.$row->id)}}" id="delete"
                                                class="btn btn-sm btn-danger">x</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
						<div class="cart_buttons">
							<a href="{{url('/')}}" class="btn btn-outline-secondary btn-lg">All Cancel</a>
						</div>
						@endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="cardmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="" alt="" id='pimage' style='width:150px; height:220px;'>
                                <br>
                                <br>
                                <div class="card-title" id="pname"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product Code: <span id="pcode"></span></li>
                                <br>
                                <li class="list-group-item">Category: <span id="pcat"></span></li>
                                <br>
                                <li class="list-group-item">Subcategory: <span id="psubcat"></span></li>
                                <br>
                                <li class="list-group-item">Brand: <span id="pbrand"></span></li>
                                <br>
                                <li class="list-group-item">Stock:  <span class="badge" style="background:green;">Available</span>
                                </li>
                            </ul>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                        <form action="{{route('insert.into.cart')}}" method="post" >
                                @csrf
                                <div class="card-body">
                                        <input type="hidden" name="product_id" id="product_id">
                                        <div class="form-group row">
                                            <label for="color" class="col-lg-5 mt-1">Color: </label>
                                            <select name="color" id="color" class="form-control col-lg-5">
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="size" class="col-lg-5 mt-1">Size: </label>
                                            <select name="size" id="size" class="form-control col-lg-5">

                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="qty" class=" col-lg-5 mt-1">Quantity: </label>
                                            <input type="number" class="form-control col-lg-5 ml-2" name="qty" value="1" id="qty" >
                                        </div>
                                        <br>
                                        <div class="form-group"> 
                                        <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                                        </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection