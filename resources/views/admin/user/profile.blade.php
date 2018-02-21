@extends('layouts.admin.main')
@section('headerTitle', 'Update User #' . $model->id)
@section('pageTitle', 'Update User #' . $model->id)
@section('content')


    {!! Form::model($model, [
            'method' => 'POST',
            'url' => ['/admin/user/profile'],
            'files' => true,
            'id' => 'formValidate',
        ]) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        
                        <div class="mrg-btm-20">
                            <a href="{{ route('admin') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        </div>
                        
                        @include ('admin.user.form-profile', ['submitButtonText' => 'Update'])
                    </div>
                </div>
            </div>
        </div>
        

	{!! Form::close() !!}
@endsection