{{-- RESTAURANTS SECTION --}}
@if($home->visible('restaurants'))
<div class="section padding-top-bottom background-grey over-hide">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $home->content('restaurants_subtitle', 'Excellent restaurant') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $home->content('restaurants_title', 'Dining & Bars') }}</h3>
			</div>
			<div class="section clearfix"></div>
		</div>
		@php $restaurantsCount = $home->content('restaurants_count', 2); @endphp
		@for($i = 1; $i <= $restaurantsCount; $i++)
			@php
				$title = $home->content("restaurant{$i}_title");
				$text = $home->content("restaurant{$i}_text");
				$button = $home->content("restaurant{$i}_button", 'explore');
				$link = $home->content("restaurant{$i}_link", '/restaurant');
				$image = $home->content("restaurant{$i}_image", "/assets/img/rest-{$i}.jpg");
			@endphp
			@if($title)
			<div class="row background-white p-0 m-0">
				@if($i % 2 == 1)
				{{-- Odd items: Image left, text right --}}
				<div class="col-xl-6 p-0">
					<div class="img-wrap" id="rev-{{ 2 + $i }}">
						<img src="@imgUrl($image)" alt="{{ $title }}">
					</div>
				</div>
				<div class="col-xl-6 p-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-9 pt-4 pt-xl-0 pb-5 pb-xl-0 text-center">
							<h5>{{ $title }}</h5>
							<p class="mt-3">{{ $text }}</p>
							<a class="mt-1 btn btn-primary" href="{{ $link }}">{{ $button }}</a>
						</div>
					</div>
				</div>
				@else
				{{-- Even items: Text left, image right --}}
				<div class="col-xl-6 p-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-9 pt-4 pt-xl-0 pb-5 pb-xl-0 text-center">
							<h5>{{ $title }}</h5>
							<p class="mt-3">{{ $text }}</p>
							<a class="mt-1 btn btn-primary" href="{{ $link }}">{{ $button }}</a>
						</div>
					</div>
				</div>
				<div class="col-xl-6 order-xl-last p-0">
					<div class="img-wrap" id="rev-{{ 2 + $i }}">
						<img src="@imgUrl($image)" alt="{{ $title }}">
					</div>
				</div>
				@endif
			</div>
			@endif
		@endfor
	</div>
</div>
@endif
