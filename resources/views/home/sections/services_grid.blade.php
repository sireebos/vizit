{{-- SERVICES GRID SECTION --}}
@if($home->visible('services_grid'))
@php
    $serviceCount = (int) $home->content('services_grid_count', 4);
    if ($serviceCount < 1) $serviceCount = 4;
    $defaultImages = ['/assets/img/ser-1.jpg', '/assets/img/ser-2.jpg', '/assets/img/ser-3.jpg', '/assets/img/ser-4.jpg'];
    $defaultTitles = ['spa salon', 'restaurant', 'pool', 'activities'];
@endphp
<div class="section background-dark over-hide">
	<div class="container-fluid py-4">
		<div class="row">
			@for ($i = 1; $i <= $serviceCount; $i++)
				@php
					$title = $home->content("service{$i}_title", $defaultTitles[$i-1] ?? 'service');
					$image = $home->content("service{$i}_image", $defaultImages[$i-1] ?? '/assets/img/ser-1.jpg');
					$link = $home->content("service{$i}_link", '/services');
				@endphp
				@if (!empty($title))
				<div class="col-sm-6 col-lg-{{ $serviceCount <= 3 ? 12 / $serviceCount : 3 }} {{ $i > 1 ? 'pt-4 pt-sm-0' : '' }} {{ $i > 2 ? 'pt-lg-0' : '' }}">
					<a href="{{ $link }}">
						<div class="img-wrap services-wrap">
							<img src="@imgUrl($image, '/assets/img/ser-1.jpg')" alt="{{ $title }}">
							<div class="services-text-over">{{ $title }}</div>
						</div>
					</a>
				</div>
				@endif
			@endfor
		</div>
	</div>
</div>
@endif
