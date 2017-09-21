@extends('layouts.blog-post')


@section('content')

        <!-- Blog Post -->

        <!-- Title -->
        @if(Session::has('comment_message'))
            <div class="alert alert-info">
              <strong>{{session('comment_message')}}!</strong> 
            </div>
        @endif
        
        <h1>{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="{{asset($post->photo->file)}}" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">
        	{{$post->body}}
        </p>
        <hr>

        <!-- Blog Comments -->


        @if(Auth::check())


        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
  
            <input type="hidden" name="post_id" value="{{$post->id}}">

		    <div class="form-group">

		      {!! Form::label('body', 'Body:') !!}
		      {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3])!!}

		    </div>
		
		   
		   <div class="form-group">
		   
		      {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary col-sm-6'])!!}
		   
		    </div>   
		 
		 	{!! Form::close() !!}

        </div>

        @endif
        
        <hr>

        <!-- Posted Comments -->

        @if(count($comments) > 0)

            @foreach($comments as $comment)
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" height="64" src="{{asset($comment->photo)}}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$comment->author}}
                    <small>{{$comment->created_at->diffForHumans()}}</small>
                </h4>
                <p>{{$comment->body}}</p>


                @if(count($comment->replies) > 0)

                    @foreach($comment->replies as $reply)

                    
                   
                        <!-- Nested Comment -->
                        <div id="nested-comment" class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" height="64" src="{{asset($reply->photo)}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                        </div>
                        
                        @endforeach

                        <div class="comment-reply-container">

                            <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                            <div class="comment-reply col-sm-8">

                            {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                
                                <div class="form-group">

                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">


                                  {!! Form::label('body', 'Body:') !!}
                                  {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1])!!}

                                </div>

                                <div class="form-group">
                               
                                  {!! Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
                               
                                </div> 

                            {!! Form::close() !!}

                            </div>

                        </div>

                @endif

                    
        </div>
    </div>
            @endforeach
        @endif        


@stop


@section('scripts')

    <script type="text/javascript">

        $(".toggle-reply").click(function() {

            $(this).next().slideToggle("slow");


        });

    </script>

@stop