@extends('layouts.inapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: black;    margin-top: 40px;">

                        <div style="    padding: 0px 58px;">
                            
                            <!-- <div class="col-md-7"> -->

                                <div style="margin: 35px 0px;">

                                    <div style="text-align: center;">
                                        <h2 style="font-family: 'News Cycle', sans-serif;font-weight: 700;margin-bottom: 25px;">Log in with instagram</h2>
                                        <p style="font-size: 17px;color: #cecece;">A simple way to show your Twitter crypto partnerships to investors.</p>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                      <label for="login-form-email">Email</label>
                                      <input  type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" required autofocus id="login-form-email" placeholder="your@email.com">

                                      @if ($errors->has('password'))
                                        <span style="color:white;" class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                      @endif

                                    </div>

                                    <div class="form-group">
                                      <label for="login-form-password">Password</label>
                                      <input  type="password" id="login-form-password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                      @if ($errors->has('password'))
                                            <span style="color:white;" class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                      <a href="{{ route('password.request') }}" class="form-help">
                                        Forgot password?
                                      </a>
                                    </div>
                                    <div class="form-group">
                                      <button class="btn btn-dark w-100 form-button" type="submit">Login</button>
                                    </div>

                                    <div class="form-group" style="text-align: center;">
                                      <h6>Or</h6>
                                    </div>
                                   
                                    <div class="form-group">
                                      <a class="btn btn-primary w-100" href="/register/instagram" role="button">Sign in</a>
                                    </div>
                                  </form>


                                </div>
                                
                         
                            <!-- </div> -->
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
