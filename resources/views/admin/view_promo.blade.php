@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      All promo
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-8">
      </div>

      <div class="col-sm-4">
        <!-- <form action="{{URL::to('/search-promo')}}" method="post">
          {{csrf_field()}}
          <div class="input-group">
            <input type="text" name="search_keyword" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <input class="btn btn-sm btn-default" type="submit" value="Search!">
            </span>
          </div>
        </form> -->
      </div>
    </div>
    <div class="table-responsive">
      <?php
        $msg = Session::get('msg');
        if($msg) {
          echo $msg;
          Session::put('msg', null);
        }
       ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Promo name</th>
            <th>Image</th>
            <th>Status</th>
            <th style="width:30px;">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($all_promos as $key => $promo)

          <tr>

            <td>{{$promo->promo_name}}</td>
            <td><img src="storage/upload/promo/{{$promo->promo_image}}" height="90" width="90"></td>
            <td><span class="text-ellipsis">
              <?php
                if ($promo->promo_status == 0) {
                  echo "Hidden";
                }else {
                  echo "Present";
                }
               ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-promo/'.$promo->promo_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Are you sure to delete this?')" href="{{URL::to('/delete-promo/'.$promo->promo_id)}}" class="active" ui-toggle-class="">  <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
    </footer>
  </div>
</div>
@endsection
