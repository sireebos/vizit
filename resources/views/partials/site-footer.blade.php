<div class="section padding-top z-bigger">
		<div class="container">
			<div class="row justify-content-center padding-bottom-smaller">
				<div class="col-md-10 col-lg-8">
					<div class="subtitle with-line text-center mb-4">{{ $siteSettings->footer_subtitle ?? 'get in touch' }}</div>
					<h3 class="text-center padding-bottom-small">{{ $siteSettings->footer_title ?? 'drop us a line' }}</h3>
				</div>
				<div class="section clearfix"></div>
				<div class="col-md-6 col-lg-5">
					<div class="address">
						<div class="address-in text-left">
							<p class="color-black">Address:</p>
						</div>
						<div class="address-in text-right">
							<p>{{ $siteSettings->footer_address ?? $settings->address ?? 'Benin City, Edo State, Nigeria' }}</p>
						</div>
					</div>
					<div class="address">
						<div class="address-in text-left">
							<p class="color-black">Email:</p>
						</div>
						<div class="address-in text-right">
							<p>{{ $siteSettings->footer_email ?? $settings->email ?? 'info@vizithotel.com' }}</p>
						</div>
					</div>
					<div class="address">
						<div class="address-in text-left">
							<p class="color-black">Check-In:</p>
						</div>
						<div class="address-in text-right">
							<p>{{ $siteSettings->check_in_time ?? $settings->check_in_time ?? '14:00 pm' }}</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="address">
						<div class="address-in text-left">
							<p class="color-black">Phone:</p>
						</div>
						<div class="address-in text-right">
							<p>{{ $siteSettings->footer_phone ?? $settings->phone ?? '+965 1234 5678' }}</p>
						</div>
					</div>
					<div class="address">
						<div class="address-in text-left">
							<p class="color-black">Website:</p>
						</div>
						<div class="address-in text-right">
							<p>{{ $siteSettings->footer_website ?? $siteSettings->site_name ?? $settings->site_name ?? 'Vizit Hotel & Suites' }}</p>
						</div>
					</div>
					<div class="address">
						<div class="address-in text-left">
							<p class="color-black">Check-Out:</p>
						</div>
						<div class="address-in text-right">
							<p>{{ $siteSettings->check_out_time ?? $settings->check_out_time ?? '11:00 am' }}</p>
						</div>
					</div>
				</div>
				<div class="section clearfix"></div>
				<div class="col-md-10 text-center mt-5" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.2s">
					<p class="mb-0"><em>available at: {{ $siteSettings->opening_hours ?? $settings->opening_hours ?? '8am - 10pm' }}</em></p>
					<h2 class="text-opacity">{{ $siteSettings->footer_phone ?? $settings->phone ?? '+965 1234 5678' }}</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8">
					@if($siteSettings->subscribe_show_section ?? true)
					@php
						$subStyle = $siteSettings->subscribe_style ?? 'classic';
						$subTitle = $siteSettings->subscribe_title ?? '';
						$subSubtitle = $siteSettings->subscribe_subtitle ?? '';
						$subPlaceholder = $siteSettings->subscribe_placeholder ?? 'your email here';
						$subBtnText = $siteSettings->subscribe_button ?? 'subscribe';
						
						// Input styling
						$inputBg = $siteSettings->subscribe_input_bg ?? '#212121';
						$inputText = $siteSettings->subscribe_input_text ?? '#ffffff';
						$inputBorder = $siteSettings->subscribe_input_border ?? '#333333';
						$inputRadius = $siteSettings->subscribe_input_border_radius ?? '0';
						
						// Button styling
						$btnBg = $siteSettings->subscribe_btn_bg ?? '#000000';
						$btnText = $siteSettings->subscribe_btn_text ?? '#ffffff';
						$btnHoverBg = $siteSettings->subscribe_btn_hover_bg ?? '#333333';
						$btnHoverText = $siteSettings->subscribe_btn_hover_text ?? '#ffffff';
						$btnRadius = $siteSettings->subscribe_btn_border_radius ?? '0';
						$btnIcon = $siteSettings->subscribe_btn_icon ?? '';
						$btnIconOnly = $siteSettings->subscribe_btn_icon_only ?? false;
						
						// Container styling
						$containerBg = $siteSettings->subscribe_container_bg ?? '#1a1a1a';
						$containerShadow = $siteSettings->subscribe_container_shadow ?? 'large';
						
						// Shadow mapping
						$shadows = [
							'none' => 'none',
							'small' => '0 2px 8px rgba(0,0,0,0.2)',
							'medium' => '0 4px 15px rgba(0,0,0,0.3)',
							'large' => '0 6px 25px rgba(0,0,0,0.6)',
							'glow' => '0 0 30px rgba(255,255,255,0.1)'
						];
						$shadow = $shadows[$containerShadow] ?? $shadows['large'];
						
						// Style-specific classes
						$styleClass = '';
						$inputExtraStyle = '';
						$btnExtraStyle = '';
						
						if ($subStyle === 'minimal') {
							$inputExtraStyle = 'background-color: transparent !important; border: none !important; border-bottom: 2px solid ' . $inputBorder . ' !important; border-radius: 0 !important;';
							$btnExtraStyle = 'background-color: transparent !important; border: 2px solid ' . $btnBg . ' !important;';
						} elseif ($subStyle === 'glassmorphism') {
							$styleClass = 'glassmorphism-subscribe';
							$inputExtraStyle = 'background: rgba(255,255,255,0.1) !important; backdrop-filter: blur(10px);';
						} elseif ($subStyle === 'gradient') {
							$btnExtraStyle = 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;';
						} elseif ($subStyle === 'pill') {
							$inputRadius = '50px';
							$btnRadius = '50px';
						}
					@endphp
					
					@if($subTitle || $subSubtitle)
					<div class="text-center mb-3">
						@if($subTitle)
						<div class="subscribe-title" style="color: #fff; font-size: 14px; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 5px;">{{ $subTitle }}</div>
						@endif
						@if($subSubtitle)
						<div class="subscribe-subtitle" style="color: #aaa; font-size: 13px;">{{ $subSubtitle }}</div>
						@endif
					</div>
					@endif
					
					<div class="subscribe-home subscribe-{{ $subStyle }} {{ $styleClass }}" style="background-color: {{ $containerBg }}; box-shadow: {{ $shadow }};">
						<input type="email" id="subscribe-email" placeholder="{{ $subPlaceholder }}" required 
							style="background-color: {{ $inputBg }}; color: {{ $inputText }}; border: 1px solid {{ $inputBorder }}; border-radius: {{ $inputRadius }}; {{ $inputExtraStyle }}">
						<button type="button" id="subscribe-btn" data-lang="en"
							style="background-color: {{ $btnBg }}; color: {{ $btnText }}; border-radius: {{ $btnRadius }}; {{ $btnExtraStyle }}"
							data-hover-bg="{{ $btnHoverBg }}" data-hover-text="{{ $btnHoverText }}" data-original-bg="{{ $btnBg }}" data-original-text="{{ $btnText }}">
							@if($btnIcon)<i class="fas {{ $btnIcon }} {{ !$btnIconOnly ? 'mr-1' : '' }}"></i>@endif
							@if(!$btnIconOnly){{ $subBtnText }}@endif
						</button>
					</div>
					<div id="subscribe-message" class="text-center mt-3" style="display: none;"></div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<script>
	// Subscribe button hover effects
	const subscribeBtn = document.getElementById('subscribe-btn');
	if (subscribeBtn) {
		const originalBg = subscribeBtn.dataset.originalBg;
		const originalText = subscribeBtn.dataset.originalText;
		const hoverBg = subscribeBtn.dataset.hoverBg;
		const hoverText = subscribeBtn.dataset.hoverText;
		const originalContent = subscribeBtn.innerHTML;

		subscribeBtn.addEventListener('mouseenter', function() {
			if (!this.disabled) {
				this.style.backgroundColor = hoverBg;
				this.style.color = hoverText;
			}
		});

		subscribeBtn.addEventListener('mouseleave', function() {
			if (!this.disabled) {
				this.style.backgroundColor = originalBg;
				this.style.color = originalText;
			}
		});

		subscribeBtn.addEventListener('click', function() {
			const email = document.getElementById('subscribe-email').value.trim();
			const btn = this;
			const msgDiv = document.getElementById('subscribe-message');

			if (!email) {
				msgDiv.innerHTML = '<span style="color: #dc3545;">Please enter your email address.</span>';
				msgDiv.style.display = 'block';
				return;
			}

			// Disable button
			btn.disabled = true;
			btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';

			fetch('/subscribe', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': '{{ csrf_token() }}',
					'Accept': 'application/json'
				},
				body: JSON.stringify({ email: email, source: 'footer' })
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					msgDiv.innerHTML = '<span style="color: #28a745;"><i class="fas fa-check-circle mr-1"></i>' + data.message + '</span>';
					document.getElementById('subscribe-email').value = '';
				} else {
					msgDiv.innerHTML = '<span style="color: #dc3545;"><i class="fas fa-exclamation-circle mr-1"></i>' + data.message + '</span>';
				}
				msgDiv.style.display = 'block';
			})
			.catch(error => {
				msgDiv.innerHTML = '<span style="color: #dc3545;"><i class="fas fa-exclamation-circle mr-1"></i>An error occurred. Please try again.</span>';
				msgDiv.style.display = 'block';
			})
			.finally(() => {
				btn.disabled = false;
				btn.innerHTML = originalContent;
				btn.style.backgroundColor = originalBg;
				btn.style.color = originalText;
			});
		});

		// Allow Enter key to submit
		document.getElementById('subscribe-email').addEventListener('keypress', function(e) {
			if (e.key === 'Enter') {
				subscribeBtn.click();
			}
		});
	}
	</script>

	<div class="section">
		<div id="owl-sep-2" class="owl-carousel owl-theme">
			@php
				$galleryImages = \App\Models\GalleryImage::active()->ordered()->limit(10)->get();
			@endphp
			@forelse($galleryImages as $image)
			<div class="item">
				<a href="@imgUrl($image->image_url)" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="@imgUrl($image->image_url)" alt="{{ $image->caption ?? '' }}">
					</div>
				</a>
			</div>
			@empty
			{{-- Fallback to default images if no gallery images exist --}}
			@for($i = 1; $i <= 10; $i++)
			<div class="item">
				<a href="{{ url('/assets/img/gallery/' . $i . '.jpg') }}" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{ url('/assets/img/gallery/' . $i . '-s.jpg') }}" alt="">
					</div>
				</a>
			</div>
			@endfor
			@endforelse
		</div>
	</div>

	<div class="section padding-top-bottom-small background-black over-hide footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3 text-center text-md-left">
					<img src="@imgUrl($siteSettings->site_logo, '/assets/img/logo.png')" alt="{{ $siteSettings->site_name ?? 'Logo' }}">
					<p class="color-grey mt-4">{!! nl2br(e($siteSettings->footer_address ?? $settings->address ?? 'Benin City, Edo State, Nigeria')) !!}</p>
				</div>
				<div class="col-md-4 text-center text-md-left">
					<h6 class="color-white mb-3">information</h6>
					@php
						$footerMenu = $siteSettings->footer_menu ? json_decode($siteSettings->footer_menu, true) : [
							['label' => 'terms & conditions', 'url' => '/tandc'],
							['label' => 'services', 'url' => '/services'],
							['label' => 'restaurant', 'url' => '/restaurant'],
							['label' => 'testimonials', 'url' => '#'],
							['label' => 'gallery & images', 'url' => '/rooms/gallery']
						];
					@endphp
					@foreach($footerMenu as $item)
					<a href="{{ url($item['url']) }}">{{ $item['label'] }}</a>
					@endforeach
				</div>
				<div class="col-md-5 mt-4 mt-md-0 text-center text-md-left logos-footer">
					<h6 class="color-white mb-3">about us</h6>
					<p class="color-grey mb-4">{{ $siteSettings->footer_about ?? $settings->site_description ?? 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.' }}</p>
					@php
						$logos = [
							$siteSettings->partner_logo_1 ?? '/assets/img/logos/1.png',
							$siteSettings->partner_logo_2 ?? '/assets/img/logos/2.png',
							$siteSettings->partner_logo_3 ?? '/assets/img/logos/3.png',
							$siteSettings->partner_logo_4 ?? null,
						];
					@endphp
					@foreach($logos as $logo)
						@if($logo)
						<img src="@imgUrl($logo)" alt="">
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="section py-4 background-dark over-hide footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
					<p>{{ $siteSettings->footer_copyright ?? date('Y') . ' © ' . ($siteSettings->site_name ?? $settings->site_name ?? 'Vizit Hotel & Suites') . '. All rights reserved.' }}</p>
				</div>
				<div class="col-md-6 text-center text-md-right">
					@if($siteSettings->social_booking ?? null)
					<a href="{{ $siteSettings->social_booking }}" class="social-footer-bottom" target="_blank">book now</a>
					@endif
					@if($siteSettings->social_instagram ?? $settings->instagram_url ?? null)
					<a href="{{ $siteSettings->social_instagram ?? $settings->instagram_url }}" class="social-footer-bottom" target="_blank">instagram</a>
					@endif
					@if($siteSettings->social_tiktok ?? null)
					<a href="{{ $siteSettings->social_tiktok }}" class="social-footer-bottom" target="_blank">tiktok</a>
					@endif
					@if($siteSettings->social_tripadvisor ?? null)
					<a href="{{ $siteSettings->social_tripadvisor }}" class="social-footer-bottom" target="_blank">tripadvisor</a>
					@endif
					@if($siteSettings->social_facebook ?? $settings->facebook_url ?? null)
					<a href="{{ $siteSettings->social_facebook ?? $settings->facebook_url }}" class="social-footer-bottom" target="_blank">facebook</a>
					@endif
					@if($siteSettings->social_twitter ?? $settings->twitter_url ?? null)
					<a href="{{ $siteSettings->social_twitter ?? $settings->twitter_url }}" class="social-footer-bottom" target="_blank">twitter</a>
					@endif
				</div>
			</div>
		</div>
	</div>


	<div class="scroll-to-top"></div>
