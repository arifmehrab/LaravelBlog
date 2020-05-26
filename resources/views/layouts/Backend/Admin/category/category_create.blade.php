@extends('layouts.Backend.Admin.master')
@section('content')
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
	    <div class="card">
		  <div class="card-body">
			  <form method="post" enctype="multipart/form-data" action="{{ route('admin.category.store') }}">
			  	@csrf
			  	<div class="form-group">
			  		<label>Add category</label>
			  		<input type="text" name="category" class="form-control"placeholder="Write category Name">
			  		@error('category')
			  		<strong class="text-danger">
			  			{{ $message }}
			  		</strong>
			  		@enderror
			  	</div>
			  	<div class="form-group">
			  		<label>Add category Fetured Image</label>
			  		<input type="file" name="image" class="form-control">
			  		@error('image')
			  		<strong class="text-danger">
			  			{{ $message }}
			  		</strong>
			  		@enderror
			  	</div>
			  	<div class="form-group">
			  		<input type="submit" name="submit" value="ADD" class="btn btn-info my-3">
			  	</div>
		      </form>
		    </div>
	    </div>
	</div>
	<div class="col-md-3"></div>
</div>
</div>
@endsection