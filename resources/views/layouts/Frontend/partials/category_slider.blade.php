	<div class="main-slider">
		<div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
			data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
			data-swiper-breakpoints="true" data-swiper-loop="true" >
			<div class="swiper-wrapper">

				@foreach($categories as $category)
				<div class="swiper-slide">
					<a class="slider-category" href="{{ route('category.posts', $category->slug) }}">
						<div class="blog-image"><img src="{{ asset('Backend/assets/images/categories/'.$category->image) }}" alt="Blog Image"></div>

						<div class="category">
							<div class="display-table center-text">
								<div class="display-table-cell">
									<h3><b>{{ $category->name }}</b></h3>
								</div>
							</div>
						</div>

					</a>
				</div><!-- swiper-slide -->
				@endforeach

			</div><!-- swiper-wrapper -->

		</div><!-- swiper-container -->

	</div><!-- slider -->