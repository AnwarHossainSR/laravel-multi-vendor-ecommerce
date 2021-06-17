@extends('frontend.layouts.master')

@section('title','E-SHOP || ACCOUNT')

@section('main-content')
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="{{ route('user.account') }}">Account</a></li>
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
                                    @include('frontend.layouts.notification')
                                    <p class="text-center">Account Details</p>
									<!-- Shop Login -->
                                <section class="shop login section">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="login-form">

                                                    <!-- Form -->
                                                    <form class="form" method="POST" action="{{ route('user.account.update') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>First Name<span>*</span></label>
                                                                    <input type="text" name="full_name" id="full_name" value="{{ Auth::user()->full_name }}"  required="required">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Display Name<span>*</span></label>
                                                                    <input type="text" name="username" id="username" value="{{ Auth::user()->username }}" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Your Email<span>*</span></label>
                                                                    <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Phone No<span>*</span></label>
                                                                    <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}" >
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Current Password(if change)<span>*</span></label>
                                                                    <input type="password" name="cpassword" id="cpassword" >
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>New Password(if change)<span>*</span></label>
                                                                    <input type="password" name="password" id="password">
                                                                </div>
                                                            </div>


                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <span class="input-group-btn">
                                                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-danger text-light">
                                                                        <i class="fa fa-picture-o"></i> Choose
                                                                      </a>
                                                                    </span>
                                                                    <input id="thumbnail" class="form-control" type="text" value="{{ Auth::user()->photo }}" id="photo" name="photo" value="{{ old('photo') }}">
                                                                    @error('photo')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                  </div>
                                                                  {{-- <div id="holder" style="margin-top:15px;height:300px;width:300px"> --}}

                                                                </div>
                                                            </div>



                                                            <div class="col-12">
                                                                <div class="form-group login-btn">
                                                                    <button class="btn" type="submit">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!--/ End Form -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!--/ End Login -->
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
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function() {
            $('#lfm').filemanager('image');
        })
    </script>
@endpush
