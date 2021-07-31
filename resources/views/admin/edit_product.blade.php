@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update product
                        </header>
                        <div class="panel-body">

                            <div class="position-center">
                              <?php
                                $msg = Session::get('msg');
                                if($msg) {
                                  echo $msg;
                                  Session::put('msg', null);
                                }
                               ?>
                                <form role="form" action="{{URL::to('/update-product/'.$edit_product->product_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="productName">Name</label>
                                    <input type="text" minlength="5" name="product_name" class="form-control" id="productName" value="{{$edit_product->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="productDesc">Description</label>
                                    <textarea style="resize: none" rows="6" name="product_desc" class="form-control" id="productDesc">{{$edit_product->product_desc}}</textarea>

                                </div>
                                <div class="form-group">
                                    <label for="productContent">Content</label>
                                    <textarea style="resize: none" rows="6" name="product_content" class="form-control" id="productContent" >{{$edit_product->product_content}}</textarea>

                                </div>
                                <div class="form-group">
                                    <label for="productPrice">Price</label>
                                    <input type="text" name="product_price" class="form-control" id="productPrice" value="{{$edit_product->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label >Image</label>
                                    <input type="file" name="product_image" class="form-control">
                                    <img src="{{URL::to('storage/upload/product/'.$edit_product->product_image)}}" height="90" width="90">
                                </div>
                                <div class="form-group">
                                  <label>Category</label>
                                  <select name="product_category"class="form-control input-sm m-bot15">
                                    @foreach ($cate_pro as $key => $cp)
                                      @if($edit_product->category_id == $cp->category_id)
                                        <option value="{{$cp->category_id}}" selected>{{$cp->category_name}}</option>
                                      @else
                                        <option value="{{$cp->category_id}}">{{$cp->category_name}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="product_status"class="form-control input-sm m-bot15">
                                    @if($edit_product->product_status == 1)
                                      <option value="1" selected>Present</option>
                                      <option value="0">Hidden</option>
                                    @else
                                      <option value="1" >Present</option>
                                      <option value="0" selected>Hidden</option>
                                    @endif
                                  </select>
                                </div>
                                <button type="submit" name="update_product" class="btn btn-info">Update</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>


        </div>
@endsection
