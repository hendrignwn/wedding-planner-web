@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('category') ? 'has-error' : ''}}">
    {!! Form::label('category', 'Category') !!}
    {!! Form::text('category', null, ['class' => 'form-control', 'placeholder'=>'eg: Photography, Bridal']) !!}
    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
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

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Address') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group input-group required form-group-default {{ $errors->has('phone') ? 'has-error' : ''}}">
    <span class="input-group-text"><i class="fa fa-phone-square"></i></span>
    {!! Form::text('phone', null, ['class' => 'form-control m-b', 'placeholder'=>'021 9998 777']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group input-group required form-group-default {{ $errors->has('website') ? 'has-error' : ''}}">
    <span class="input-group-text"><i class="fa fa-globe"></i>&nbsp;&nbsp;http://www.</span>
    {!! Form::text('website', null, ['class' => 'form-control m-b', 'placeholder'=>'website.com']) !!}
    {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group input-group required form-group-default {{ $errors->has('instagram') ? 'has-error' : ''}}">
    <span class="input-group-text"><i class="fa fa-instagram"></i>&nbsp;&nbsp;instagram.com/</span>
    {!! Form::text('instagram', null, ['class' => 'form-control m-b', 'placeholder'=>'agendanikah']) !!}
    {!! $errors->first('instagram', '<p class="help-block">:message</p>') !!}
</div>


<div aria-required="true" class="form-group required form-group-default form-group-default-select2 {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', \App\Vendor::statusLabels(), null, ['class' => 'select2 full-width', 'data-init-plugin' => 'select2']) !!}
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