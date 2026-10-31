@extends('layouts.site')

@section('title', $page->seo_title ?? ($siteSettings->site_name ?? 'Services'))

@section('content')
@if($page->visible('hero'))
<div class="section big-55-height over-hide z-bigger">

	<div class="parallax parallax-top" style="background-image: url('@imgUrl($page->content('hero_image'), '/assets/img/3.jpg')')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $page->content('hero_title', 'Services') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('video'))
<div class="section padding-top-bottom-smaller background-dark-2 over-hide">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h5 class="color-grey">{{ $page->content('video_tagline', 'A new dimension of luxury.') }}</h5>
				<p class="color-white mt-3 mb-3"><em>{{ $page->content('video_label', 'services overview, 2:00 min') }}</em></p>
				<a href="{{ $page->content('video_url', 'https://vimeo.com/54851233') }}" class="video-button" data-fancybox=""><i class="fa fa-play"></i></a>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('services_boxes'))
@php
  $boxDefaults = [
    ['icon' => '/assets/img/1.svg', 'title' => 'smoking free'],
    ['icon' => '/assets/img/2.svg', 'title' => 'king beds'],
    ['icon' => '/assets/img/3.svg', 'title' => 'Yacht rental'],
    ['icon' => '/assets/img/4.svg', 'title' => 'welcome drink'],
    ['icon' => '/assets/img/5.svg', 'title' => 'swimming pool'],
    ['icon' => '/assets/img/6.svg', 'title' => 'food included'],
  ];
@endphp
<div class="section padding-top-bottom over-hide">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $page->content('services_subtitle', 'elegant suites') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $page->content('services_title', 'Unpretentious luxury') }}</h3>
			</div>
			<div class="section clearfix"></div>
			@php $boxesCount = $page->content('boxes_count', 6); @endphp
			@for($i = 1; $i <= $boxesCount; $i++)
			@php
				$title = $page->content("box{$i}_title");
				$description = $page->content("box{$i}_description");
				$button = $page->content("box{$i}_button", 'read more');
				$icon = $page->content("box{$i}_icon", $boxDefaults[($i-1) % count($boxDefaults)]['icon'] ?? '/assets/img/1.svg');
				$mtClass = $i == 1 ? '' : ($i == 2 ? 'mt-5 mt-sm-0' : ($i == 3 ? 'mt-5 mt-lg-0' : 'mt-5'));
			@endphp
			@if($title)
			<div class="col-sm-6 col-lg-4 {{ $mtClass }}">
				<div class="services-box text-center">
					<img src="@imgUrl($icon)" alt="{{ $title }}">
					<h5 class="mt-2">{{ $title }}</h5>
					<p class="mt-3">{{ $description }}</p>
					<a class="mt-1 btn btn-primary" href="{{ route('services') }}">{{ $button }}</a>
				</div>
			</div>
			@endif
			@endfor
		</div>
	</div>
</div>
@endif

@if($page->visible('amenities'))
@php
  $amenityDefaults = [
    ['icon' => '/assets/img/icons/1.svg', 'label' => 'no smoking'],
    ['icon' => '/assets/img/icons/2.svg', 'label' => 'big beds'],
    ['icon' => '/assets/img/icons/3.svg', 'label' => 'yacht riding'],
    ['icon' => '/assets/img/icons/4.svg', 'label' => 'free drinks'],
    ['icon' => '/assets/img/icons/5.svg', 'label' => 'swimming pool'],
    ['icon' => '/assets/img/icons/6.svg', 'label' => 'room breakfast'],
  ];
@endphp
<div class="section background-dark padding-top-bottom-smaller over-hide">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				@for($i = 1; $i <= 6; $i++)
				@php
					$mtClass = $i <= 2 ? '' : ($i == 3 ? 'mt-4 mt-md-0' : 'mt-4 mt-lg-0');
				@endphp
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center {{ $mtClass }}">
					<div class="amenities">
						<img src="@imgUrl($page->content('amenity'.$i.'_icon'), $amenityDefaults[$i-1]['icon'])" alt="{{ $page->content('amenity'.$i.'_label', $amenityDefaults[$i-1]['label']) }}">
						<p>{{ $page->content('amenity'.$i.'_label', $amenityDefaults[$i-1]['label']) }}</p>
					</div>
				</div>
				@endfor
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('offers'))
<div class="section padding-top-bottom background-grey over-hide">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $page->content('offers_subtitle', 'Excellent services') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $page->content('offers_title', 'what we offer') }}</h3>
			</div>
			<div class="section clearfix"></div>
		</div>
		@php $offersCount = $page->content('offers_count', 4); @endphp
		@for($i = 1; $i <= $offersCount; $i++)
			@php
				$title = $page->content("service{$i}_title");
				$description = $page->content("service{$i}_description");
				$button = $page->content("service{$i}_button", 'explore');
				$image = $page->content("service{$i}_image", "/assets/img/ser-{$i}.jpg");
			@endphp
			@if($title)
			<div class="row background-white p-0 m-0">
				@if($i % 2 == 1)
				{{-- Odd items: Image left, text right --}}
				<div class="col-xl-6 p-0">
					<div class="img-wrap" id="rev-{{ $i }}">
						<img src="@imgUrl($image)" alt="{{ $title }}">
					</div>
				</div>
				<div class="col-xl-6 p-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-9 pt-4 pt-xl-0 pb-5 pb-xl-0 text-center">
							<h5 class="">{{ $title }}</h5>
							<p class="mt-3">{{ $description }}</p>
							<a class="mt-1 btn btn-primary" href="{{ route('services') }}">{{ $button }}</a>
						</div>
					</div>
				</div>
				@else
				{{-- Even items: Text left, image right --}}
				<div class="col-xl-6 p-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-9 pt-4 pt-xl-0 pb-5 pb-xl-0 text-center">
							<h5 class="">{{ $title }}</h5>
							<p class="mt-3">{{ $description }}</p>
							<a class="mt-1 btn btn-primary" href="{{ route('services') }}">{{ $button }}</a>
						</div>
					</div>
				</div>
				<div class="col-xl-6 order-last order-xl-first p-0">
					<div class="img-wrap" id="rev-{{ $i }}">
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
@endsection