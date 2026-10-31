@extends('layouts.site')

@section('title', $about->seo_title ?? ($settings->site_name ?? config('app.name', 'Laravel')))
@section('meta_description', $about->seo_description ?? ($settings->meta_description ?? ''))

@section('content')

@foreach($about->getOrderedSections() as $sectionKey)
    @if($about->visible($sectionKey))
        @switch($sectionKey)
            @case('hero')
                {{-- HERO SECTION --}}
                <div class="section big-55-height over-hide z-bigger">
                    <div id="poster_background-about" @if($about->content('hero_background')) style="background-image: url('{{ \App\Helpers\ImageHelper::url($about->content('hero_background')) }}');" @endif></div>
                    <div id="video-wrap" class="parallax-top">
                        <video id="video_background" preload="auto" autoplay="" loop="loop" muted="muted" poster="img/trans.png">
                            <source src="{{ $about->content('hero_video', 'video/video-about.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="dark-over-pages"></div>

                    <div class="hero-center-section pages">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 parallax-fade-top">
                                    <div class="hero-text">{{ $about->content('hero_title', 'About Us') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @break

            @case('video_presentation')
                {{-- VIDEO PRESENTATION SECTION --}}
                <div class="section padding-top-bottom-smaller background-dark-2 over-hide">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5 class="color-grey">{{ $about->content('video_subtitle', 'A new dimension of luxury.') }}</h5>
                                <p class="color-white mt-3 mb-3"><em>{{ $about->content('video_duration', 'our presentation, 0:48 min') }}</em></p>
                                <a href="{{ $about->content('video_link', 'https://vimeo.com/54851233') }}" class="video-button" data-fancybox=""><i class="fa fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @break

            @case('about_services')
                {{-- ABOUT SERVICES SECTION --}}
                <div class="section padding-top-bottom over-hide">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 align-self-center">
                                <div class="subtitle with-line text-center mb-4">{{ $about->content('about_services_subtitle', 'a bit about us') }}</div>
                                <h3 class="text-center padding-bottom-small">{{ $about->content('about_services_title', 'finest hotel') }}</h3>
                            </div>
                            <div class="section clearfix"></div>
                            @php $aboutServicesCount = $about->content('about_services_count', 3); @endphp
                            @for($i = 1; $i <= $aboutServicesCount; $i++)
                                @php
                                    $icon = $about->content("about_service{$i}_icon", url("/assets/img/" . (3 + $i) . ".svg"));
                                    $title = $about->content("about_service{$i}_title");
                                    $text = $about->content("about_service{$i}_text");
                                    $link = $about->content("about_service{$i}_link", '/services');
                                    $button = $about->content("about_service{$i}_button", 'read more');
                                @endphp
                                @if($title)
                                <div class="col-md-4 {{ $i > 1 ? 'mt-5 mt-md-0' : '' }}">
                                    <div class="services-box text-center">
                                        <img src="{{ $icon }}" alt="">
                                        <h5 class="mt-2">{{ $title }}</h5>
                                        <p class="mt-3">{{ $text }}</p>
                                        <a class="mt-1 btn btn-primary" href="{{ $link }}">{{ $button }}</a>
                                    </div>
                                </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                @break

            @case('history')
                {{-- HISTORY SECTION --}}
                <div class="section padding-top-bottom over-hide">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10 align-self-center">
                                <div class="subtitle with-line text-center mb-4">{{ $about->content('history_subtitle', 'our story') }}</div>
                                <h3 class="text-center padding-bottom-small">{{ $about->content('history_title', 'Our History') }}</h3>
                                <div class="history-content mt-4">
                                    {!! nl2br(e($about->content('history_content', 'Founded with a vision of providing exceptional hospitality, our hotel has grown from humble beginnings to become a landmark destination for travelers from around the world.

Over the years, we have continuously evolved to meet the changing needs of our guests while staying true to our core values of comfort, elegance, and personalized service.

Today, we stand proud as a testament to decades of dedication to hospitality excellence, welcoming guests to experience the perfect blend of traditional warmth and modern luxury.'))) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @break

            @case('features_pair')
                {{-- FEATURES PAIR SECTION --}}
                <div class="section background-grey over-hide">
                    <div class="container-fluid px-0">
                        <div class="row mx-0">
                            <div class="col-xl-6 px-0">
                                <div class="img-wrap" id="rev-1">
                                    <img src="@imgUrl($about->content('about_feature1_image'), '/assets/img/room1.jpg')" alt="">
                                    <div class="text-element-over">{{ $about->content('about_feature1_label', 'private pool suite') }}</div>
                                </div>
                            </div>
                            <div class="col-xl-6 px-0 mt-4 mt-xl-0 align-self-center">
                                <div class="row justify-content-center">
                                    <div class="col-10 col-xl-8 text-center">
                                        <h3 class="text-center">{{ $about->content('about_feature1_title', 'Private pool suite') }}</h3>
                                        <p class="text-center mt-4">{{ $about->content('about_feature1_text', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.') }}</p>
                                        <a class="mt-5 btn btn-primary" href="{{ $about->content('about_feature1_link', 'search.html') }}">{{ $about->content('about_feature1_button', 'check availability') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-xl-6 px-0 mt-4 mt-xl-0 pb-5 pb-xl-0 align-self-center">
                                <div class="row justify-content-center">
                                    <div class="col-10 col-xl-8 text-center">
                                        <h3 class="text-center">{{ $about->content('about_feature2_title', 'Sea view suite') }}</h3>
                                        <p class="text-center mt-4">{{ $about->content('about_feature2_text', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.') }}</p>
                                        <a class="mt-5 btn btn-primary" href="{{ $about->content('about_feature2_link', 'search.html') }}">{{ $about->content('about_feature2_button', 'check availability') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 px-0  order-xl-last mt-5 mt-xl-0">
                                <div class="img-wrap" id="rev-2">
                                    <img src="@imgUrl($about->content('about_feature2_image'), '/assets/img/room2.jpg')" alt="">
                                    <div class="text-element-over">{{ $about->content('about_feature2_label', 'sea view suite') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @break

            @case('quotes')
                {{-- QUOTES SECTION --}}
                <div class="section padding-top-bottom-big over-hide">
                    <div class="parallax" style="background-image: url('{{ $about->content('about_quotes_bg', url('/assets/img/5.jpg')) }}')"></div>
                    <div class="section z-bigger">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div id="owl-sep-1" class="owl-carousel owl-theme">
                                        @php $aboutQuotesCount = $about->content('about_quotes_count', 3); @endphp
                                        @for($i = 1; $i <= $aboutQuotesCount; $i++)
                                            @php
                                                $quoteText = $about->content("about_quote{$i}_text");
                                                $quoteAuthor = $about->content("about_quote{$i}_author");
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
                @break

            @case('services_grid')
                {{-- SERVICES GRID SECTION --}}
                <div class="section background-dark over-hide">
                    <div class="container-fluid py-4">
                        <div class="row">
                            @php $gridServicesCount = $about->content('about_grid_services_count', 4); @endphp
                            @for($i = 1; $i <= $gridServicesCount; $i++)
                                @php
                                    $title = $about->content("about_grid_service{$i}_title");
                                    $link = $about->content("about_grid_service{$i}_link", '/services');
                                    $image = $about->content("about_grid_service{$i}_image", "/assets/img/ser-{$i}.jpg");
                                    // Determine column classes based on total count
                                    $colClass = $gridServicesCount <= 3 ? 'col-sm-6 col-lg-4' : 'col-sm-6 col-lg-3';
                                    $ptClass = $i == 1 ? '' : ($i == 2 ? 'pt-4 pt-sm-0' : 'pt-4 pt-lg-0');
                                @endphp
                                @if($title)
                                <div class="{{ $colClass }} {{ $ptClass }}">
                                    <a href="{{ $link }}">
                                        <div class="img-wrap services-wrap">
                                            <img src="@imgUrl($image)" alt="{{ $title }}">
                                            <div class="services-text-over">{{ $title }}</div>
                                        </div>
                                    </a>
                                </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                @break
        @endswitch
    @endif
@endforeach
@endsection

