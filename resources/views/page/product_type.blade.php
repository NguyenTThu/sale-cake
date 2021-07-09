@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					
					<div class="col-sm-9">
					<div class="beta-products-list">
				
					
					<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{count($sp_theoloai)}} sản phẩm mới:</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach($sp_theoloai as $sptl)
							<div class="col-sm-4">
								<div class="single-item">
									@if($sptl->promotion_price!=0)
									<div class="ribbon-wrapper">
										<div class="ribbon sale">Sale</div>
									</div>
									@endif
									<div class="single-item-header">
										<a href="product.html"><img src="image/product/{{$sptl->image}}" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$sptl->name}}</p>
										<p class="single-item-price">

											@if($sptl->promotion_price==0)


											<span class="flash-sale">{{$sptl->unit_price}} đồng</span>

										</p>
										@else
										<p class="single-item-price">

											<span class="flash-del">{{$sptl->unit_price}} đồng</span>
											<span class="flash-sale">{{$sptl->promotion_price}} đồng</span>
										</p>

										@endif

									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{ url('add-to-cart/'.$sptl->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{ url('product/'.$sptl->id) }}">Details <i class="fa fa-chevron-right"></i></a>
										<a class="product-wish" ><i class="fa fa-heart fill-heart"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>

							@endforeach
							
							<div class="d-felx justify-content-center">

								{{ $sp_theoloai->links() }}

							</div>
						

					
					</div> <!-- #content -->
				</div> <!-- .container -->
				<div class="space50">&nbsp;</div> 
					
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection