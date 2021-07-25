@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add category product
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="categoryProductName">Name</label>
                                    <input type="text" minlength = "5" name="category_name" class="form-control" id="categoryProductName" placeholder="Enter category name" required>
                                </div>
                                <div class="form-group">
                                    <label for="categoryProductDesc">Description</label>
                                    <textarea style="resize: none" rows="6" name="category_desc" class="form-control" id="categoryProductDesc" placeholder="Enter description" required></textarea>

                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="category_status"class="form-control input-sm m-bot15">
                                      <option value="1">Present</option>
                                      <option value="0">Hidden</option>
                                  </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Add</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>


        </div>
@endsection
