@extends('layouts.Backend.Admin.master')
@section('content')
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
	    <div class="card">
		  <div class="card-body">
			  <form method="post" action="{{ route('admin.tag.store') }}">
			  	@csrf
			  	<div class="form-group">
			  		<label>Add Tag</label>
			  		<input type="text" name="tag" class="form-control"placeholder="Write Tag">
			  		@error('tag')
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