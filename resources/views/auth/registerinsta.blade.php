@extends('layouts.inapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: black;    margin-top: 40px;">

                        <div style="    padding: 0px 58px;">
                            
                             <div class="mb-50">
                                <h3 style="font-family: 'News Cycle', sans-serif;font-weight: 700;margin-bottom: 25px;">Sign in with instagram</h3>
                              </div>

                         
                              <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                  <label for="signup-form-name">Write your instagram username</label>
                                  <input style="background: #1d1d1d;border: 1px solid #2b2b2b;" type="text" id="signup-form-name" placeholder="alexsmith" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                  @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                  <label for="signup-form-email">Email</label>
                                  <input style="background: #1d1d1d;border: 1px solid #2b2b2b;" type="email"  id="signup-form-email" placeholder="your@email.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                  @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                  <label for="signup-form-password">Create a creworth password</label>
                                  <input style="background: #1d1d1d;border: 1px solid #2b2b2b;" type="password"  id="signup-form-password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                  @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                  <label for="signup-form-password">Confirm your creworth password</label>
                                  <input style="background: #1d1d1d;border: 1px solid #2b2b2b;" type="password" class="form-control" id="signup-form-password" placeholder="password" name="password_confirmation" required autocomplete="new-password">
                                </div>


                                <div class="form-group">
                                  <button class="btn btn-primary w-100 form-button" style="background-color: white;border:1px solid white;color:black;" type="submit">Get Started</button>
                                </div>
                              </form>
                                
                         
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection