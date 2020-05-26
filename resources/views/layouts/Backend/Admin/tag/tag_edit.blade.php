@extends('layouts.Backend.Admin.master')
@section('content')
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
	    <div class="card">
		  <div class="card-body">
			  <form method="post" action="{{ route('admin.tag.update', $tagEdit->id) }}">
			  	@csrf
			  	@method('PUT')
			  	<div class="form-group">
			  		<label>Edit Tag</label>
			  		<input type="text" name="tag" class="form-control" value="{{ $tagEdit->name }}">
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