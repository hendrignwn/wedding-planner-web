@extends('layouts.web.main')
@section('headerTitle', 'Reset Password')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="ng-pristine ng-valid form-horizontal" method="POST" action="{{ url('reset-password') }}">
                        {{ csrf_field() }}
                        {!! Form::hidden('forgot_token', $user->forgot_token) !!}
                        <table class="table table-striped">
                            <tr>
                                <th align="center" colspan="3">Detail</th>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td width="60%">{!! $user->name !!}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{!! $user->email !!}</td>
                            </tr>
                            <tr>
                                <td>No Handphone</td>
                                <td>{!! $user->phone !!}</td>
                            </tr>
                            <tr>
                                <th align="center" colspan="3">Set Password Baru Anda</th>
                            </tr>
                            <tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-8 control-label">Password Baru</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                        <label for="confirm_password" class="col-md-8 control-label">Konfirmasi Password Baru</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>

                                            @if ($errors->has('confirm_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var IS_IPAD = navigator.userAgent.match(/iPad/i) != null,
        IS_IPHONE = !IS_IPAD && ((navigator.userAgent.match(/iPhone/i) != null) || (navigator.userAgent.match(/iPod/i) != null)),
        IS_IOS = IS_IPAD || IS_IPHONE,
        IS_ANDROID = !IS_IOS && navigator.userAgent.match(/android/i) != null,
        IS_MOBILE = IS_IOS || IS_ANDROID;

    function open() {
        // If it's not an universal app, use IS_IPAD or IS_IPHONE
        if (IS_IOS) {
            window.location = "{{ $iosUrlScheme }}";

            setTimeout(function() {

                // If the user is still here, open the App Store
                if (!document.webkitHidden) {
                    // Replace the Apple ID following '/id'
                    window.location = '{{ $webRealUrl }}';
                }
            }, 25);

        } else if (IS_ANDROID) {
            // Instead of using the actual URL scheme, use 'intent://' for better UX
            window.location = '{{ $androidUrlScheme }}';
        }
    }
    window.onload = open();
</script>
@endpush