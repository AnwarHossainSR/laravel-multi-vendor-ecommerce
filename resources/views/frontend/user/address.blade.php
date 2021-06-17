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
								<li class="active"><a href="{{ route('user.address') }}">Dashboard</a></li>
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
					<div class="col-lg-9 col-md-12 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top">
                                    @include('frontend.layouts.notification')
									<p>The following address will be used in checkout page by default</p>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h5 class="my-2">Billing Address</h5>
                                            <div>
                                                @if (Auth::user()->userAddress && Auth::user()->userAddress->address)
                                                <p>{{ Auth::user()->name }}</p>
                                                <p>{{ Auth::user()->userAddress->address }}</p>
                                                <p>{{ Auth::user()->userAddress->city }}</p>
                                                <p>{{ Auth::user()->userAddress->country }}</p>
                                                @else
                                                <p>you have not set up this address yet</p>
                                                @endif

                                               <button type="button" class="mt-3 btn btn-primary" data-toggle="modal" data-target="#billingAddress">
                                                Edit Address
                                              </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="my-2">Shipping Address</h5>
                                            <div>
                                                @if (Auth::user()->userAddress && Auth::user()->userAddress->saddress)
                                                <p>{{ Auth::user()->name }}</p>
                                                <p>{{ Auth::user()->userAddress->saddress }}</p>
                                                <p>{{ Auth::user()->userAddress->scity }}</p>
                                                <p>{{ Auth::user()->userAddress->scountry }}</p>
                                                @else
                                                    <p>you have not set up this address yet</p>
                                                @endif

                                                <button type="button" class="mt-3 btn btn-primary" data-toggle="modal" data-target="#shippingAddress">
                                                  Edit Address
                                                </button>
                                            </div>
                                        </div>
                                    </div>

								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
					</div>
				</div>
			    </div>
            </div>
		</section>
		<!--/ End Product Style 1  -->

        <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="billingAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 35%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-5">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('user.address.billing') }}">
                                        @csrf
                                        <div class="form-group">
                                          <label for="address">Address</label>
                                          <textarea name="address" id="address" cols="30" rows="3">{{ Auth::user()->userAddress ? Auth::user()->userAddress->address : '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                          <label for="country">Country</label>
                                          <input type="text" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->country : '' }}" name="country" class="form-control" id="country" placeholder="COuntry">
                                        </div>
                                        <div class="form-check">
                                          <label for="postcode">Postcode</label>
                                          <input type="text" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->postcode : '' }}" name="postcode" class="form-control" id="postcode">
                                        </div>
                                        <div class="form-check">
                                          <label for="state">State</label>
                                          <input type="text" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->state : '' }}" name="state" class="form-control" id="state">
                                        </div>
                                        <div class="form-check">
                                          <label for="city">City</label>
                                          <input type="text" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->city : ''}}" name="city" class="form-control" id="city">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  {{-- Shipping modal --}}
  <!-- Modal -->
  <div class="modal fade" id="shippingAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 35%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-5">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('user.address.shipping') }}">
                                        @csrf
                                        <div class="form-group">
                                          <label for="address">Shipping Address</label>
                                          <textarea name="address" id="address" cols="30" rows="3">{{ Auth::user()->userAddress ? Auth::user()->userAddress->saddress : '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                          <label for="country">Shipping Country</label>
                                          <input type="text" name="country" class="form-control" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->scountry : '' }}" id="country" placeholder="Country">
                                        </div>
                                        <div class="form-check">
                                          <label for="postcode">Shipping Postcode</label>
                                          <input type="text" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->spostcode : '' }}" name="postcode" class="form-control" id="postcode">
                                        </div>
                                        <div class="form-check">
                                          <label for="state">Shipping State</label>
                                          <input type="text" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->sstate : '' }}" name="state" class="form-control" id="state">
                                        </div>
                                        <div class="form-check">
                                          <label for="city">Shipping City</label>
                                          <input type="text" value="{{ Auth::user()->userAddress ? Auth::user()->userAddress->scity : '' }}" name="city" class="form-control" id="city">
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection

