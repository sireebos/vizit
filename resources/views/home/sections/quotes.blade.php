{{-- QUOTES SECTION --}}
@if($home->visible('quotes'))
<div class="section padding-top-bottom-big over-hide">
	<div class="parallax" style="background-image: url('@imgUrl($home->content('quotes_bg'), '/assets/img/5.jpg')')"></div>
	<div class="section z-bigger">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div id="owl-sep-1" class="owl-carousel owl-theme">
						@php $quotesCount = $home->content('quotes_count', 3); @endphp
						@for($i = 1; $i <= $quotesCount; $i++)
							@php
								$quoteText = $home->content("quote{$i}_text");
								$quoteAuthor = $home->content("quote{$i}_author");
							@endphp
							@if($quoteText)
							<div class="item">
								<div class="quote-sep">
									<h4>"{{ $quoteText }}"</h4>
									<h6>{{ $quoteAuthor }}</h6>
								</div>
							</div>
							@endif
						@endfor
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
