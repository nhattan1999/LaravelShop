@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      All categories product
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-8">
      </div>

      <div class="col-sm-4">
        <form action="{{URL::to('/search-product')}}" method="post">
          {{csrf_field()}}
          <div class="input-group">
            <input type="text" name="search_keyword" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <input class="btn btn-sm btn-default" type="submit" value="Search!">
            </span>
          </div>
        </form>
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

            <th>Product name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Image</th>
            <th>Status</th>
            <th style="width:30px;">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($all_products as $key => $product)

          <tr>
          
            <td>{{$product->product_name}}</td>
            <td>{{$product->category_name}}</td>
            <td>{{$product->product_price}}</td>
            <td><img src="public/upload/product/{{$product->product_image}}" height="90" width="90"></td>
            <td><span class="text-ellipsis">
              <?php
                if ($product->product_status == 0) {
                  echo "Hidden";
                }else {
                  echo "Present";
                }
               ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Are you sure to delete this?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" class="active" ui-toggle-class="">  <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <input type="file" name="file" accept=".xlsx"><br>
        <input type="submit" value="Import excel" name="import_csv" class="btn btn-warning">
      </form>
      <form action="{{url('export-csv')}}" method="POST">
          @csrf
       <input type="submit" value="Export excel" name="export_csv" class="btn btn-success">
      </form>

    </div>
    </footer>
  </div>
</div>
@endsection
