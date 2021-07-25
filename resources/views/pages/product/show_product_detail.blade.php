@extends('welcome')
@section('content')
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('public/upload/product/'.$product_detail->product_image)}}" alt="" />
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="{{URL::to('public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{$product_detail->product_name}}</h2>
							  <form action="{{URL::to('/save-cart')}}" method="post">
									{{csrf_field()}}
									<span>
										<span>US ${{$product_detail->product_price}}</span>
										<label>Quantity:</label>
										<input name="quantity" type="number" min="1"/>
										<input name="productIdCart" type="hidden" value="{{$product_detail->product_id}}"/>
										<button type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
										</button>
									</span>
							  </form>
								<p><b>Description:</b> {{$product_detail->product_desc}}</p>
								@if ($product_detail->product_status == 1)
									<p><b>Availability:</b> In Stock</p>
								@else
									<p><b>Availability:</b> Out of Stock</p>
								@endif

								<p><b>Category:</b> {{$product_detail->category_name}}</p>
								<a href=""><img src="{{URL::to('public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Related products</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									@foreach ($related_product as $key => $relate)

										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{URL::to('public/upload/product/'.$relate->product_image)}}" alt="" width="50"  heihgt="50"/>
														<h2>{{$relate->product_price}}</h2>
														<p>{{$relate->product_name}}</p>
														<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													</div>
												</div>
											</div>
										</div>

									@endforeach

								</div>

							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>
						</div>
					</div><!--/recommended_items-->

@endsection
