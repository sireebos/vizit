{{-- INTRO SECTION --}}
@if($home->visible('intro'))
<div class="section padding-top-bottom over-hide">
	<div class="container">
		<div class="row">
			<div class="col-md-6 align-self-center">
				<div class="row justify-content-center">
					<div class="col-10">
						<div class="subtitle text-center mb-4">{{ $home->content('intro_subtitle', 'hotel Thalia') }}</div>
						<h2 class="text-center">{{ $home->content('intro_title', 'Here is a tribute to good life!') }}</h2>
						<p class="text-center mt-5">{{ $home->content('intro_text', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.') }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-4 mt-md-0">
				<div class="img-wrap"> 
					<img src="@imgUrl($home->content('intro_image'), '/assets/img/rooms.png')" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
@endif
