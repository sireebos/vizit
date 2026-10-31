{{-- FEATURES GRID SECTION --}}
@if($home->visible('features_grid'))
@php
    $amenityCount = (int) $home->content('amenities_count', 6);
    if ($amenityCount < 1) $amenityCount = 6;
    $defaultTitles = ['smoking free', 'king beds', 'Yacht rental', 'welcome drink', 'swimming pool', 'food included'];
@endphp
<div class="section padding-top-bottom over-hide">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $home->content('features_grid_subtitle', 'elegant suites') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $home->content('features_grid_title', 'Unpretentious luxury') }}</h3>
			</div>
			<div class="section clearfix"></div>
			@for ($i = 1; $i <= $amenityCount; $i++)
				@php
					$title = $home->content("amenity{$i}_title", $defaultTitles[$i-1] ?? '');
					$icon = $home->content("amenity{$i}_icon", "/assets/img/{$i}.svg");
					$text = $home->content("amenity{$i}_text", '');
					$link = $home->content("amenity{$i}_link", '/services');
					$button = $home->content("amenity{$i}_button", 'read more');
				@endphp
				@if (!empty($title))
				<div class="col-sm-6 col-lg-4 {{ $i > 1 ? 'mt-5' : '' }} {{ $i == 2 ? 'mt-sm-0' : '' }} {{ $i == 3 ? 'mt-lg-0' : '' }}">
					<div class="services-box text-center">
						<img src="@imgUrl($icon, '/assets/img/1.svg')" alt="{{ $title }}">
						<h5 class="mt-2">{{ $title }}</h5>
						@if (!empty($text))
						<p class="mt-3">{{ $text }}</p>
						@endif
						<a class="mt-1 btn btn-primary" href="{{ $link }}">{{ $button }}</a>
					</div>
				</div>
				@endif
			@endfor
		</div>
	</div>
</div>
@endif
