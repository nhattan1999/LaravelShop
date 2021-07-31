@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add promo
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
                                <form role="form" action="{{URL::to('/save-promo')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="promoName">Name</label>
                                    <input type="text" name="promo_name" class="form-control" id="promoName" placeholder="Enter promo name" required minlength="5">
                                </div>

                                <div class="form-group">
                                    <label >Image</label>
                                    <input type="file" name="promo_image" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="promo_status"class="form-control input-sm m-bot15">
                                      <option value="1">Present</option>
                                      <option value="0">Hidden</option>
                                  </select>
                                </div>
                                <button type="submit" name="add_promo" class="btn btn-info">Add</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>


        </div>
@endsection
