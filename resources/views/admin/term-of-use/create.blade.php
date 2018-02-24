@extends('layouts.admin.main')
@section('headerTitle', 'Create User')
@section('pageTitle', 'Create User')
@section('content')


    {!! Form::open(['url' => route('user.index'), 'id' => 'formValidate', 'files' => true]) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        
                        <div class="mrg-btm-20">
                            <a href="{{ route('user.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        </div>
                        
                        @include ('admin.user.form')
                    </div>
                </div>
            </div>
        </div>

	{!! Form::close() !!}
@endsection