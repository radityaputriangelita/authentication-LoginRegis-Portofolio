@extends('auth.layouts')

@section('content')

<!-- Section: Design Block -->
<div class="container-regist">
<section class="text-center-regist">

<div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: 30px;width:60%; background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
  <div class="card-body py-5 px-md-5">

    <div class="row d-flex justify-content-center">
      <div class="col-lg-8">


        <h2 class="fw-bold mb-5">Sign up now</h2>
        <form class="regis-form" action="{{ route('store') }}" method="post">
          @csrf
          <!-- Name input -->
          <div class="form-outline mb-4">
            <div class="form-name">
              <label class="form-label" for="form3Example1">Name</label>
            </div>
            <div class="col form-input">
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
              @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
            </div>
          </div>
          <!-- Email input -->
          <div class="form-outline mb-4 form-input">
            <div class="form-name">
              <label class="form-label" for="form3Example3">Email address</label>
            </div>
            <div class="col form-input">
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
              @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4 form-input">
            <div class="form-name">
              <label class="form-label" for="form3Example4">Password</label>
            </div>
            <div class="col form-input">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
              @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
          </div>

          <!-- password confirm -->

          <div class="form-outline mb-4 form-input">
            <div class="form-name">
              <label class="form-label"  for="password_confirmation" >Confirm Password</label>
            </div>
            <div class="col form-input">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
          </div>

          <!-- Submit button -->
          <div class="mb-3 row" style="justify-content: center;">
            <input type="submit" class="col-md-4 btn btn-primary btn-regist" value="Register">
          </div>
          <!-- href login -->
          <div class="href-login" style="display:flex;">
            <p style="color: #393f81;">Already have an account?<a href="{{route('login')}}" style="color: #393f81; font-size:12px">Sign In</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
</section>
<!-- Section: Design Block -->
</div>

@endsection
