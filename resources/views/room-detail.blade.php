@extends('layouts.site')

@section('title', $roomType->name . ' - ' . ($siteSettings->site_name ?? 'Hotel'))

@section('content')
<div class="section big-55-height over-hide">
	<div class="parallax parallax-top" style="background-image: url('{{ $roomType->main_image ?? url('/assets/img/rooms.jpg') }}')"></div>
	<div class="dark-over-pages"></div>
	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $roomType->name }}</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section background-dark padding-top-bottom-smaller over-hide">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				@if($roomType->amenities && count($roomType->amenities) > 0)
					@foreach(array_slice($roomType->amenities, 0, 6) as $amenity)
					<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center {{ $loop->index > 1 ? 'mt-4 mt-md-0' : '' }}">
						<div class="amenities">
							<img src="{{ url('/assets/img/icons/' . (($loop->index % 6) + 1) . '.svg') }}" alt="">
							<p>{{ $amenity }}</p>
						</div>
					</div>
					@endforeach
				@else
					<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center"><div class="amenities"><img src="{{ url('/assets/img/icons/1.svg') }}" alt=""><p>no smoking</p></div></div>
					<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center"><div class="amenities"><img src="{{ url('/assets/img/icons/2.svg') }}" alt=""><p>big beds</p></div></div>
					<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-md-0"><div class="amenities"><img src="{{ url('/assets/img/icons/3.svg') }}" alt=""><p>free wifi</p></div></div>
					<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0"><div class="amenities"><img src="{{ url('/assets/img/icons/4.svg') }}" alt=""><p>free drinks</p></div></div>
					<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0"><div class="amenities"><img src="{{ url('/assets/img/icons/5.svg') }}" alt=""><p>swimming pool</p></div></div>
					<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0"><div class="amenities"><img src="{{ url('/assets/img/icons/6.svg') }}" alt=""><p>room breakfast</p></div></div>
				@endif
			</div>
		</div>
	</div>
</div>

<div class="section padding-top-bottom z-bigger">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mt-4 mt-lg-0">
					<div class="section">
						<div class="customNavigation rooms-sinc-1-2">
							<a class="prev-rooms-sync-1"></a>
							<a class="next-rooms-sync-1"></a>
						</div>
						<div id="rooms-sync1" class="owl-carousel">
							@if($roomType->images && count($roomType->images) > 0)
								@foreach($roomType->images as $image)
								<div class="item"><img src="@imgUrl($image)" alt="{{ $roomType->name }}"></div>
								@endforeach
							@else
								<div class="item"><img src="{{ url('/assets/img/gallery/2.jpg') }}" alt=""></div>
							@endif
						</div>
					</div>
					@if($roomType->images && count($roomType->images) > 1)
					<div class="section">
						<div id="rooms-sync2" class="owl-carousel">
							@foreach($roomType->images as $image)
							<div class="item"><img src="@imgUrl($image)" alt="{{ $roomType->name }}"></div>
							@endforeach
						</div>
					</div>
					@endif
					<div class="section pt-5">
						<h5>Description</h5>
						<p class="mt-3">{{ $roomType->description ?? 'Experience comfort and luxury in our beautifully designed room.' }}</p>
					</div>
					<div class="section pt-4">
						<div class="row">
							<div class="col-12"><h5 class="mb-3">Overview</h5></div>
							<div class="col-lg-6">
								<p><strong class="color-black">Room size:</strong> {{ $roomType->size_sqft ? $roomType->size_sqft . ' sq ft' : 'Contact for details' }}</p>
								<p><strong class="color-black">Max Occupancy:</strong> Up to {{ $roomType->max_occupancy ?? 2 }} guests</p>
								<p><strong class="color-black">Max Adults:</strong> {{ $roomType->max_adults ?? 2 }}</p>
								<p><strong class="color-black">Max Children:</strong> {{ $roomType->max_children ?? 0 }}</p>
							</div>
							<div class="col-lg-6">
								<p><strong class="color-black">Price:</strong> From {{ $siteSettings ? $siteSettings->formatPrice($roomType->base_price, 0) : '₦' . number_format($roomType->base_price, 0) }}/night</p>
								<p><strong class="color-black">Rating:</strong> @for($i = 1; $i <= 5; $i++)<i class="fa fa-star{{ $i > ($roomType->stars ?? 5) ? '-o' : '' }}"></i>@endfor</p>
								<p><strong class="color-black">Room service:</strong> Yes</p>
								<p><strong class="color-black">Swimming pool:</strong> Yes</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 order-first order-lg-last">
					<div class="section background-dark p-4">
						<div class="row">
							<div class="col-12">
								<h5 class="text-white mb-3">Book This Room</h5>
								<p class="text-white-50 mb-3">Starting from <strong class="text-white">{{ $siteSettings ? $siteSettings->formatPrice($roomType->base_price, 0) : '₦' . number_format($roomType->base_price, 0) }}</strong>/night</p>
								<div class="input-daterange input-group" id="flight-datepicker">
									<div class="row">
										<div class="col-12">
											<div class="form-item">
												<span class="fontawesome-calendar"></span>
												<input class="input-sm" type="text" autocomplete="off" id="start-date-1" name="start" placeholder="check-in date" data-date-format="DD, MM d">
												<span class="date-text date-depart"></span>
											</div>
										</div>
										<div class="col-12 pt-4">
											<div class="form-item">
												<span class="fontawesome-calendar"></span>
												<input class="input-sm" type="text" autocomplete="off" id="end-date-1" name="end" placeholder="check-out date" data-date-format="DD, MM d">
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
											<option data-display="adults">adults</option>
											@for($i = 1; $i <= ($roomType->max_adults ?? 4); $i++)
											<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										</select>
									</div>
									<div class="col-12 pt-4">
										<select name="children" class="wide">
											<option data-display="children">children</option>
											@for($i = 0; $i <= ($roomType->max_children ?? 3); $i++)
											<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										</select>
									</div>
								</div>
							</div>
							<div class="col-12 pt-4">
								@php
									$bookUrl = $page->content('book_button_url') ?: route('search');
									$bookText = $page->content('book_button_text', 'book now');
									$bookNewTab = $page->content('book_button_new_tab') ? 'target="_blank" rel="noopener"' : '';
								@endphp
								<a class="booking-button" href="{{ $bookUrl }}" {!! $bookNewTab !!}>{{ $bookText }}</a>
				</div>
			</div>
		</div>
	</div>
