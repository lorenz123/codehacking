@extends('layouts.admin')


@section('content')

	@if(Session::has('deleted_pic'))
		<div class="alert alert-danger">
		  <strong>{{session('deleted_pic')}}!</strong> 
		</div>
	@endif

	

	<h1>Media</h1>

	@if($photos)

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Filename</th>
				<th>Created</th>
				<th>Action</th>
			</tr>	
		</thead>

		<tbody>

			@foreach($photos as $photo)

			<tr>
				<td>{{$photo->id}}</td>
				<td><img src="{{asset($photo->file)}}" alt="" height="50"></td>
				<td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no date'}}</td>
				<td>
					 {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}
						<div class="form-group">
					   
					      {!! Form::submit('Delete Post', ['class'=>'btn btn-danger'])!!}
					   
					    </div> 
					 {!! Form::close() !!}

				</td>

			</tr>
		
			@endforeach

		</tbody>
	</table>

	@endif

@stop