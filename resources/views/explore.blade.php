@extends('layouts.site')

@section('title', $page->seo_title ?? ($siteSettings->site_name ?? 'Explore'))

@push('styles')
<style>
  .services-wrap[style*="--overlay-color"]::before {
    background-color: var(--overlay-color, #000) !important;
    opacity: var(--overlay-opacity, 0.5) !important;
  }
</style>
@endpush

@section('content')
@if($page->visible('hero'))
<div class="section big-55-height over-hide">

	<div id="poster_background-explore"></div>
	<div id="video-wrap" class="parallax-top">
		@if($page->content('hero_video'))
		<video id="video_background" preload="auto" autoplay="" loop="loop" muted="muted" poster="{{ url('/assets/img/trans.png') }}">
			<source src="@imgUrl($page->content('hero_video'))" type="video/mp4">
		</video>
		@else
		<video id="video_background" preload="auto" autoplay="" loop="loop" muted="muted" poster="{{ url('/assets/img/trans.png') }}">
			<source src="{{ url('/assets/video/video-explore.mp4') }}" type="video/mp4">
		</video>
		@endif
	</div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $page->content('hero_title', 'Explore') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('intro'))
<div class="section padding-top-bottom over-hide">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="m-0">{{ $page->content('intro_text', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.') }}</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section over-hide">
	<div class="img-wrap">
		<img src="@imgUrl($page->content('intro_image'), '/assets/img/explore1.jpg')" alt="">
	</div>
</div>
@endif

@if($page->visible('features'))
<div class="section padding-top-bottom over-hide">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="img-wrap">
						<img src="@imgUrl($page->content('feature_1_image'), '/assets/img/explore2.jpg')" alt="">
					</div>
					<p class="mb-0 mt-3 color-black text-center"><strong><em>{{ $page->content('feature_1_caption', 'night life') }}</em></strong></p>
				</div>
				<div class="col-md-6 mt-4 mt-md-0">
					<div class="img-wrap">
						<img src="@imgUrl($page->content('feature_2_image'), '/assets/img/explore4.jpg')" alt="">
					</div>
					<p class="mb-0 mt-3 color-black text-center"><strong><em>{{ $page->content('feature_2_caption', 'night life') }}</em></strong></p>
				</div>
				<div class="col-12 mt-4">
					<div class="img-wrap">
						<img src="@imgUrl($page->content('feature_3_image'), '/assets/img/explore3.jpg')" alt="">
					</div>
					<p class="mb-0 mt-3 color-black text-center"><strong><em>{{ $page->content('feature_3_caption', 'city view') }}</em></strong></p>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('rooms'))
<div class="section padding-top-bottom over-hide background-grey">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $page->content('rooms_subtitle', 'luxury') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $page->content('rooms_title', 'Our rooms') }}</h3>
			</div>
			<div class="section clearfix"></div>
			
			@forelse($roomTypes as $index => $roomType)
			@php
				$roomStars = (int) ($roomType->stars ?? 5);
				$roomUrl = route('room.detail', $roomType->slug);
				$roomImage = $roomType->images[0] ?? '/assets/img/room'.($index+3).'.jpg';
			@endphp
			<div class="col-lg-4 {{ $index > 0 ? 'mt-4 mt-lg-0' : '' }}" data-scroll-reveal="enter bottom move 50px over 0.7s after {{ 0.2 * ($index + 1) }}s">
				<div class="room-box background-white">
					<div class="room-name">{{ $roomType->name }}</div>
					<div class="room-per">
						@for($s = 1; $s <= 5; $s++)
						<i class="fa fa-star{{ $s > $roomStars ? '-o' : '' }}"></i>
						@endfor
					</div>
					<img src="@imgUrl($roomImage)" alt="{{ $roomType->name }}">
					<div class="room-box-in">
						<h5 class="">{{ $roomType->subtitle ?? $roomType->name }}</h5>
						<p class="mt-3">{{ Str::limit($roomType->description, 120) }}</p>
						<a class="mt-1 btn btn-primary" href="{{ $roomUrl }}">book from {{ config('hotel.currency_symbol', '₦') }}{{ number_format($roomType->base_price) }}</a>
						<div class="room-icons mt-4 pt-4">
							<img src="{{ url('/assets/img/5.svg') }}" alt="">
							<img src="{{ url('/assets/img/2.svg') }}" alt="">
							<img src="{{ url('/assets/img/3.svg') }}" alt="">
							<a href="{{ $roomUrl }}">full info</a>
						</div>
					</div>
				</div>
			</div>
			@empty
			{{-- Fallback to static content if no room types exist --}}
			@for($i = 1; $i <= 3; $i++)
			@php
				$roomStars = (int) $page->content('room_'.$i.'_stars', $i == 2 ? 4 : 5);
				$roomUrl = $page->content('room_'.$i.'_url') ?: route('rooms.gallery');
			@endphp
			<div class="col-lg-4 {{ $i > 1 ? 'mt-4 mt-lg-0' : '' }}" data-scroll-reveal="enter bottom move 50px over 0.7s after {{ 0.2 * $i }}s">
				<div class="room-box background-white">
					<div class="room-name">{{ $page->content('room_'.$i.'_name', $i == 1 ? 'suite tanya' : ($i == 2 ? 'suite helen' : 'suite andrea')) }}</div>
					<div class="room-per">
						@for($s = 1; $s <= 5; $s++)
						<i class="fa fa-star{{ $s > $roomStars ? '-o' : '' }}"></i>
						@endfor
					</div>
					<img src="@imgUrl($page->content('room_'.$i.'_image'), '/assets/img/room'.($i+2).'.jpg')" alt="">
					<div class="room-box-in">
						<h5 class="">{{ $page->content('room_'.$i.'_type', $i == 1 ? 'pool suite' : ($i == 2 ? 'small room' : 'Apartment')) }}</h5>
						<p class="mt-3">{{ $page->content('room_'.$i.'_description', 'Sed ut perspiciatis unde omnis, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.') }}</p>
						<a class="mt-1 btn btn-primary" href="{{ $roomUrl }}">{{ $page->content('room_'.$i.'_price', $i == 1 ? 'book from ₦130,000' : ($i == 2 ? 'book from ₦80,000' : 'book from ₦110,000')) }}</a>
						<div class="room-icons mt-4 pt-4">
							<img src="{{ url('/assets/img/5.svg') }}" alt="">
							<img src="{{ url('/assets/img/2.svg') }}" alt="">
							<img src="{{ url('/assets/img/3.svg') }}" alt="">
							<a href="{{ $roomUrl }}">full info</a>
						</div>
					</div>
				</div>
			</div>
			@endfor
			@endforelse
		</div>
	</div>
