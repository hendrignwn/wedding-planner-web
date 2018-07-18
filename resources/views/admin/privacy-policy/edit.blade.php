@extends('layouts.admin.main')
@section('headerTitle', 'Update Privacy Policy #' . $model->id)
@section('pageTitle', 'Update Privacy Policy #' . $model->id)
@section('content')


    {!! Form::model($model, [
            'method' => 'PATCH',
            'url' => ['/admin/privacy-policy', $model->id],
            'files' => true,
            'id' => 'formValidate',
        ]) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        
                        @include ('admin.privacy-policy.form', ['submitButtonText' => 'Update'])
                    </div>
                </div>
            </div>
        </div>
        

	{!! Form::close() !!}
@endsection