@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            @if(session()->has('message'))
            <div class="alert alert-info">
                {{ session()->get('message') }}
            </div>
            @endif
            
            @if($errors->update->has('title'))
            <div class="alert alert-danger">
                {{ implode("<br>", $errors->update->get('title')) }}
            </div>
            @endif

        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">All Post</div>
                <div class="panel-body">
                    @if(count($post) != 0)
                    <table class="table table-bordered table-striped">
                    	<thead>
                    		<tr>
                    			<th width="60%">Title</th>
                    			<th width="20%">Edit</th>
                    			<th width="20%">Delete</th>
                    		</tr>
                    	</thead>
                    	<tbody>

                            @foreach( $post as $thePost )
                    		<tr>
                    			<td>{{ $thePost->title }}</td>

                    			<td>
									<!-- Button trigger modal -->
									<button type="button" class="action-button" data-toggle="modal" data-target="#myModal-{{ $thePost->id }}">
										<span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
									</button>

									<!-- Modal -->
									<div class="modal fade" id="myModal-{{ $thePost->id }}" role="dialog">
    									<div class="modal-dialog" role="document">

                                            <form action="{{ route('post.update', ['post' => $thePost->id]) }}" method="post">
        									<div class="modal-content">
            									<div class="modal-header">
                									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                									<h4 class="modal-title" id="myModalLabel">Update Post</h4>
            									</div>
            									<div class="modal-body">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
            									   <div class="form-group">
                                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $thePost->title }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea rows="6" name="content" class="form-control" placeholder="Content">{{ $thePost->content }}</textarea>
                                                    </div>
            									</div>
            									<div class="modal-footer">
                									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                									<button type="submit" class="btn btn-primary">Save changes</button>
            									</div>
        									</div>
                                            </form>

    									</div>
									</div>
                    			</td>

                    			<td>
                                    <form action="{{ route('post.destroy', ['post' => $thePost->id]) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="action-button" onclick="return confirm('Are you sure?')">
                                            <span aria-hidden="true" class="glyphicon glyphicon-remove red"></span>
                                        </button>
                                    </form>
                                </td>
                    		</tr>
                            @endforeach

                    	</tbody>
                    </table>
                    
                    @else
                        <h4>No post found</h4>
                    @endif

                </div>
                
                @if($post->hasMorePages())
                <div class="panel-footer">
                    {{ $post->links() }}
                </div>
                @endif

            </div>
        </div>
		<!-- ./col-md-6 -->

        <div class="col-md-6">
            <form action="{{ route('post.create') }}" method="POST">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create Post
                    </div>
                    <div class="panel-body">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title">
                            @if($errors->has('title'))
                            <div class="alert alert-danger">
                                {{ implode("<br>", $errors->get('title')) }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea rows="6" name="content" class="form-control" placeholder="Content">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="submit" value="Publish" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
