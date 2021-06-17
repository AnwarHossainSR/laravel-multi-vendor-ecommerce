@extends('frontend.layouts.master')

@section('title','E-SHOP || DASHBOARD')

@section('main-content')
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="{{ route('customer') }}">Dashboard</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!-- Product Style -->
		<section class="product-area shop-sidebar shop section">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4 col-12">
						<div class="shop-sidebar">
								@include('frontend.user.layout.sidebar')
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top">
									<div class="shop-shorter">
										<div class="single-shorter">
                                            Hello {{ Auth::user()->full_name }}
									</div>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Product Style 1  -->
@endsection
@push('styles')
    <style>
        ul h5 a:hover{
            text-align: center;
            color:#F7941D;
        }
    </style>
@endpush
