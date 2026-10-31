@extends('layouts.site')

@section('title', $siteSettings->site_name ?? 'Photo Gallery')

@section('content')
<div class="section big-55-height over-hide z-bigger">
	<div class="parallax parallax-top" style="background-image: url('{{ url('/assets/img/gallery/3.jpg') }}')"></div>
	<div class="dark-over-pages"></div>
	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">Photo Gallery</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section padding-top-bottom z-bigger">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-8 text-center">
				<div class="subtitle with-line mb-4">our moments</div>
				<h3>Explore Our Beautiful Spaces</h3>
			</div>
		</div>
		
		<div class="row">
			@forelse($images as $image)
			<div class="col-6 col-md-4 col-lg-3 mb-4">
				<a href="@imgUrl($image->image_url)" data-fancybox="gallery" data-caption="{{ $image->caption }}">
					<div class="gallery-thumb">
						<img src="@imgUrl($image->image_url)" alt="{{ $image->caption }}" class="img-fluid">
						<div class="gallery-overlay">
							<i class="fa fa-search-plus"></i>
						</div>
					</div>
				</a>
				@if($image->caption)
				<p class="text-center mt-2 small text-muted">{{ $image->caption }}</p>
				@endif
			</div>
			@empty
			{{-- Default gallery if no images in database --}}
			@for($i = 1; $i <= 12; $i++)
			<div class="col-6 col-md-4 col-lg-3 mb-4">
				<a href="{{ url('/assets/img/gallery/' . $i . '.jpg') }}" data-fancybox="gallery">
					<div class="gallery-thumb">
						<img src="{{ url('/assets/img/gallery/' . $i . '-s.jpg') }}" alt="Gallery Image {{ $i }}" class="img-fluid">
						<div class="gallery-overlay">
							<i class="fa fa-search-plus"></i>
						</div>
					</div>
				</a>
			</div>
			@endfor
			@endforelse
		</div>
	</div>
</div>

<style>
.gallery-thumb {
	position: relative;
	overflow: hidden;
	border-radius: 8px;
	aspect-ratio: 1;
}
.gallery-thumb img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform 0.3s ease;
}
.gallery-thumb:hover img {
	transform: scale(1.1);
}
.gallery-overlay {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: rgba(0,0,0,0.5);
	display: flex;
	align-items: center;
	justify-content: center;
	opacity: 0;
	transition: opacity 0.3s ease;
}
.gallery-thumb:hover .gallery-overlay {
	opacity: 1;
}
.gallery-overlay i {
	color: #fff;
	font-size: 24px;
}
</style>
@endsection

