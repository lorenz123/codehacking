@extends('layouts.admin')


@section('content')

	@if(Session::has('added_user'))
		<div class="alert alert-success">
		  <strong>{{session('added_user')}}!</strong> 
		</div>
	@endif

	@if(Session::has('updated_user'))
		<div class="alert alert-info">
		  <strong>{{session('updated_user')}}!</strong> 
		</div>
	@endif

	@if(Session::has('deleted_user'))
		<div class="alert alert-danger">
		  <strong>{{session('deleted_user')}}!</strong> 
		</div>
	@endif



	<h1>Users</h1>
	<table class="table table-hover">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Photo</th>
	        <th>Name</th>
	        <th>Email</th>
	        <th>Role</th>
	        <th>Status</th>
	        <th>Created</th>
	        <th>Updated</th>
	      </tr>
	    </thead>
	    <tbody>

	    @if($users)
	    	@foreach($users as $user)
	      
	      <tr>
	        <td>{{$user->id}}</td>
	        <td><img src="{!!asset($user->photo ? $user->photo->file : 'http://placehold.it/400x400' )!!}" height="50" alt=""></td>
	        <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
	        <td>{{$user->email}}</td>
	        <td>{{$user->role->name}}</td>
	        <td>{{$user->is_active == 1 ? 'Active' : 'Inactive' }}</td>
	        <td>{{$user->created_at->diffForHumans()}}</td>
	        <td>{{$user->updated_at->diffForHumans()}}</td>
	      </tr>

	    	@endforeach
	    @endif

	    </tbody>
  	</table>
@stop