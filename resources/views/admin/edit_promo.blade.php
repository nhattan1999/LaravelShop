@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update promo
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
                                <form role="form" action="{{URL::to('/update-promo/'.$edit_promo->promo_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="promoName">Name</label>
                                    <input type="text" minlength="5" name="promo_name" class="form-control" id="promoName" value="{{$edit_promo->promo_name}}">
                                </div>
                                <div class="form-group">
                                    <label >Image</label>
                                    <input type="file" name="promo_image" class="form-control">
                                    <img src="{{URL::to('storage/upload/promo/'.$edit_promo->promo_image)}}" height="90" width="90">
                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="promo_status"class="form-control input-sm m-bot15">
                                    @if($edit_promo->promo_status == 1)
                                      <option value="1" selected>Present</option>
                                      <option value="0">Hidden</option>
                                    @else
                                      <option value="1" >Present</option>
                                      <option value="0" selected>Hidden</option>
                                    @endif
                                  </select>
                                </div>
                                <button type="submit" name="update_promo" class="btn btn-info">Update</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>


        </div>
@endsection
