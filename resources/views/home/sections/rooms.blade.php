{{-- ROOMS SECTION --}}
@if($home->visible('rooms'))
@php
    $roomCount = (int) $home->content('rooms_count', 4);
    if ($roomCount < 1) $roomCount = 4;
    $defaultImages = ['/assets/img/room3.jpg', '/assets/img/room4.jpg', '/assets/img/room5.jpg', '/assets/img/room6.jpg'];
@endphp
<div class="section padding-top-bottom over-hide background-grey">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $home->content('rooms_subtitle', 'luxury') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $home->content('rooms_title', 'Our rooms') }}</h3>
			</div>
			<div class="section clearfix"></div>
			@for ($i = 1; $i <= $roomCount; $i++)
				@php
					$name = $home->content("room{$i}_name", '');
					$type = $home->content("room{$i}_type", '');
					$price = $home->content("room{$i}_price", '');
					$text = $home->content("room{$i}_text", '');
					$link = $home->content("room{$i}_link", '/search');
					$image = $home->content("room{$i}_image", $defaultImages[$i-1] ?? '/assets/img/room3.jpg');
					$stars = $home->content("room{$i}_stars", '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>');
				@endphp
				@if (!empty($name))
				<div class="col-md-6 {{ $i > 1 ? 'mt-4' : '' }} {{ $i == 2 ? 'mt-md-0' : '' }}">
					<div class="room-box background-white">
						<div class="room-name">{{ $name }}</div>
						<div class="room-per">{!! $stars !!}</div>
						<img src="@imgUrl($image, '/assets/img/room3.jpg')" alt="{{ $name }}">
						<div class="room-box-in">
							<h5>{{ $type }}</h5>
							@if (!empty($text))
							<p class="mt-3">{{ $text }}</p>
							@endif
							<a class="mt-1 btn btn-primary" href="{{ $link }}">{{ $price }}</a>
							<div class="room-icons mt-4 pt-4">
								<img src="{{ url('/assets/img/5.svg') }}" alt="">
								<img src="{{ url('/assets/img/2.svg') }}" alt="">
								<img src="{{ url('/assets/img/3.svg') }}" alt="">
								<img src="{{ url('/assets/img/1.svg') }}" alt="">
								<a href="{{ $link }}">full info</a>
							</div>
						</div>
					</div>
				</div>
				@endif
			@endfor
		</div>
	</div>
</div>
@endif
