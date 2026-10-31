@extends('layouts.site')

@section('title', $page->seo_title ?? ($siteSettings->site_name ?? 'Search'))

@section('content')
@if($page->visible('hero'))
<div class="section big-55-height over-hide z-bigger">

	<div class="parallax parallax-top" style="background-image: url('@imgUrl($page->content('hero_image'), '/assets/img/1.jpg')')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $page->content('hero_title', 'Search') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('search_results'))
<div class="section padding-top-bottom z-bigger">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mt-4 mt-lg-0">
					@if(isset($searchInfo) && $searchInfo['has_search'])
					<div class="alert alert-info mb-4" style="background-color: rgba(0, 123, 255, 0.1); border-color: #007bff; color: #333; border-radius: 10px; padding: 15px 20px;">
						<strong><i class="fa fa-search"></i> Search Results:</strong> 
						@if($searchInfo['check_in'])
							Check-in: <strong>{{ $searchInfo['check_in'] }}</strong>
						@endif
						@if($searchInfo['check_out'])
							| Check-out: <strong>{{ $searchInfo['check_out'] }}</strong>
						@endif
						@if($searchInfo['adults'] > 0)
							| Adults: <strong>{{ $searchInfo['adults'] }}</strong>
						@endif
						@if($searchInfo['children'] > 0)
							| Children: <strong>{{ $searchInfo['children'] }}</strong>
						@endif
						@if($searchInfo['max_price'])
							| Max Price: <strong>{{ $siteSettings ? $siteSettings->formatPrice($searchInfo['max_price'] * 1000, 0) : '₦' . number_format($searchInfo['max_price'] * 1000) }}</strong>
						@endif
						@if(isset($searchInfo['no_match_found']) && $searchInfo['no_match_found'])
							| <span style="color: #dc3545; font-weight: bold;"><i class="fa fa-exclamation-triangle"></i> No exact match - showing all available rooms</span>
						@elseif(isset($roomTypes))
							| Found <strong>{{ $roomTypes->count() }}</strong> room{{ $roomTypes->count() != 1 ? 's' : '' }}
						@endif
						<a href="{{ route('search') }}" class="btn btn-sm btn-outline-secondary float-right" style="margin-left: 15px;">Clear Search</a>
					</div>
					@endif
					
					<div class="row">
						@forelse($roomTypes ?? [] as $index => $room)
							<div class="col-lg-6 {{ $index > 1 ? 'mt-4' : ($index == 1 ? 'mt-4 mt-lg-0' : '') }}" @if($index > 1) data-scroll-reveal="enter bottom move 50px over 0.7s after {{ ($index - 1) * 0.2 }}s" @endif>
								<div class="room-box background-grey">
									<div class="room-name">{{ $room->name }}</div>
									<div class="room-per">
										@for($i = 1; $i <= 5; $i++)
											<i class="fa fa-star{{ $i > ($room->stars ?? 5) ? '-o' : '' }}"></i>
										@endfor
									</div>
									<img src="@imgUrl($room->main_image, '/assets/img/room3.jpg')" alt="{{ $room->name }}">
									<div class="room-box-in">
										<h5 class="">{{ $room->subtitle ?? 'Luxury Room' }}</h5>
										<p class="mt-3">{{ Str::limit($room->description, 100) ?? 'Experience comfort and luxury in our beautifully designed room.' }}</p>
										<a class="mt-1 btn btn-primary" href="{{ route('room.detail', $room->slug) }}">book from {{ $siteSettings ? $siteSettings->formatPrice($room->base_price, 0) : '₦' . number_format($room->base_price, 0) }}</a>
										<div class="room-icons mt-4 pt-4">
											<img src="{{ url('/assets/img/5.svg') }}" alt="">
											<img src="{{ url('/assets/img/2.svg') }}" alt="">
											<img src="{{ url('/assets/img/3.svg') }}" alt="">
											<a href="{{ route('room.detail', $room->slug) }}">full info</a>
										</div>
									</div>
								</div>
							</div>
						@empty
							<div class="col-12">
								<div class="alert alert-info text-center py-5" style="border-radius: 10px;">
									<i class="fa fa-bed fa-3x mb-3" style="color: #0c5460;"></i>
									<h4>No rooms available</h4>
									<p class="mb-0">Please check back later or contact us for assistance.</p>
								</div>
							</div>
						@endforelse
					</div>
				</div>
				<div class="col-lg-4 order-first order-lg-last">
					<form action="{{ route('search') }}" method="GET" id="search-form">
					<div class="section background-dark p-4">
						<div class="row">
							<div class="col-12">
								<div class="input-daterange input-group" id="flight-datepicker">
									<div class="row">
										<div class="col-12">
											<div class="form-item">
												<span class="fontawesome-calendar"></span>
												<input class="input-sm" type="text" autocomplete="off" id="start-date-1" name="check_in" placeholder="check-in date" data-date-format="DD, MM d" value="{{ request('check_in') }}">
												<span class="date-text date-depart"></span>
											</div>
										</div>
										<div class="col-12 pt-4">
											<div class="form-item">
												<span class="fontawesome-calendar"></span>
												<input class="input-sm" type="text" autocomplete="off" id="end-date-1" name="check_out" placeholder="check-out date" data-date-format="DD, MM d" value="{{ request('check_out') }}">
												<span class="date-text date-return"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<div class="col-12 pt-4">
										<select name="adults" class="wide">
											<option value="" data-display="adults">adults</option>
											<option value="1" {{ request('adults') == '1' ? 'selected' : '' }}>1</option>
											<option value="2" {{ request('adults') == '2' ? 'selected' : '' }}>2</option>
											<option value="3" {{ request('adults') == '3' ? 'selected' : '' }}>3</option>
											<option value="4" {{ request('adults') == '4' ? 'selected' : '' }}>4</option>
											<option value="5" {{ request('adults') == '5' ? 'selected' : '' }}>5</option>
										</select>
									</div>
									<div class="col-12 pt-4">
										<select name="children" class="wide">
											<option value="" data-display="children">children</option>
											<option value="1" {{ request('children') == '1' ? 'selected' : '' }}>1</option>
											<option value="2" {{ request('children') == '2' ? 'selected' : '' }}>2</option>
											<option value="3" {{ request('children') == '3' ? 'selected' : '' }}>3</option>
											<option value="4" {{ request('children') == '4' ? 'selected' : '' }}>4</option>
											<option value="5" {{ request('children') == '5' ? 'selected' : '' }}>5</option>
										</select>
									</div>
								</div>
							</div>
							@php
								$minPriceK = isset($filterData) ? ceil($filterData['min_price'] / 1000) : 10;
								$maxPriceK = isset($filterData) ? ceil($filterData['max_price'] / 1000) : 500;
								$currentMaxPrice = request('max_price', $maxPriceK);
								$currencySymbol = $siteSettings->currency_symbol ?? '₦';
							@endphp
							<div class="col-12 pt-5">
								<h6 class="color-white mb-3">Max night price:</h6>
								<div class="selecteurPrix">
									<div class="range-slider">
										<input class="input-range" type="range" name="max_price" value="{{ $currentMaxPrice }}" min="{{ $minPriceK }}" max="{{ $maxPriceK }}" data-currency="{{ $currencySymbol }}">
										<div class="valeurPrix">
											<span class="range-value">{{ $currencySymbol }}{{ number_format($currentMaxPrice * 1000) }}</span>
										</div>
									</div>
								</div>
								<div class="d-flex justify-content-between mt-2">
									<small class="color-white">{{ $currencySymbol }}{{ number_format($minPriceK * 1000) }}</small>
									<small class="color-white">{{ $currencySymbol }}{{ number_format($maxPriceK * 1000) }}</small>
								</div>
							</div>
							@if(isset($filterData) && !empty($filterData['amenities']))
							<div class="col-12 col-md-6 col-lg-12 pt-5">
								<h6 class="color-white mb-3">Amenities & Services:</h6>
								<ul class="list">
									@foreach($filterData['amenities'] as $amenity)
									<li class="list__item">
										<label class="label--checkbox">
											<input type="checkbox" class="checkbox" name="amenities[]" value="{{ $amenity }}" {{ is_array(request('amenities')) && in_array($amenity, request('amenities')) ? 'checked' : '' }}>
											{{ $amenity }}
										</label>
									</li>
									@endforeach
								</ul>
							</div>
							@else
							<div class="col-12 col-md-6 col-lg-12 pt-5">
								<h6 class="color-white mb-3">Amenities:</h6>
								<p class="color-white small">No amenities available</p>
							</div>
							@endif
							<div class="col-12 pt-4">
								<button type="submit" class="booking-button w-100" style="border: none; cursor: pointer;">Search Rooms</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

<div class="section background-dark over-hide">
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-1.jpg') }}" alt="">
						<div class="services-text-over">spa salon</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 pt-4 pt-sm-0">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-2.jpg') }}" alt="">
						<div class="services-text-over">restaurant</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 pt-4 pt-lg-0">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-3.jpg') }}" alt="">
						<div class="services-text-over">pool</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 pt-4 pt-lg-0">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-4.jpg') }}" alt="">
						<div class="services-text-over">activities</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Update range slider to show dynamic currency format
    var range = $('#search-form .input-range'),
        value = $('#search-form .range-value'),
        currency = range.data('currency') || '₦';
    
    function formatPrice(val) {
        return currency + Number(val * 1000).toLocaleString();
    }
    
    // Initial value
    if (range.length) {
        value.html(formatPrice(range.val()));
        
        range.on('input', function() {
            value.html(formatPrice(this.value));
        });
    }
});
</script>
@endpush