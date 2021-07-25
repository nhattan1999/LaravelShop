@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit category product
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
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_category->category_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="categoryProductName">Name</label>
                                    <input type="text" minlength="5" name="category_name" value="{{$edit_category->category_name}}"class="form-control" id="categoryProductName" placeholder="Enter category name">
                                </div>
                                <div class="form-group">
                                    <label for="categoryProductDesc">Description</label>
                                    <textarea style="resize: none" rows="6" name="category_desc" class="form-control" id="categoryProductDesc" placeholder="Enter description">{{$edit_category->category_desc}}</textarea>

                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="category_status"class="form-control input-sm m-bot15">
                                      @if($edit_category->category_status == 1)
                                        <option value="1" selected>Present</option>
                                        <option value="0">Hidden</option>
                                      @else
                                      <option value="1" >Present</option>
                                      <option value="0" selected>Hidden</option>
                                      @endif
                                  </select>
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info">Updat</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>


        </div>
@endsection
