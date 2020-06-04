@extends('layouts.app')

@section('content')

@if(count ($errors) >0)
<ul class="list-group">
	@foreach($errors->all() as $error)
		<li class="list-group-item text-danger">
			{{$error}}
		</li>
	@endforeach
</ul>	
@endif

<div class="panel panel-default list-group " style="background-color: white; padding: 20px;">
	<div class="panel-heading text-center">Edit Post</div>
	<div class="panel-body">
		<form action="{{route('post.update', ['id' => $post->id])}}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" value="{{$post->title}}" class="form-control">
			</div>

			<div class="form-group">
				<label for="featured">Featured Image</label>
			<div class="form-group">	
				<img src="{{asset('/' . $post->featured)}}" height="70px" width="220px">
			</div>				
				<input type="file" name="featured"  class="form-control">
			</div>
			
			<div class="form-group">
				<label for="category">Category: {{$post->category->name}}</label>
				<select name="category_id", id="category"  class="form-control">
					@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="content">Content</label>
				<textarea name="content" id="content"  cols="5"  rows="5" class="form-control">{{$post->content}}</textarea>
			</div>
			<div class="form-group">
				<div class="text-center">
					<button type="submit" class="btn btn-success">Update Post</button>
				</div>
			</div>
			
		</form>
	</div>
</div>

@stop

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@stop

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
  $('#content').summernote();
});
</script>
@stop
