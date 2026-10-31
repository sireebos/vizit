{{-- VIDEO SECTION --}}
@if($home->visible('video'))
<div class="section padding-top-bottom-small background-dark-2 over-hide">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h5 class="color-grey">{{ $home->content('video_title', 'A new dimension of luxury.') }}</h5>
				<p class="color-white mt-3 mb-3"><em>{{ $home->content('video_subtitle', 'our presentation, 0:48 min') }}</em></p>
				<a href="{{ $home->content('video_url', 'https://vimeo.com/54851233') }}" class="video-button" data-fancybox=""><i class="fa fa-play"></i></a>
			</div>
		</div>
	</div>
</div>
@endif
