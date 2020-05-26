@extends('layouts.Frontend.master')
@push('css')
<link href="{{ asset('Frontend/assets/category/css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('Frontend/assets/category/css/responsive.css') }}" rel="stylesheet">
<style type="text/css">
	.image {
    height: 400px;
    width: 100%;
    background-image: url({{ asset('Backend/assets/images/categories/'.$category->image) }});
    background-size: cover;
}
</style>
@endpush
@section('blogArea')

	<div class="image display-table center-text">
		<h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
	</div><!-- slider -->

		<section class="blog-area section">
		<div class="container">
        @if($posts->count() > 0)
			<div class="row">
				@foreach($posts as $post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{ asset('Backend/assets/images/posts/'.$post->image) }}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="{{ asset('Backend/assets/images/profile/'. $post->user->profile)}}" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{ route('single.post.view', $post->slug) }}"><b>
									{{ $post->title }}
								</b></a></h4>

								<ul class="post-footer">
									<li>
									@if(Auth::user())
                                      <a href="{{ route('fevourite.list', $post->id) }}"
                                      	class="{{ !Auth::user()->fevouritePost->where('pivot.post_id', $post->id)->count() == 0 ? 'pavourite':'' }}">
                                      	<i class="ion-heart"></i>
                                      	{{ $post->fevouriteToUser->count() }}</a>
									@else
									<a onclick="confirm('Sorry! If you Want Favourite This Your Must be login!')" href="javascript:void(0);"><i class="ion-heart"></i>{{ $post->fevouriteToUser->count() }}</a>
									@endif
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
              @endforeach
			</div><!-- row -->
        @else
        <h3 class="text-center text-danger">Sorry! The Category Post is Not Found:(</h3>
        @endif   
{{--            {{ $posts->links() }} --}}

		</div><!-- container -->
	</section><!-- section -->

@endsection