</div>

@if($menuItems->count() > 0)
<div class="section padding-top-bottom over-hide background-grey">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 text-center">
				<h3 class="mb-2">Room Service Menu</h3>
				<p class="mb-5">Order delicious food directly to your room</p>
			</div>
		</div>
		<div class="row">
			@foreach($menuItems->take(6) as $item)
			<div class="col-md-6 col-lg-4 mb-4">
				<div class="background-white p-4 h-100">
					@if($item->image)
					<img src="@imgUrl($item->image)" alt="{{ $item->name }}" class="img-fluid mb-3" style="height: 200px; width: 100%; object-fit: cover;">
					@endif
					<h5>{{ $item->name }}</h5>
					<p class="text-muted small">{{ Str::limit($item->description, 80) }}</p>
					<div class="d-flex justify-content-between align-items-center mt-3">
						<span class="h5 mb-0 color-black">{{ $siteSettings ? $siteSettings->formatPrice($item->price, 0) : '₦' . number_format($item->price, 0) }}</span>
						<div>
							@if($item->is_vegetarian)<span class="badge badge-success">V</span>@endif
							@if($item->is_vegan)<span class="badge badge-info">VG</span>@endif
							@if($item->is_spicy)<span class="badge badge-danger">🌶️</span>@endif
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@if($menuItems->count() > 6)
		<div class="row mt-4">
			<div class="col-12 text-center">
				<a href="{{ route('restaurant') }}" class="btn btn-primary">View Full Menu</a>
			</div>
		</div>
		@endif
	</div>
</div>
@endif

@if($relatedRooms->count() > 0)
<div class="section padding-bottom over-hide">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-8 text-center">
				<h3>Other Rooms You May Like</h3>
			</div>
		</div>
		<div class="row justify-content-center">
			@foreach($relatedRooms as $index => $room)
			<div class="col-lg-4 {{ $index > 0 ? 'mt-4 mt-lg-0' : '' }}" data-scroll-reveal="enter bottom move 50px over 0.7s after {{ ($index + 1) * 0.2 }}s">
				<div class="room-box background-grey">
					<div class="room-name">{{ $room->name }}</div>
					<div class="room-per">
						@for($i = 1; $i <= 5; $i++)
							<i class="fa fa-star{{ $i > ($room->stars ?? 5) ? '-o' : '' }}"></i>
						@endfor
					</div>
					<img src="{{ $room->main_image ?? url('/assets/img/room3.jpg') }}" alt="{{ $room->name }}">
					<div class="room-box-in">
						<h5 class="">{{ $room->subtitle ?? 'Luxury Room' }}</h5>
						<p class="mt-3">{{ Str::limit($room->description, 80) }}</p>
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
			@endforeach
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

