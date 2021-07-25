@extends('welcome')
@section('content')
  <div class="features_items"><!--features_items-->
    <h2 class="title text-center">New Items</h2>
      @foreach ($product as $key => $p)
        <a href="{{URL::to('product-detail/'.$p->product_id)}}">
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                  <img src="{{URL::to('public/upload/product/'.$p->product_image)}}" alt="" width="100" height="150" />
                  <h2><i class="fa fa-usd"></i>{{number_format($p->product_price)}}</h2>
                  <p>{{$p->product_name}}</p>
                  <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <!-- <div class="product-overlay">
                  <div class="overlay-content">
                    <h2><i class="fa fa-usd"></i>{{number_format($p->product_price)}}</h2>
                    <p>{{$p->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                  </div>
                </div> -->
            </div>
            <div class="choose">
              <ul class="nav nav-pills nav-justified">
                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
              </ul>
            </div>
          </div>

        </div>
        </a>
      @endforeach
  </div><!--features_items-->

  
@endsection
