@extends('layouts.admin')



@section('content')

	@if(Session::has('added_post'))
		<div class="alert alert-success">
		  <strong>{{session('added_post')}}!</strong> 
		</div>
	@endif

	@if(Session::has('updated_post'))
		<div class="alert alert-info">
		  <strong>{{session('updated_post')}}!</strong> 
		</div>
	@endif

	@if(Session::has('deleted_post'))
		<div class="alert alert-danger">
		  <strong>{{session('deleted_post')}}!</strong> 
		</div>
	@endif

	<h1>Posts</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Photo</th>
				<th>User</th>
				<th>Category</th>
				<th>Title</th>
				<th>Body</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>	
		</thead>

		<tbody>
		
		@if($posts)

			@foreach($posts as $post)

			<tr>
				<td>{{$post->id}}</td>
				<td><img src="{!!asset($post->photo ? $post->photo->file : 'http://placehold.it/400x400' )!!}" height="50" alt=""></td>
				<td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
				<td>{{$post->category ? $post->category->name : "No category"}}</td>
				<td>{{$post->title}}</td>
				<td>{{str_limit($post->body, 30)}}</td>
				<td>{{$post->created_at->diffForHumans()}}</td>
				<td>{{$post->updated_at->diffForHumans()}}</td>
			</tr>
		
			@endforeach

		@endif

		</tbody>
	</table>

@stop