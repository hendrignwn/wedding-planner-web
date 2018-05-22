@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('file') ? 'has-error' : ''}}">
    {!! Form::label('file', 'Image') !!}
    @if(isset($model))
    <br/>
    <div style="width:50%">
        {!! $model->getFileImg() !!}
    </div>
    @endif
    {!! Form::file('file', ['class' => 'form-control']) !!}
    {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('thumbnail_file') ? 'has-error' : ''}}">
    {!! Form::label('thumbnail_file', 'Image Thumbnail') !!}
    @if(isset($model))
        <br/>
        {!! $model->getFileThumbImg() !!}
    @endif
    {!! Form::file('thumbnail_file', ['class' => 'form-control']) !!}
    {!! $errors->first('thumbnail_file', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default form-group-default-select2 {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', \App\VendorDetail::statusLabels(), null, ['class' => 'select2 full-width', 'data-init-plugin' => 'select2']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('order') ? 'has-error' : ''}}">
    {!! Form::label('order', 'Order') !!}
    {!! Form::text('order', null, ['class' => 'form-control']) !!}
    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>

@push('script')
<script>
$('.select2').selectize({
    sortField: 'text'
});    
</script>
@endpush