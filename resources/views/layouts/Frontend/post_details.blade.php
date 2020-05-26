@extends('layouts.Frontend.master')
@push('css')
<link href="{{ asset('Frontend/assets/single-post-1/css/styles.css') }}
" rel="stylesheet">

<link href="{{ asset('Frontend/assets/single-post-1/css/responsive.css') }}" rel="stylesheet">
<style type="text/css">
	.image {
    height: 400px;
    width: 100%;
    background-image: url({{ asset('Backend/assets/images/posts/'.$singlePost->image) }});
    background-size: cover;
}
</style>
@endpush

@section('blogArea')

	<div class="image display-table center-text">
		<h1 class="title display-table-cell"><b></b></h1>
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{ asset('Backend/assets/images/profile/'. $singlePost->user->profile) }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $singlePost->user->name }}</b></a>
									<h6 class="date">
										{{ date('d-m-Y', strtotime($singlePost->date)) }} - 
										{{ $singlePost->created_at->diffForHumans() }}
										
									</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title">{{ $singlePost->title }}</h3>

							<p class="para">
								{!! $singlePost->body !!}
							</p>

							<ul class="tags">
								@foreach($singlePost->tags as $tag)
								<li><a href="{{ route('tag.posts', $tag->slug) }}">{{ $tag->name }}</a></li>
								@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
								<li>
									@if(Auth::user())
                                      <a href="{{ route('fevourite.list', $singlePost->id) }}"
                                      	class="{{ !Auth::user()->fevouritePost->where('pivot.post_id', $singlePost->id)->count() == 0 ? 'pavourite':'' }}">
                                      	<i class="ion-heart"></i>
                                      	{{ $singlePost->fevouriteToUser->count() }}</a>
									@else
									<a onclick="confirm('Sorry! If you Want Favourite This Your Must be login!')" href="javascript:void(0);"><i class="ion-heart"></i>{{ $singlePost->fevouriteToUser->count() }}</a>
									@endif
									</li>
								<li><a href="#"><i class="ion-chatbubble"></i>{{ $singlePost->comments->count() }}</a></li>
								<li><a href="#"><i class="ion-eye"></i>{{ $singlePost->view_count }}</a></li>
							</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>


					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT {{ $singlePost->user->name }}</b></h4>
							<p>{{ $singlePost->user->about }}</p>
						</div>

						<div class="tag-area">

							<h4 class="title"><b>Categories</b></h4>
							<ul>
							   @foreach($singlePost->categories as $category)
								<li>
									<a href="{{ route('category.posts', $category->slug) }}">
									{{ $category->name }}
								   </a>
							   </li>
	                           @endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">
               @foreach($randomPost as $rangpost)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{ asset('Backend/assets/images/posts/'. $rangpost->image)}}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="{{ asset('Backend/assets/images/profile/'. $rangpost->user->profile)}}" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{ route('single.post.view', $rangpost->slug) }}"><b>
									{{ $rangpost->title }}
								</b></a></h4>

								<ul class="post-footer">
									<li>
									@if(Auth::user())
                                      <a href="{{ route('fevourite.list', $rangpost->id) }}"
                                      	class="{{ !Auth::user()->fevouritePost->where('pivot.post_id', $rangpost->id)->count() == 0 ? 'pavourite':'' }}">
                                      	<i class="ion-heart"></i>
                                      	{{ $rangpost->fevouriteToUser->count() }}</a>
									@else
									<a onclick="confirm('Sorry! If you Want Favourite This Your Must be login!')" href="javascript:void(0);"><i class="ion-heart"></i>{{ $rangpost->fevouriteToUser->count() }}</a>
									@endif
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>{{ $singlePost->comments->count() }}</a></li>
									<li><a href="#"><i class="ion-eye"></i> {{ $singlePost->view_count }}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-md-6 col-sm-12 -->
               @endforeach
			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						@if(!Auth::user())
						<form method="post" action="{{ route('comment.store', $singlePost->id ) }}">
							@csrf
							<div class="row">

								<div class="col-sm-6">
									<input type="text" aria-required="true" name="name" class="form-control"
										placeholder="Enter your name" aria-invalid="true">
                                  @error('name')
                                  <strong style="color: red;">{{ $message }}</strong>
                                  @enderror
								</div><!-- col-sm-6 -->
								<div class="col-sm-6">
									<input type="email" aria-required="true" name="email" class="form-control"
										placeholder="Enter your email" aria-invalid="true">
								  @error('name')
                                  <strong style="color: red;">{{ $message }}</strong>
                                  @enderror
								</div><!-- col-sm-6 -->

								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
						@else
						<form method="post" action="{{ route('comment.store', $singlePost->id ) }}">
							@csrf
							<div class="row">

								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								  @error('comment')
                                  <strong style="color: red;">{{ $message }}</strong>
                                  @enderror
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
						@endif
					</div><!-- comment-form -->

					<h4><b>COMMENTS({{ $singlePost->comments->count() }})</b></h4>
            @if($singlePost->comments->count()>0)
            		<div class="commnets-area ">
                        @foreach($singlePost->comments as $comment)
						<div class="comment">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#">
										@if(isset($comment->user->profile))
										<img src="{{ asset('Backend/assets/images/profile/'. $comment->user->profile ) }}" alt="Profile Image">
										@else
                                        <img src="{{ asset('Backend/assets/images/profile/defoult.jpg')}}" alt="avator">
										@endif
									</a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
									<h6 class="date">on {{ $comment->created_at->diffForHumans() }}</h6>
								</div>

							</div><!-- post-info -->

							<p>{{ $comment->comment }}</p>

						</div>
						@endforeach
					</div><!-- commnets-area -->
            @else
            <strong style="color: red;">There is No Comments Avaiable!</strong>
            @endif
				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
@endsection