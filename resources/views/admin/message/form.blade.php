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

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control summernote']) !!}
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

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('is_all_date') ? 'has-error' : ''}}">
    {!! Form::label('is_all_date', 'Is All Date') !!}
    <br/>
    {!! Form::checkbox('is_all_date', 1, null, ['class' => '']) !!}
    {!! $errors->first('is_all_date', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('active_date') ? 'has-error' : ''}}">
    {!! Form::label('active_date', 'Active Date') !!}
    {!! Form::text('active_date', null, ['class' => 'form-control active-range-date']) !!}
    {!! $errors->first('active_date', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('message_at') ? 'has-error' : ''}}">
    {!! Form::label('message_at', 'Publish Message Date') !!}
    {!! Form::text('message_at', null, ['class' => 'form-control datepicker']) !!}
    {!! $errors->first('message_at', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default form-group-default-select2 {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', \App\Vendor::statusLabels(), null, ['class' => 'select2 full-width', 'data-init-plugin' => 'select2']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>

@push('script')
<script>
$(".summernote").summernote({
    height: 200,
});
$('.select2').selectize({
    sortField: 'text'
});
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});
$('.active-range-date').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
    startDate: '{{ isset($submitButtonText) ? ($model->start_date == null ? \Carbon\Carbon::now()->toDateString() : $model->start_date) : \Carbon\Carbon::now()->toDateString() }}',
    endDate: '{{ isset($submitButtonText) ? ($model->end_date == null ? \Carbon\Carbon::now()->addDay()->toDateString() : $model->end_date) : \Carbon\Carbon::now()->addDay()->toDateString() }}',
});

$("input[name='is_all_date']").click(function() {
    isAllDateCreate();
});

@if(isset($submitButtonText))
    isAllDateUpdate();
@endif

function isAllDateUpdate() {
    if ($("input[name='is_all_date']").is(':checked') == true) {
        $("input[name='active_date']").val("{{ isset($submitButtonText) ? ($model->start_date == null ? '' : $model->start_date . ' -') : '' }}{{ isset($submitButtonText) ? ($model->end_date == null ? '' : $model->end_date) : '' }}");
        $("input[name='active_date']").attr("readonly", true);
    } else {
        $("input[name='active_date']").val("{{ isset($submitButtonText) ? ($model->start_date == null ? '' : $model->start_date . ' -') : '' }}{{ isset($submitButtonText) ? ($model->end_date == null ? '' : $model->end_date) : '' }}");
        $("input[name='active_date']").attr("readonly", false);
    }
}

function isAllDateCreate() {
    if ($("input[name='is_all_date']").is(':checked') == true) {
        $("input[name='active_date']").val("");
        $("input[name='active_date']").attr("readonly", true);
    } else {
        $("input[name='active_date']").val("");
        $("input[name='active_date']").attr("readonly", false);
    }
}

</script>
@endpush