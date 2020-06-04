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
	<div class="panel-heading text-center">Update Category: {{$category->name}}</div>
	<div class="panel-body">
		<form action="{{route('category.update', ['id' => $category->id])}}" method="POST">
			{{csrf_field()}}
			<div class="form-group">
				<label for="name">Title</label>
				<input type="text" name="name" value="{{$category->name}}" class="form-control">
			</div>

			<div class="form-group">
				<div class="text-center">
					<button type="submit" class="btn btn-success">Update Category</button>
				</div>
			</div>
			
		</form>
	</div>
</div>

@stop