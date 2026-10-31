{{-- FEATURES PAIR SECTION --}}
@if($home->visible('features_pair'))
<div class="section background-grey over-hide">
	<div class="container-fluid px-0">
		@php
			$featureCount = (int) $home->content('features_pair_count', 2);
			if ($featureCount < 1) $featureCount = 2;
		@endphp
		
		@for ($i = 1; $i <= $featureCount; $i++)
			@php
				$featureTitle = $home->content('feature'.$i.'_title', '');
				// Skip empty features
				if (empty($featureTitle)) continue;
				
				$featureImage = $home->content('feature'.$i.'_image', '/assets/img/room'.($i % 2 == 1 ? '1' : '2').'.jpg');
				$featureLabel = $home->content('feature'.$i.'_label', '');
				$featureText = $home->content('feature'.$i.'_text', '');
				$featurePrice = $home->content('feature'.$i.'_price', '');
				$featureButtonText = $home->content('feature'.$i.'_button_text', 'check availability');
				$featureButtonLink = $home->content('feature'.$i.'_button_link', '/search');
				$isOdd = ($i % 2 == 1);
			@endphp
			
			@if ($isOdd)
				{{-- Left Image Layout --}}
				<div class="row mx-0 {{ $i > 1 ? 'mt-5' : '' }}">
					<div class="col-xl-6 px-0">
						<div class="img-wrap" id="rev-{{ $i }}">
							<img src="@imgUrl($featureImage, '/assets/img/room1.jpg')" alt="{{ $featureTitle }}">
							@if ($featureLabel)
								<div class="text-element-over">{{ $featureLabel }}</div>
							@endif
						</div>
					</div>
					<div class="col-xl-6 px-0 mt-4 mt-xl-0 align-self-center">
						<div class="row justify-content-center">
							<div class="col-10 col-xl-8 text-center">
								<h3 class="text-center">{{ $featureTitle }}</h3>
								@if ($featurePrice)
									<p class="text-center mt-2 feature-price"><strong>₦{{ $featurePrice }}</strong> / night</p>
								@endif
								@if ($featureText)
									<p class="text-center mt-4">{{ $featureText }}</p>
								@endif
								<a class="mt-5 btn btn-primary" href="{{ $featureButtonLink }}">{{ $featureButtonText }}</a>
							</div>
						</div>
					</div>
				</div>
			@else
				{{-- Right Image Layout --}}
				<div class="row mx-0 mt-5">
					<div class="col-xl-6 px-0 mt-4 mt-xl-0 pb-5 pb-xl-0 align-self-center">
						<div class="row justify-content-center">
							<div class="col-10 col-xl-8 text-center">
								<h3 class="text-center">{{ $featureTitle }}</h3>
								@if ($featurePrice)
									<p class="text-center mt-2 feature-price"><strong>₦{{ $featurePrice }}</strong> / night</p>
								@endif
								@if ($featureText)
									<p class="text-center mt-4">{{ $featureText }}</p>
								@endif
								<a class="mt-5 btn btn-primary" href="{{ $featureButtonLink }}">{{ $featureButtonText }}</a>
							</div>
						</div>
					</div>
					<div class="col-xl-6 px-0 order-last order-xl-first mt-5 mt-xl-0">
						<div class="img-wrap" id="rev-{{ $i }}">
							<img src="@imgUrl($featureImage, '/assets/img/room2.jpg')" alt="{{ $featureTitle }}">
							@if ($featureLabel)
								<div class="text-element-over">{{ $featureLabel }}</div>
							@endif
						</div>
					</div>
				</div>
			@endif
		@endfor
	</div>
</div>
@endif
