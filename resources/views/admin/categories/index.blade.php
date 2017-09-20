@extends('layouts.admin')


@section('content')

	@if(Session::has('added_cat'))
		<div class="alert alert-success">
		  <strong>{{session('added_cat')}}!</strong> 
		</div>
	@endif

	@if(Session::has('updated_cat'))
		<div class="alert alert-info">
		  <strong>{{session('updated_cat')}}!</strong> 
		</div>
	@endif

	@if(Session::has('deleted_cat'))
		<div class="alert alert-danger">
		  <strong>{{session('deleted_cat')}}!</strong> 
		</div>
	@endif

	<h1>Categories</h1>


@include('includes.form_errors')

	<div class="col-sm-6">
		{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
  
		    <div class="form-group">

		      {!! Form::label('name', 'Name:') !!}
		      {!! Form::text('name', null, ['class'=>'form-control'])!!}

		    </div>
		
		   
		   <div class="form-group">
		   
		      {!! Form::submit('Create Category', ['class'=>'btn btn-primary'])!!}
		   
		    </div>   
		 
		 {!! Form::close() !!}

	</div>

	<div class="col-sm-6">

		@if($categories)

		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>

				@foreach($categories as $category)

				<tr>
					<td>{{$category->id}}</td>
					<td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
					<td>{{$category->created_at ? $category->created_at->diffForHumans() : "No Date"}}</td>
				</tr>

				@endforeach

			</tbody>
		</table>

		@endif

	</div>





	

@stop