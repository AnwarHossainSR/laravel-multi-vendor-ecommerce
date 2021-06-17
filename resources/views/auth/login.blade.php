@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="container d-flex align-items-center">
      <div class="form-holder has-shadow">
        <div class="row">
          <!-- Logo & Information Panel-->
          <div class="col-lg-6">
            <div class="info d-flex align-items-center">
              <div class="content">
                <div class="logo">
                  <h1>Dashboard</h1>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>
          <!-- Form Panel    -->
          <div class="col-lg-6 bg-white">
            <div class="form d-flex align-items-center">
                @include('frontend.layouts.notification')
              <div class="content">
                <form method="POST" action="{{ route('login') }}" class="form-validate">
                    @csrf
                  <div class="form-group">
                    <input id="email" type="email" required data-msg="Please enter your email" class="input-material" name="email" value="{{ old('email') }}">
                    <label for="email" class="label-material">User Email</label>
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                    <label for="password" class="label-material">Password</label>
                    @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div><button id="login" class="btn btn-primary">Login</button>
                  <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                </form><a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="{{ route('register') }}" class="signup">Signup</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyrights text-center">
       <p class="text-dark">2018 &copy; Developed by <span class="text-danger">Anwar Hossain</span></p>
    </div>
  </div>
@endsection
