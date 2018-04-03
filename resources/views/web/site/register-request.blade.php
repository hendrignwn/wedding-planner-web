@extends('layouts.web.main')
@section('headerTitle', 'Permintaan Registrasi dari Pasangan')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Permintaan Registrasi dari Pasangan</div>

                <div class="panel-body">
                    <form class="ng-pristine ng-valid form-horizontal" method="POST" action="{{ url('register-relation') }}">
                        {{ csrf_field() }}
                        {!! Form::hidden('registered_token', $user->registered_token) !!}
                        <table class="table table-striped">
                            <tr>
                                <th align="center" colspan="3">Detail Pasangan</th>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td width="60%">{!! $relation->name !!}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{!! $relation->email !!}</td>
                            </tr>
                            <tr>
                                <td>No Handphone</td>
                                <td>{!! $relation->phone !!}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pernikahan</td>
                                <td>{!! \Carbon\Carbon::parse($relation->userRelation->wedding_day)->format('d M Y')!!}</td>
                            </tr>
                            <tr>
                                <td>Tempat Acara</td>
                                <td>{!! $relation->userRelation->venue !!}</td>
                            </tr>
                            <tr>
                                <th align="center" colspan="3">Isi Data Diri Anda</th>
                            </tr>
                            <tr>
                                <td>Email Anda</td>
                                <td>{!! $user->email !!}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-8 control-label">Nama Lengkap</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-8 control-label">No Handphone</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-8 control-label">Password</label>
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
                                        <label for="confirm_password" class="col-md-8 control-label">Konfirmasi Password</label>
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
                                                Register
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