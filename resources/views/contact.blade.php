@extends('layouts.site')

@section('title', $contact->seo_title ?? ($siteSettings->site_name ?? config('app.name', 'Laravel')))
@section('meta_description', $contact->seo_description ?? '')

@section('content')

{{-- HERO SECTION --}}
@if($contact->visible('hero'))
<div class="section big-55-height over-hide z-bigger">
	<div class="parallax parallax-top" style="background-image: url('@imgUrl($contact->content('hero_image'), '/assets/img/gallery/10.jpg')')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $contact->content('hero_title', 'Get in Touch') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

{{-- VIDEO SECTION --}}
@if($contact->visible('video'))
<div class="section padding-top-bottom-smaller background-dark-2 over-hide">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h5 class="color-grey">{{ $contact->content('video_tagline', 'A new dimension of luxury.') }}</h5>
				<p class="color-white mt-3 mb-3"><em>{{ $contact->content('video_label', 'our presentation, 0:48 min') }}</em></p>
				<a href="{{ $contact->content('video_url', 'https://vimeo.com/54851233') }}" class="video-button" data-fancybox=""><i class="fa fa-play"></i></a>
			</div>
		</div>
	</div>
</div>
@endif

{{-- CONTACT FORM SECTION --}}
@if($contact->visible('contact_form'))
<div class="section padding-top z-bigger">
	<div class="container">
		<div class="row justify-content-center padding-bottom-smaller">
			<div class="col-md-8">
				<div class="subtitle with-line text-center mb-4">{{ $contact->content('form_subtitle', 'get in touch') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $contact->content('form_title', 'drop us a line') }}</h3>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-4 ajax-form">
				<input name="name" type="text" placeholder="Your Name: *" autocomplete="off">
			</div>
			<div class="col-md-4 mt-4 mt-md-0 ajax-form">
				<input name="email" type="text" placeholder="E-Mail: *" autocomplete="off">
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 mt-4 ajax-form">
				<textarea name="message" placeholder="Tell Us Everything"></textarea>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 mt-3 ajax-checkbox">
				<ul class="list">
					<li class="list__item">
						<label class="label--checkbox">
							<input type="checkbox" class="checkbox">
							collect my details through this form
						</label>
					</li>
				</ul>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 mt-3 ajax-form text-center">
				<button class="send_message" id="send" data-lang="en"><span>submit</span></button>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 padding-top-bottom">
				<div class="sep-line"></div>
			</div>
			@endif

			{{-- CONTACT INFO SECTION --}}
			@if($contact->visible('contact_info'))
			<div class="section clearfix"></div>
			<div class="col-md-6 col-lg-4">
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Address:</p>
					</div>
					<div class="address-in text-right">
						<p>{{ $contact->content('info_address', $siteSettings->footer_address ?? 'Benin City, Edo State, Nigeria') }}</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">City:</p>
					</div>
					<div class="address-in text-right">
						<p>{{ $contact->content('info_city', 'Benin City') }}</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Check-In:</p>
					</div>
					<div class="address-in text-right">
						<p>{{ $contact->content('info_checkin', '14:00 pm') }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Phone:</p>
					</div>
					<div class="address-in text-right">
						<p>{{ $contact->content('info_phone', $siteSettings->footer_phone ?? '+234 816 325 9205') }}</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Email:</p>
					</div>
					<div class="address-in text-right">
						<p>{{ $contact->content('info_email', $siteSettings->footer_email ?? 'info@vizithotel.com') }}</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Check-Out:</p>
					</div>
					<div class="address-in text-right">
						<p>{{ $contact->content('info_checkout', '11:00 am') }}</p>
					</div>
				</div>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 text-center mt-5" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.2s">
				<p class="mb-0"><em>available at: {{ $contact->content('info_hours', '8am - 10pm') }}</em></p>
				<h2 class="text-opacity">{{ $contact->content('info_phone', $siteSettings->footer_phone ?? '+965 1234 5678') }}</h2>
			</div>
		</div>
		@endif

		{{-- NEWSLETTER SECTION --}}
		@if($contact->visible('newsletter'))
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="subscribe-home">
					<input type="text" placeholder="your email here">
					<button data-lang="en">{{ $contact->content('newsletter_button', 'subscribe') }}</button>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

{{-- MAP SECTION --}}
@if($contact->visible('map'))
<div class="section over-hide">
	<iframe 
		src="{{ $contact->content('map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3477.123456789!2d47.9783!3d29.3759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjnCsDIyJzMzLjIiTiA0N8KwNTgnNDEuOSJF!5e0!3m2!1sen!2skw!4v1234567890') }}" 
		width="100%" 
		height="{{ $contact->content('map_height', '450') }}" 
		style="border:0;" 
		allowfullscreen="" 
		loading="lazy" 
		referrerpolicy="no-referrer-when-downgrade">
	</iframe>
</div>
@endif
	
@endsection

