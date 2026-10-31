@extends('layouts.site')

@section('title', $page->seo_title ?? ($siteSettings->site_name ?? 'Rooms Gallery'))

@section('content')
@if($page->visible('hero'))
<div class="section big-55-height over-hide">

	<div class="parallax parallax-top" style="background-image: url('@imgUrl($page->content('hero_image'), '/assets/img/rooms.jpg')')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $page->content('hero_title', 'Rooms Gallery') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('amenities'))
<div class="section background-dark padding-top-bottom-smaller over-hide">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center">
					<div class="amenities">
						<img src="{{ url('/assets/img/icons/1.svg') }}" alt="">
						<p>no smoking</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center">
					<div class="amenities">
						<img src="{{ url('/assets/img/icons/2.svg') }}" alt="">
						<p>big beds</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-md-0">
					<div class="amenities">
						<img src="{{ url('/assets/img/icons/3.svg') }}" alt="">
						<p>yacht riding</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0">
					<div class="amenities">
						<img src="{{ url('/assets/img/icons/4.svg') }}" alt="">
						<p>free drinks</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0">
					<div class="amenities">
						<img src="{{ url('/assets/img/icons/5.svg') }}" alt="">
						<p>swimming pool</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0">
					<div class="amenities">
						<img src="{{ url('/assets/img/icons/6.svg') }}" alt="">
						<p>room breakfast</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('gallery'))
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
							<div class="item">
								<img src="{{ url('/assets/img/gallery/2.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/3.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/4.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/5.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/6.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/7.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/8.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/9.jpg') }}" alt="">
							</div>
						</div>
					</div>
					<div class="section">
						<div id="rooms-sync2" class="owl-carousel">
							<div class="item">
								<img src="{{ url('/assets/img/gallery/2-s.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/3-s.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/4-s.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/5-s.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/6-s.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/7-s.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/8-s.jpg') }}" alt="">
							</div>
							<div class="item">
								<img src="{{ url('/assets/img/gallery/9-s.jpg') }}" alt="">
							</div>
						</div>
					</div>
					<div class="section pt-5">
						<h5>{{ $page->content('description_title', 'description') }}</h5>
						<p class="mt-3">{{ $page->content('description_text', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.') }}</p>
					</div>
					<div class="section pt-4">
						<div class="row">
							<div class="col-12">
								<h5 class="mb-3">Overview</h5>
							</div>
							<div class="col-lg-6">
								<p><strong class="color-black">Room size:</strong> 47 - 54 sq m</p>
								<p><strong class="color-black">Occupancy:</strong> Up to 4 adulds</p>
								<p><strong class="color-black">View:</strong> Sea view</p>
								<p><strong class="color-black">Smoking:</strong> No smoking</p>
							</div>
							<div class="col-lg-6">
								<p><strong class="color-black">Bed size:</strong> King and regular</p>
								<p><strong class="color-black">Location:</strong> Big room 2nd floor</p>
								<p><strong class="color-black">Room service:</strong> Yes</p>
								<p><strong class="color-black">Swimming pool:</strong> Yes</p>
							</div>
						</div>
					</div>
					<div class="section pt-4">
						<h5>Features</h5>
						<p class="mt-3">{{ $page->content('features_text', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.') }}</p>
					</div>
				</div>
				<div class="col-lg-4 order-first order-lg-last">
					<div class="section background-dark p-4">
						<div class="row">
							<div class="col-12">
								<div class="input-daterange input-group" id="flight-datepicker">
									<div class="row">
										<div class="col-12">
											<div class="form-item">
												<span class="fontawesome-calendar"></span>
												<input class="input-sm" type="text" autocomplete="off" id="start-date-1" name="start" placeholder="chech-in date" data-date-format="DD, MM d">
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
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
									<div class="col-12 pt-4">
										<select name="children" class="wide">
											<option data-display="children">children</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-12 pt-4">
								<a class="booking-button" href="{{ route('search') }}">book now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('more_rooms'))
<div class="section padding-bottom over-hide">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-4" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.2s">
				<div class="room-box background-grey">
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
						<a class="mt-1 btn btn-primary" href="{{ route('rooms.gallery') }}">book from ₦130,000</a>
						<div class="room-icons mt-4 pt-4">
							<img src="{{ url('/assets/img/5.svg') }}" alt="">
							<img src="{{ url('/assets/img/2.svg') }}" alt="">
							<img src="{{ url('/assets/img/3.svg') }}" alt="">
							<a href="{{ route('rooms.gallery') }}">full info</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mt-4 mt-lg-0" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.4s">
				<div class="room-box background-grey">
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
						<a class="mt-1 btn btn-primary" href="{{ route('rooms.gallery') }}">book from ₦80,000</a>
						<div class="room-icons mt-4 pt-4">
							<img src="{{ url('/assets/img/4.svg') }}" alt="">
							<img src="{{ url('/assets/img/2.svg') }}" alt="">
							<img src="{{ url('/assets/img/6.svg') }}" alt="">
							<a href="{{ route('rooms.gallery') }}">full info</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mt-4 mt-lg-0" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.6s">
				<div class="room-box background-grey">
					<div class="room-name">suite andrea</div>
					<div class="room-per">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
					<img src="{{ url('/assets/img/room5.jpg') }}" alt="">
					<div class="room-box-in">
						<h5 class="">Apartment</h5>
						<p class="mt-3">Sed ut perspiciatis unde omnis, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
						<a class="mt-1 btn btn-primary" href="{{ route('rooms.gallery') }}">book from ₦110,000</a>
						<div class="room-icons mt-4 pt-4">
							<img src="{{ url('/assets/img/5.svg') }}" alt="">
							<img src="{{ url('/assets/img/2.svg') }}" alt="">
							<img src="{{ url('/assets/img/3.svg') }}" alt="">
							<a href="{{ route('rooms.gallery') }}">full info</a>
						</div>
					</div>
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