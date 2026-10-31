@extends('layouts.site')

@section('title', $page->seo_title ?? ($siteSettings->site_name ?? 'Our Rooms'))

@section('content')
@if($page->visible('hero'))
<div class="section big-55-height over-hide z-bigger">

	<div class="parallax parallax-top" style="background-image: url('@imgUrl($page->content('hero_image'), '/assets/img/rooms.jpg')')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $page->content('hero_title', 'Our Rooms') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('booking_form'))
<div class="section padding-top-bottom-smaller background-dark over-hide z-too-big">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form action="{{ route('rooms') }}" method="GET" id="rooms-booking-form">
					<div class="row justify-content-center">
						<div class="col-md-6 col-xl-4 px-sm-0">
							<div class="booking-sep-wrap">
								<div class="input-daterange input-group" id="flight-datepicker-1">
									<div class="form-item">
										<span class="fontawesome-calendar"></span>
										<input class="input-sm" type="text" autocomplete="off" id="start-date" name="check_in" placeholder="check-in" data-date-format="DD, MM d" value="{{ request('check_in') }}">
										<span class="date-text date-depart"></span>
									</div>
									<div class="form-item">
										<span class="fontawesome-calendar"></span>
										<input class="input-sm" type="text" autocomplete="off" id="end-date" name="check_out" placeholder="check-out" data-date-format="DD, MM d" value="{{ request('check_out') }}">
										<span class="date-text date-return"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-xl-2 px-sm-0">
							<div class="quantity">
								<input type="number" name="guests" min="1" max="9999" step="1" value="{{ request('guests', 1) }}">
							</div>
						</div>
						<div class="col-md-3 col-xl-2 px-sm-0">
							<button type="submit" class="booking-button-big" style="border: none; cursor: pointer; width: 100%;">check<br>availability</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('rooms_list'))
<div class="section padding-top-bottom over-hide background-grey">
	<div class="container">
		@if(isset($searchInfo) && $searchInfo['has_search'])
		<div class="row justify-content-center mb-4">
			<div class="col-12">
				<div class="alert alert-info" style="background-color: rgba(0, 123, 255, 0.1); border-color: #007bff; color: #333; border-radius: 10px; padding: 15px 20px;">
					<strong><i class="fa fa-search"></i> Search Results:</strong> 
					@if($searchInfo['check_in'])
						Check-in: <strong>{{ $searchInfo['check_in'] }}</strong>
					@endif
					@if($searchInfo['check_out'])
						| Check-out: <strong>{{ $searchInfo['check_out'] }}</strong>
					@endif
					@if($searchInfo['guests'] > 1)
						| Guests: <strong>{{ $searchInfo['guests'] }}</strong>
					@endif
					@if(isset($searchInfo['no_match_found']) && $searchInfo['no_match_found'])
						| <span style="color: #dc3545; font-weight: bold;"><i class="fa fa-exclamation-triangle"></i> No exact match - showing all available rooms</span>
					@else
						| Found <strong>{{ $roomTypes->count() }}</strong> available room{{ $roomTypes->count() > 1 ? 's' : '' }}
					@endif
					<a href="{{ route('rooms') }}" class="btn btn-sm btn-outline-secondary float-right" style="margin-left: 15px;">Clear Search</a>
				</div>
			</div>
		</div>
		@endif
		<div class="row justify-content-center">
			@forelse($roomTypes as $index => $room)
			<div class="col-md-6 {{ $index > 1 ? 'mt-4' : ($index == 1 ? 'mt-4 mt-md-0' : '') }}" @if($index > 1) data-scroll-reveal="enter bottom move 50px over 0.7s after {{ ($index - 1) * 0.2 }}s" @endif>
				<div class="room-box background-white">
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
							<img src="{{ url('/assets/img/1.svg') }}" alt="">
							<a href="{{ route('room.detail', $room->slug) }}">full info</a>
						</div>
					</div>
				</div>
			</div>
			@empty
			<!-- Default rooms if no room types exist -->
			<div class="col-md-6">
				<div class="room-box background-white">
					<div class="room-name">suite tanya</div>
					<div class="room-per">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
					<img src="{{ url('/assets/img/room3.jpg') }}" alt="">
					<div class="room-box-in">
						<h5 class="">pool suite</h5>
						<p class="mt-3">Sed ut perspiciatis unde omnis, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
						<a class="mt-1 btn btn-primary" href="{{ route('rooms.gallery') }}">book from 130$</a>
						<div class="room-icons mt-4 pt-4">
							<img src="{{ url('/assets/img/5.svg') }}" alt="">
							<img src="{{ url('/assets/img/2.svg') }}" alt="">
							<img src="{{ url('/assets/img/3.svg') }}" alt="">
							<img src="{{ url('/assets/img/1.svg') }}" alt="">
							<a href="{{ route('rooms.gallery') }}">full info</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-4 mt-md-0">
				<div class="room-box background-white">
					<div class="room-name">suite helen</div>
					<div class="room-per">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o"></i>
					</div>
					<img src="{{ url('/assets/img/room4.jpg') }}" alt="">
					<div class="room-box-in">
						<h5 class="">small room</h5>
						<p class="mt-3">Sed ut perspiciatis unde omnis, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
						<a class="mt-1 btn btn-primary" href="{{ route('rooms.gallery') }}">book from 80$</a>
						<div class="room-icons mt-4 pt-4">
							<img src="{{ url('/assets/img/4.svg') }}" alt="">
							<img src="{{ url('/assets/img/2.svg') }}" alt="">
							<img src="{{ url('/assets/img/6.svg') }}" alt="">
							<img src="{{ url('/assets/img/3.svg') }}" alt="">
							<a href="{{ route('rooms.gallery') }}">full info</a>
						</div>
					</div>
				</div>
			</div>
			@endforelse
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