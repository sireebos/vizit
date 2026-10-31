{{-- HERO SECTION --}}
@if($home->visible('hero'))
@php
    $heroType = $home->getHeroType();
    $heroSlides = $home->getHeroSlides();
    $sliderSpeed = $home->content('hero_slider_speed', 5000);
    $sliderEffect = $home->content('hero_slider_effect', 'fade');
    $showNav = $home->content('hero_slider_nav', '1') === '1';
    $showDots = $home->content('hero_slider_dots', '1') === '1';
    
    // Overlay settings
    $overlayColor = $home->content('hero_overlay_color', '#000000');
    $overlayOpacity = $home->content('hero_overlay_opacity', 30) / 100;
    $overlayBlend = $home->content('hero_overlay_blend', 'normal');
    $overlayGradient = $home->content('hero_overlay_gradient', 'none');
    $overlayPattern = $home->content('hero_overlay_pattern', 'none');
    $patternOpacity = $home->content('hero_pattern_opacity', 20) / 100;
    $overlayImage = $home->content('hero_overlay_image');
    
    // Ken Burns effect check
    $isKenBurns = $sliderEffect === 'kenburns';
    $isZoomOut = $sliderEffect === 'zoomOut';
@endphp

@if($heroType === 'slider' && count($heroSlides) > 0)
{{-- CAROUSEL/SLIDER HERO --}}
<div class="section hero-full-height over-hide hero-slider-wrapper {{ $isKenBurns ? 'kenburns-mode' : '' }} {{ $isZoomOut ? 'zoomout-mode' : '' }}">
    <div id="hero-carousel" class="owl-carousel hero-carousel" data-effect="{{ $sliderEffect }}">
        @foreach($heroSlides as $index => $slide)
        <div class="hero-slide" data-index="{{ $index }}">
            <div class="hero-slide-bg {{ $isKenBurns ? 'kenburns-bg' : '' }} {{ $isZoomOut ? 'zoomout-bg' : '' }}" style="background-image: url('{{ \App\Helpers\ImageHelper::url($slide['image'], '/assets/img/move-img.jpg') }}');"></div>
            <div class="hero-overlay" style="background-color: {{ $overlayColor }}; opacity: {{ $overlayOpacity }}; mix-blend-mode: {{ $overlayBlend }};"></div>
            @if($overlayGradient !== 'none')
            <div class="hero-gradient-overlay hero-gradient-{{ $overlayGradient }}" style="--overlay-color: {{ $overlayColor }};"></div>
            @endif
            @if($overlayPattern !== 'none')
            <div class="hero-pattern-overlay hero-pattern-{{ $overlayPattern }}" style="opacity: {{ $patternOpacity }}; @if($overlayPattern === 'custom' && $overlayImage) background-image: url('{{ \App\Helpers\ImageHelper::url($overlayImage) }}'); @endif"></div>
            @endif
            <div class="hero-center-section ver-2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 parallax-fade-top">
                            @if(!empty($slide['subtitle']))
                            <div class="hero-subtitle">{{ $slide['subtitle'] }}</div>
                            @endif
                            <div class="hero-text-ver-2">
                                {!! !empty($slide['title']) ? $slide['title'] : $home->content('hero_title', 'For the Joy<br>of Life') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($showNav && count($heroSlides) > 1)
    <div class="hero-carousel-nav">
        <button class="hero-prev"><i class="fa fa-angle-left"></i></button>
        <button class="hero-next"><i class="fa fa-angle-right"></i></button>
    </div>
    @endif
</div>

<style>
.hero-slider-wrapper { position: relative; overflow: hidden; }
.hero-carousel .hero-slide {
    height: 100vh;
    position: relative;
    overflow: hidden;
}
.hero-carousel .hero-slide-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}
.hero-carousel .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}
.hero-carousel .hero-gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    pointer-events: none;
}
.hero-gradient-top-bottom {
    background: linear-gradient(to bottom, var(--overlay-color) 0%, transparent 50%, var(--overlay-color) 100%);
}
.hero-gradient-bottom-top {
    background: linear-gradient(to top, var(--overlay-color) 0%, transparent 60%);
}
.hero-gradient-left-right {
    background: linear-gradient(to right, var(--overlay-color) 0%, transparent 50%, var(--overlay-color) 100%);
}
.hero-gradient-radial {
    background: radial-gradient(circle at center, transparent 0%, var(--overlay-color) 100%);
}
.hero-gradient-radial-corner {
    background: radial-gradient(circle at bottom right, transparent 0%, var(--overlay-color) 70%);
}

