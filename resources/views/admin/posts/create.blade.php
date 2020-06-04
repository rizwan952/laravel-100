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
	<div class="panel-heading text-center">Create New Post</div>
	<div class="panel-body">
		<form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" class="form-control">
			</div>

			<div class="form-group">
				<label for="featured">Featured</label>
				<input type="file" name="featured" class="form-control">
			</div>
			<div class="form-group">
				<label for="category">Select a Category</label>
				<select name="category_id", id="category" class="form-control">
					@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="content">Content</label>
				<textarea name="content" id="content"  cols="5" rows="5" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<div class="text-center">
					<button type="submit" class="btn btn-success">Save Post</button>
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