</div>
@endif

@if($page->visible('services_banner'))
@php
	$bannerBgColor = $page->content('services_banner_bg_color', '#1a1a1a');
	$bannerTextColor = $page->content('services_banner_text_color', '#ffffff');
	$bannerOverlayColor = $page->content('services_banner_overlay_color', '#000000');
	$bannerOverlayOpacity = $page->content('services_banner_overlay_opacity', '50') / 100;
@endphp
<div class="section over-hide" style="background-color: {{ $bannerBgColor }};">
	<div class="container-fluid py-4">
		<div class="row">
			@for($i = 1; $i <= 4; $i++)
			@php
				$serviceUrl = $page->content('service_'.$i.'_url') ?: route('services');
			@endphp
			<div class="col-sm-6 col-lg-3 {{ $i > 1 ? 'pt-4 pt-'.($i > 2 ? 'lg' : 'sm').'-0' : '' }}">
				<a href="{{ $serviceUrl }}">
					<div class="img-wrap services-wrap" style="--overlay-color: {{ $bannerOverlayColor }}; --overlay-opacity: {{ $bannerOverlayOpacity }};">
						<img src="@imgUrl($page->content('service_'.$i.'_image'), '/assets/img/ser-'.$i.'.jpg')" alt="">
						<div class="services-text-over" style="color: {{ $bannerTextColor }};">{{ $page->content('service_'.$i.'_title', $i == 1 ? 'spa salon' : ($i == 2 ? 'restaurant' : ($i == 3 ? 'pool' : 'activities'))) }}</div>
					</div>
				</a>
			</div>
			@endfor
		</div>
	</div>
</div>
@endif
@endsection