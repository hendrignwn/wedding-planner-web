@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('wedding_day') ? 'has-error' : ''}}">
    {!! Form::label('wedding_day', 'Wedding Day') !!}
    {!! Form::text('wedding_day', null, ['class' => 'form-control datepicker']) !!}
    {!! $errors->first('wedding_day', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('venue') ? 'has-error' : ''}}">
    {!! Form::label('venue', 'Venue') !!}
    {!! Form::text('venue', null, ['class' => 'form-control']) !!}
    {!! $errors->first('venue', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>

@push('script')
<script>
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
});
</script>
@endpush