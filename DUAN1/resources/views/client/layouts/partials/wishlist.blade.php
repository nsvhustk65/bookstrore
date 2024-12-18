@extends('client.layouts.master')
@section('content')
	<!-- breadcrumbs-area-start -->
	<div class="breadcrumbs-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs-menu">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#" class="active">wishlist</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- breadcrumbs-area-end -->
	<!-- entry-header-area-start -->
	<div class="entry-header-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="entry-header-title">
						<h2>Wishlist</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- entry-header-area-end -->
	<!-- cart-main-area-start -->
	<div class="cart-main-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="wishlist-content">
						<form action="#">
							<div class="wishlist-table table-responsive">
								<table>
									<thead>
										<tr>
											<th class="product-remove">
												<span class="nobr">Remove</span>
											</th>
											<th class="product-thumbnail">Image</th>
											<th class="product-name">Product Name</th>
											<th class="product-price">Unit Price </th>
											<th class="product-stock-stauts">Stock Status </th>
											<th class="product-subtotal">Add To Cart </th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="product-remove"><a href="#">×</a></td>
											<td class="product-thumbnail"><a href="#"><img src="img/cart/1.jpg" alt="man" /></a></td>
											<td class="product-name"><a href="#">Vestibulum suscipit</a></td>
											<td class="product-price"><span class="amount">£165.00</span></td>
											<td class="product-stock-status"><span class="wishlist-in-stock">In Stock</span></td>
											<td class="product-add-to-cart"><a href="#"> Add to Cart</a></td>
										</tr>
										<tr>
											<td class="product-remove"><a href="#">×</a></td>
											<td class="product-thumbnail"><a href="#"><img src="img/cart/2.jpg" alt="man" /></a></td>
											<td class="product-name"><a href="#">Vestibulum dictum magna</a></td>
											<td class="product-price"><span class="amount">£50.00</span></td>
											<td class="product-stock-status"><span class="wishlist-in-stock">In Stock</span></td>
											<td class="product-add-to-cart"><a href="#"> Add to Cart</a></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="6">
												<div class="wishlist-share">
													<h4 class="wishlist-share-title">Share on:</h4>
													<ul>
														<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
														<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
														<li><a class="pinterest" href="#"><i class="fa fa-dribbble"></i></a></li>
														<li><a class="googleplus" href="#"><i class="fa fa-google-plus"></i></a></li>
														<li><a class="email" href="#"><i class="fa fa-instagram"></i></a></li>
													</ul>
												</div>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- cart-main-area-end -->
@endsection
