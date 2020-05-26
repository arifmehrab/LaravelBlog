@extends('layouts.Frontend.master')

@section('blogArea')
<div class="row">
	<div class="col-lg-6 offset-lg-3 py-5">
		<form method="post" action="{{ route('admin.subscriber.store') }}">
			@csrf
			<input placeholder="Enter Your Name" type="text" name="name" class="form-control">
			<input placeholder="Enter Your Mobile" type="text" name="mobile" class="form-control">
			<input placeholder="Enter Your Email" type="email" name="email" class="form-control">
			<input type="submit" value="send" class="form-control">
		</form>
	</div>
</div>
@endsection