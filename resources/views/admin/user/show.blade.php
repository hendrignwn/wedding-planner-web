@extends('layouts.admin.main')
@section('headerTitle', 'User Detail #' . $model->id)
@section('pageTitle', 'User Detail #' . $model->id)

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    
                    <div class="pull-left mrg-btm-20">
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        <a href="{{ route('user.edit', ['id' => $model->id]) }}" class="btn btn-primary btn-rounded btn-sm">Update User</a>
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
                                    <th> Email </th>
                                    <td> {{ $model->email }} </td>
                                </tr>
                                <tr>
                                    <th> Password </th>
                                    <td> {{ 'xxx' }} </td>
                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td> {{ $model->getStatusLabel() }} </td>
                                </tr>
                                <tr>
                                    <th> Role </th>
                                    <td><p> {!! $model->getRoleAdminLabel() !!} </p></td>
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
