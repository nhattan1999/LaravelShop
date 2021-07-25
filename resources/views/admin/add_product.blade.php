@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add product
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="productName">Name</label>
                                    <input type="text" name="product_name" class="form-control" id="productName" placeholder="Enter product name" required minlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="productDesc">Description</label>
                                    <textarea style="resize: none" rows="6" name="product_desc" class="form-control" id="productDesc" placeholder="Enter description" required></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="productContent">Content</label>
                                    <textarea style="resize: none" rows="6" name="product_content" class="form-control" id="productContent" placeholder="Enter content" required></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="productPrice">Price</label>
                                    <input type="text" name="product_price" class="form-control" id="productPrice" placeholder="Enter price" required>
                                </div>
                                <div class="form-group">
                                    <label >Image</label>
                                    <input type="file" name="product_image" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label>Category</label>
                                  <select name="product_category"class="form-control input-sm m-bot15">
                                    @foreach ($cate_pro as $key => $cp)
                                      <option value="{{$cp->category_id}}">{{$cp->category_name}}</option>
                                    @endforeach


                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="product_status"class="form-control input-sm m-bot15">
                                      <option value="1">Present</option>
                                      <option value="0">Hidden</option>
                                  </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Add</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>


        </div>
@endsection
