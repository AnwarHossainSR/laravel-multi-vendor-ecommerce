@extends('frontend.layouts.master')
@section('title','E-SHOP || ERROR')
@section('main-content')
<!-- Error Page -->
<section class="error-page">
    <div class="table">
        <div class="table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-12">
                        <!-- Error Inner -->
                        <div class="error-inner">
                            <h2>404</h2>
                            <h5>This page cannot be founded</h5>
                            <p>Oops! The page you are looking for does not exist. It might have been moved or deleted.</p>
                            <div class="button">
                                <a href="{{ route('home') }}" class="btn">Go Homepage</a>
                            </div>
                        </div>
                        <!--/ End Error Inner -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Error Page -->
@endsection
