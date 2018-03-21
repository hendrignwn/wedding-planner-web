@extends('layouts.admin.main')
@section('headerTitle', 'Message #' . $model->id)
@section('pageTitle', 'Message #' . $model->id)

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    
                    <div class="pull-left mrg-btm-20">
                        <a href="{{ route('message.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        <a href="{{ route('message.edit', ['id'=>$model->id]) }}" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Update</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $model->name }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {!! $model->description !!} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td> {!! $model->getFileImg() !!} </td>
                                </tr>
                                <tr>
                                    <th> Image Thumbnail </th>
                                    <td> {!! $model->getFileThumbImg() !!} </td>
                                </tr>
                                <tr>
                                    <th> Is All Date </th>
                                    <td> {!! $model->is_all_date == 1 ? 'True' : 'False' !!} </td>
                                </tr>
                                <tr>
                                    <th> Start Date</th>
                                    <td> {!! $model->start_date !!} </td>
                                </tr>
                                <tr>
                                    <th> End Date </th>
                                    <td> {!! $model->end_date !!} </td>
                                </tr>
                                <tr>
                                    <th> Message At</th>
                                    <td> {!! $model->message_at !!} </td>
                                </tr>
                                <tr>
                                    <th> Created At </th>
                                    <td> {{ $model->created_at }} </td>
                                </tr>
                                <tr>
                                    <th> Updated At </th>
                                    <td> {{ $model->updated_at }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection