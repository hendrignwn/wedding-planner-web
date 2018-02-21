@extends('layouts.app.frame')
@section('title', 'Marketing Contact #' . $model->id)
@section('description', 'Marketing Contact Details')
@section('breadcrumbs')
	@php echo \Breadcrumbs::render([['title' => 'Marketing Contact', 'url' => route('marketing-contact.index')], 'View '.$model->name]) @endphp
@endsection
@section('button')
	<a href="{{ route('marketing-contact.index') }}" class="btn btn-info btn-xs no-border">Back</a>
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-body">
			<a href="{{ route('marketing-contact.edit', ['id' => $model->id]) }}" class="btn btn-primary btn-xs" title="Edit Marketing Contact"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
			<br/>
			<br/>

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
							<th> Job </th>
							<td> {{ $model->job }} </td>
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
							<th> Note </th>
							<td><p> {!! $model->note !!} </p></td>
						</tr>
						<tr>
							<th> Status </th>
							<td> {{ $model->getStatusText() }} </td>
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
@endsection
