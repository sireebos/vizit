@extends('layouts.site')

@section('title', $page->seo_title ?? ($siteSettings->site_name ?? 'Restaurant'))

@section('content')
@if($page->visible('hero'))
<div class="section big-55-height over-hide z-bigger">

	<div id="poster_background-res"></div>
	<div id="video-wrap" class="parallax-top">
		<video id="video_background" preload="auto" autoplay="" loop="loop" muted="muted" poster="{{ url('/assets/img/trans.png') }}">
			<source src="{{ url('/assets/video/video-res.mp4') }}" type="video/mp4">
		</video>
	</div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $page->content('hero_title', 'Restaurant') }}</div>
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
				<p class="color-white mt-3 mb-3"><em>our presentation, 0:48 min</em></p>
				<a href="{{ $page->content('video_url', 'https://vimeo.com/54851233') }}" class="video-button" data-fancybox=""><i class="fa fa-play"></i></a>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('features'))
<div class="section padding-top over-hide">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="services-box restaurant text-center">
					<img src="{{ url('/assets/img/res-1.png') }}" alt="">
					<h5 class="mt-3">High quality foods</h5>
					<p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam.</p>
					<a class="mt-1 btn btn-primary" href="{{ route('services') }}">read more</a>
				</div>
			</div>
			<div class="col-md-4 mt-5 mt-md-0">
				<div class="services-box restaurant text-center">
					<img src="{{ url('/assets/img/res-2.png') }}" alt="">
					<h5 class="mt-3">Inspiring recipes</h5>
					<p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam.</p>
					<a class="mt-1 btn btn-primary" href="{{ route('services') }}">read more</a>
				</div>
			</div>
			<div class="col-md-4 mt-5 mt-md-0">
				<div class="services-box restaurant text-center">
					<img src="{{ url('/assets/img/res-3.png') }}" alt="">
					<h5 class="mt-3">Salutary meals</h5>
					<p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam.</p>
					<a class="mt-1 btn btn-primary" href="{{ route('services') }}">read more</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('menu'))
<div class="section padding-top-bottom z-bigger">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $page->content('menu_subtitle', 'main dishes') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $page->content('menu_title', 'Our menu') }}</h3>
			</div>
			
			<!-- Search Box -->
			<div class="col-12 mb-4">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="search-box-wrapper" style="position: relative;">
							<input type="text" id="menuSearch" class="form-control" placeholder="Search menu items..." style="padding: 15px 50px 15px 20px; border-radius: 30px; border: 2px solid #c9a34e; font-size: 16px; background: rgba(255,255,255,0.05); color: #fff;">
							<button type="button" id="searchBtn" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: #c9a34e; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer;">
								<i class="fa fa-search" style="color: #000;"></i>
							</button>
						</div>
						<p id="searchResultsText" class="text-center mt-2" style="color: #c9a34e; font-size: 14px;"></p>
					</div>
				</div>
			</div>
			
			<div class="section clearfix"></div>
			<div class="col-12">
				<div class="row justify-content-center" id="menuItemsContainer">
			@forelse($menuItems as $index => $item)
			<div class="col-md-6 menu-item {{ $index > 1 ? 'mt-4' : ($index == 1 ? 'mt-4 mt-md-0' : '') }}" data-scroll-reveal="enter bottom move 50px over 0.7s after {{ 0.2 + ($index % 2) * 0.2 }}s" data-name="{{ strtolower($item->name) }}" data-description="{{ strtolower($item->description ?? '') }}">
				<div class="restaurant-box">
					<img src="@imgUrl($item->image, '/assets/img/food' . (($index % 4) + 1) . '.jpg')" alt="{{ $item->name }}">
					<h6><span>{{ $item->name }}</span></h6>
					<p><span>{{ $item->description ? Str::limit($item->description, 40) : 'Delicious dish' }}</span></p>
					<h5><span>{{ $siteSettings ? $siteSettings->formatPrice($item->price, 0) : '₦' . number_format($item->price, 0) }}</span></h5>
				</div>
			</div>
			@empty
			<!-- Fallback if no menu items in database -->
			<div class="col-md-6" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.2s">
				<div class="restaurant-box">
					<img src="{{ url('/assets/img/food1.jpg') }}" alt="">
					<h6><span>imported salmon steak</span></h6>
					<p><span>salmon / veggies / oil</span></p>
					<h5><span>₦3,200</span></h5>
				</div>
			</div>
			<div class="col-md-6 mt-4 mt-md-0" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.4s">
				<div class="restaurant-box">
					<img src="{{ url('/assets/img/food2.jpg') }}" alt="">
					<h6><span>tuna roast source</span></h6>
					<p><span>tuna / potatoes / rice</span></p>
					<h5><span>₦4,700</span></h5>
				</div>
			</div>
			<div class="col-md-6 mt-4" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.2s">
				<div class="restaurant-box">
					<img src="{{ url('/assets/img/food3.jpg') }}" alt="">
					<h6><span>salted fried chicken</span></h6>
					<p><span>chicken / olive oil / salt</span></p>
					<h5><span>₦2,600</span></h5>
				</div>
			</div>
			<div class="col-md-6 mt-4" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.4s">
				<div class="restaurant-box">
					<img src="{{ url('/assets/img/food4.jpg') }}" alt="">
					<h6><span>crab with curry sources</span></h6>
					<p><span>crab / potatoes / rice</span></p>
					<h5><span>₦6,400</span></h5>
				</div>
			</div>
			@endforelse
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const searchInput = document.getElementById('menuSearch');
	const searchBtn = document.getElementById('searchBtn');
	const resultsText = document.getElementById('searchResultsText');
	const menuItems = document.querySelectorAll('.menu-item');
	
	function filterMenu() {
		const filter = searchInput.value.toLowerCase().trim();
		let visibleCount = 0;
		const totalCount = menuItems.length;
		
		menuItems.forEach(item => {
			const name = item.getAttribute('data-name') || '';
			const description = item.getAttribute('data-description') || '';
			
			if (name.includes(filter) || description.includes(filter)) {
				item.style.display = '';
				visibleCount++;
			} else {
				item.style.display = 'none';
			}
		});
		
		if (filter === '') {
			resultsText.textContent = '';
		} else {
			resultsText.textContent = 'Showing ' + visibleCount + ' of ' + totalCount + ' items';
		}
	}
	
	searchInput.addEventListener('keyup', filterMenu);
	searchBtn.addEventListener('click', filterMenu);
});
</script>
@endif

@if($page->visible('booking'))
<div class="section padding-top-bottom-smaller background-dark over-hide z-too-big">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row justify-content-center">
						<div class="col-md-6 col-xl-4 px-sm-0">
							<div class="booking-sep-wrap">
								<div class="input-daterange input-group" id="flight-datepicker-1">
									<div class="form-item">
										<span class="fontawesome-calendar"></span>
										<input class="input-sm" type="text" autocomplete="off" id="start-date" name="start" placeholder="check-in" data-date-format="DD, MM d">
										<span class="date-text date-depart"></span>
									</div>
									<div class="form-item">
										<span class="fontawesome-calendar"></span>
										<input class="input-sm" type="text" autocomplete="off" id="end-date" name="end" placeholder="check-out" data-date-format="DD, MM d">
										<span class="date-text date-return"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-xl-2 px-sm-0">
							<div class="quantity">
								<input type="number" min="1" max="9999" step="1" value="1">
							</div>
						</div>
						<div class="col-md-3 col-xl-2 px-sm-0">
							<a class="booking-button-big" href="{{ route('search') }}">check<br>availability</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection