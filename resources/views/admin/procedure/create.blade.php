@extends('layouts.admin.main')
@section('headerTitle', 'Create Procedure')
@section('pageTitle', 'Create Procedure')
@section('content')


    {!! Form::open(['url' => route('procedure.index'), 'id' => 'formValidate', 'files' => true]) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        
                        <div class="mrg-btm-20">
                            <a href="{{ route('procedure.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        </div>
                        
                        @include ('admin.procedure.form')
                    </div>
                </div>
            </div>
        </div>

	{!! Form::close() !!}
@endsection