/* Pattern Overlays */
.hero-pattern-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 3;
    pointer-events: none;
}
.hero-pattern-dots {
    background-image: radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px);
    background-size: 20px 20px;
}
.hero-pattern-lines {
    background-image: repeating-linear-gradient(
        45deg,
        rgba(255,255,255,0.1),
        rgba(255,255,255,0.1) 1px,
        transparent 1px,
        transparent 10px
    );
}
.hero-pattern-grid {
    background-image: 
        linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 50px 50px;
}
.hero-pattern-noise {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
}
.hero-pattern-custom {
    background-size: cover;
    background-position: center;
    background-repeat: repeat;
}

.hero-carousel .hero-center-section {
    position: relative;
    z-index: 5;
}
.hero-subtitle {
    font-size: 1.2rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #fff;
    margin-bottom: 1rem;
    opacity: 0.9;
}
.hero-carousel-nav {
    position: absolute;
    bottom: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 30px;
    z-index: 10;
    pointer-events: none;
}
.hero-carousel-nav button {
    width: 50px;
    height: 50px;
    border: 2px solid rgba(255,255,255,0.5);
    background: rgba(0,0,0,0.3);
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    transition: all 0.3s ease;
    pointer-events: auto;
}
.hero-carousel-nav button:hover {
    background: rgba(255,255,255,0.2);
    border-color: #fff;
}
.hero-carousel .owl-pagination {
    position: absolute;
    bottom: 30px;
    width: 100%;
    text-align: center;
    z-index: 10;
}
.hero-carousel .owl-page span {
    background: rgba(255,255,255,0.5);
}
.hero-carousel .owl-page.active span {
    background: #fff;
}

/* Ken Burns Effect (Video-like) */
.kenburns-mode .hero-slide-bg.kenburns-bg {
    animation: kenburns 20s ease-out infinite alternate;
    transform-origin: center center;
}
.kenburns-mode .owl-item:nth-child(2n) .kenburns-bg {
    animation-name: kenburns-alt;
    transform-origin: top left;
}
.kenburns-mode .owl-item:nth-child(3n) .kenburns-bg {
    animation-name: kenburns-zoom;
    transform-origin: bottom right;
}

@keyframes kenburns {
    0% { transform: scale(1) translate(0, 0); }
    100% { transform: scale(1.2) translate(-2%, -1%); }
}
@keyframes kenburns-alt {
    0% { transform: scale(1.1) translate(1%, 1%); }
    100% { transform: scale(1) translate(0, 0); }
}
@keyframes kenburns-zoom {
    0% { transform: scale(1); }
    100% { transform: scale(1.15) translate(1%, -1%); }
}

/* Zoom Out Effect */
.zoomout-mode .hero-slide-bg.zoomout-bg {
    animation: zoomout 15s ease-out forwards;
    transform: scale(1.3);
}
@keyframes zoomout {
    0% { transform: scale(1.3); }
    100% { transform: scale(1); }
}

