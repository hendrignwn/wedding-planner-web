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
                                    <th> Gender </th>
                                    <td> {{ $model->getGenderLabel() }} </td>
                                </tr>
                                <tr>
                                    <th> Phone </th>
                                    <td> {{ $model->phone }} </td>
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
                                    <td><p> {!! $model->getRoleMobileAppLabel() !!} </p></td>
                                </tr>
                                <tr>
                                    <th> Current Login On Device Number </th>
                                    <td><p> {!! $model->device_number !!} </p></td>
                                </tr>
                                <tr>
                                    <th> Last Login At </th>
                                    <td> {{ $model->last_login_at }} </td>
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
                    
                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Partner</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="20%">ID</th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->id : $model->userRelation->maleUser->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td>
                                                <a href="{!! route('user-app.show', ['id' => $model->getIsGenderMale() ? $model->userRelation->femaleUser->id : $model->userRelation->maleUser->id]) !!}">
                                                    {{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->name : $model->userRelation->maleUser->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Email </th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->email : $model->userRelation->maleUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th> Phone </th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->phone : $model->userRelation->maleUser->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th> Status </th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->getStatusLabel() : $model->userRelation->maleUser->getStatusLabel() }}</td>
                                        </tr>
                                        <tr>
                                            <th> Role </th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->getRoleMobileAppLabel() : $model->userRelation->maleUser->getRoleMobileAppLabel() }}</td>
                                        </tr>
                                        <tr>
                                            <th> Last Login At </th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->last_login_at : $model->userRelation->maleUser->last_login_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Created At </th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->created_at : $model->userRelation->maleUser->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Updated At </th>
                                            <td>{{ $model->getIsGenderMale() ? $model->userRelation->femaleUser->updated_at : $model->userRelation->maleUser->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Details</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="20%">Relation</th>
                                            <td><a href="{!! route('user-relation.show', ['id'=>$model->userRelation->id]) !!}">{{ $model->userRelation->getRelationName() }}</a></td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Wedding Day</th>
                                            <td>{{ \Carbon\Carbon::parse($model->userRelation->wedding_day)->format('d M Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Venue</th>
                                            <td>{{ $model->userRelation->venue }}</td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Photo</th>
                                            <td><img src="{{ $model->userRelation->getPhotoUrl() }}" width="30%" /></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
</div>
@endsection
