@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      All categories product
    </div>
    <div class="row w3-res-tb">
      <!-- <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div> -->
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
            <th>Category product name</th>
            <th>Status</th>
            <th style="width:30px;">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($all_categories as $key => $cate_pro)
            {{csrf_field()}}
          <tr>

            <td>{{$cate_pro->category_name}}</td>
            <td><span class="text-ellipsis">
              <?php
                if ($cate_pro->category_status == 0) {
                  echo "Hidden";
                }else {
                  echo "Present";
                }
               ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Are you sure to delete this?')" href="{{URL::to('/delete-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="">  <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