/* Scale Up Transition */
.owl-carousel[data-effect="scaleUp"] .owl-item {
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.5s ease;
}
.owl-carousel[data-effect="scaleUp"] .owl-item.active {
    opacity: 1;
    transform: scale(1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof jQuery !== 'undefined' && jQuery.fn.owlCarousel) {
        var heroCarousel = jQuery("#hero-carousel");
        var effect = heroCarousel.data('effect') || 'fade';
        
        // Map custom effects to owl carousel transition styles
        var transitionStyle = 'fade';
        if (['fade', 'fadeUp', 'backSlide', 'goDown'].includes(effect)) {
            transitionStyle = effect;
        }
        
        heroCarousel.owlCarousel({
            navigation: false,
            pagination: {{ $showDots ? 'true' : 'false' }},
            transitionStyle: transitionStyle,
            slideSpeed: 500,
            paginationSpeed: 500,
            singleItem: true,
            autoPlay: {{ $sliderSpeed }},
            afterMove: function() {
                // Reset and restart Ken Burns animation on slide change
                @if($isKenBurns || $isZoomOut)
                var currentSlide = heroCarousel.find('.owl-item.active .hero-slide-bg');
                currentSlide.css('animation', 'none');
                setTimeout(function() {
                    currentSlide.css('animation', '');
                }, 10);
                @endif
            }
        });

        @if($showNav && count($heroSlides) > 1)
        jQuery(".hero-prev").click(function() {
            heroCarousel.trigger('owl.prev');
        });
        jQuery(".hero-next").click(function() {
            heroCarousel.trigger('owl.next');
        });
        @endif
    }
});
</script>

@else
{{-- DEFAULT SINGLE IMAGE HERO --}}
@php
    // Apply overlay to default hero too
    $overlayColor = $home->content('hero_overlay_color', '#000000');
    $overlayOpacity = $home->content('hero_overlay_opacity', 30) / 100;
    $overlayBlend = $home->content('hero_overlay_blend', 'normal');
    $overlayGradient = $home->content('hero_overlay_gradient', 'none');
    $overlayPattern = $home->content('hero_overlay_pattern', 'none');
    $patternOpacity = $home->content('hero_pattern_opacity', 20) / 100;
    $overlayImage = $home->content('hero_overlay_image');
@endphp
<div class="section hero-full-height over-hide">
	<div class="home-moving-image" style="background-image: url('{{ \App\Helpers\ImageHelper::url($home->content('hero_background'), '/assets/img/move-img.jpg') }}');"></div>
	<div class="dark-over-video" style="background-color: {{ $overlayColor }}; opacity: {{ $overlayOpacity }}; mix-blend-mode: {{ $overlayBlend }};"></div>
    @if($overlayGradient !== 'none')
    <div class="hero-gradient-overlay hero-gradient-{{ $overlayGradient }}" style="--overlay-color: {{ $overlayColor }}; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none;"></div>
    <style>
    .hero-gradient-top-bottom { background: linear-gradient(to bottom, var(--overlay-color) 0%, transparent 50%, var(--overlay-color) 100%); }
    .hero-gradient-bottom-top { background: linear-gradient(to top, var(--overlay-color) 0%, transparent 60%); }
    .hero-gradient-left-right { background: linear-gradient(to right, var(--overlay-color) 0%, transparent 50%, var(--overlay-color) 100%); }
    .hero-gradient-radial { background: radial-gradient(circle at center, transparent 0%, var(--overlay-color) 100%); }
    .hero-gradient-radial-corner { background: radial-gradient(circle at bottom right, transparent 0%, var(--overlay-color) 70%); }
    </style>
    @endif
    @if($overlayPattern !== 'none')
    <div class="hero-pattern-overlay hero-pattern-{{ $overlayPattern }}" style="opacity: {{ $patternOpacity }}; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; pointer-events: none; @if($overlayPattern === 'custom' && $overlayImage) background-image: url('{{ \App\Helpers\ImageHelper::url($overlayImage) }}'); background-size: cover; @endif"></div>
    <style>
    .hero-pattern-dots { background-image: radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 20px 20px; }
    .hero-pattern-lines { background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.1) 1px, transparent 1px, transparent 10px); }
    .hero-pattern-grid { background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 50px 50px; }
    .hero-pattern-noise { background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E"); }
    </style>
    @endif
	<div class="hero-center-section ver-2" style="position: relative; z-index: 5;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text-ver-2">{!! $home->content('hero_title', 'For the Joy<br>of Life') !!}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endif
