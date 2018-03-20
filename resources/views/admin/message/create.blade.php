@extends('layouts.admin.main')
@section('headerTitle', 'Create New Message ')
@section('pageTitle', 'Create New Message ')
@section('content')

{!! Form::open(['url' => route('message.index'), 'id' => 'formValidate', 'files' => true]) !!}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">

                <div class="mrg-btm-20">
                    <a href="{{ route('message.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                </div>

                @include ('admin.message.form')
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection