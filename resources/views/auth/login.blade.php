@extends('layouts.admin.main-login')

@section('headerTitle', 'Login Credentials')

@section('content')
<div class="container-fluid no-pdd-horizon bg" style="background-image: url('admin-assets/images/others/img-30.jpg')">
    <div class="row">
        <div class="col-md-10 mr-auto ml-auto">
            <div class="row">
                <div class="mr-auto ml-auto full-height height-100">
                    <div class="vertical-align full-height">
                        <div class="table-cell">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pdd-horizon-30 pdd-vertical-30">
                                        <div class="mrg-btm-30">
                                            <h2 class="inline-block pull-left no-mrg-vertical pdd-top-15">{{ config('app.name') }}</h2>
                                            <h2 class="inline-block pull-right no-mrg-vertical pdd-top-15">Login</h2>
                                            <br/>
                                            <br/>
                                            <br/>
                                        </div>
                                        <p class="mrg-btm-15 font-size-13">Please enter your user name and password to login</p>
                                        <form class="ng-pristine ng-valid form-horizontal" method="POST" action="{{ route('login') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <input type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="checkbox font-size-13 inline-block no-mrg-vertical no-pdd-vertical">
                                                <input id="agreement" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="agreement">Keep Me Signed In</label>
                                            </div>
                                            <div class="pull-right">
                                                <a href="{{ route('password.request') }}">
                                                    Forgot Your Password?
                                                </a>
                                            </div>
                                            <div class="mrg-top-20 text-right">
                                                <button class="btn btn-info btn-rounded">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
