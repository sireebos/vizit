<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $theme = \App\Models\ThemeSettings::instance();
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', ($settings->site_name ?? config('app.name', 'Laravel')))</title>
    <meta name="description" content="@yield('meta_description', ($settings->meta_description ?? ''))">

    <!-- Favicon -->
    @php
        $faviconPath = $siteSettings->site_favicon ?? $siteSettings->site_logo ?? null;
        $faviconMime = 'image/x-icon';
        if ($faviconPath) {
            $ext = strtolower(pathinfo($faviconPath, PATHINFO_EXTENSION));
            $faviconMime = match($ext) {
                'png' => 'image/png',
                'jpg', 'jpeg' => 'image/jpeg',
                'gif' => 'image/gif',
                'svg' => 'image/svg+xml',
                'webp' => 'image/webp',
                default => 'image/x-icon',
            };
        }
    @endphp
    @if($faviconPath)
    <link rel="icon" type="{{ $faviconMime }}" href="@imgUrl($faviconPath)">
    <link rel="shortcut icon" href="@imgUrl($faviconPath)">
    <link rel="apple-touch-icon" href="@imgUrl($faviconPath)">
    @else
    <link rel="icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">
    @endif

    <!-- Tailwind CSS (kept for now to avoid breaking existing simple views) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts - Dynamic based on theme -->
    <link href="https://fonts.googleapis.com/css2?family={{ urlencode($theme->heading_font) }}:wght@100;200;300;400;500;600;700;800;900&family={{ urlencode($theme->body_font) }}:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Theme CSS from resources/ (served via /assets) -->
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/colors/color.css') }}">

    <!-- Dynamic Theme Styles -->
    <style>
        :root {
            {!! $theme->getCssVariables() !!}
        }
        
        /* Apply theme colors */
        body {
            font-family: var(--body-font);
            color: var(--text-color);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font);
            color: var(--heading-color);
        }
        
        a {
            color: var(--link-color);
        }
        
        /* Primary color applications */
        .btn-primary, .booking-button-big, .booking-button {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        
        .btn-primary:hover, .booking-button-big:hover, .booking-button:hover {
            background-color: var(--button-hover-color) !important;
            border-color: var(--button-hover-color) !important;
        }
        
        .subtitle, .color-1 {
            color: var(--primary-color) !important;
        }
        
        .background-1 {
            background-color: var(--primary-color) !important;
        }
        
        /* Button styles */
        @if($theme->button_style == 'square')
        .btn, .booking-button-big, .booking-button {
            border-radius: 0 !important;
        }
        @elseif($theme->button_style == 'pill')
        .btn, .booking-button-big, .booking-button {
            border-radius: 50px !important;
        }
        @endif
        
        /* Layout style */
        @if($theme->layout_style == 'boxed')
        html {
            background-color: #e0e0e0;
        }
        body {
            max-width: 1400px;
            margin-left: auto !important;
            margin-right: auto !important;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: relative;
            background-color: #fff;
            overflow-x: hidden;
        }
        /* Constrain fixed header to boxed layout */
        .cbp-af-header, #menu-wrap, nav.menu-back {
            max-width: 1400px !important;
            left: 0 !important;
            right: 0 !important;
            margin-left: auto !important;
            margin-right: auto !important;
            transform: none !important;
        }
        .menu-top {
            max-width: 100%;
        }
        @endif
        
        /* Header styles */
        @if($theme->header_style == 'transparent')
        /* Transparent header - hide the top bar, transparent background */
        .menu-back {
            background: transparent !important;
        }
        .cbp-af-header {
            background: transparent !important;
        }
        .cbp-af-header .menu-top {
            display: none !important;
        }
        .cbp-af-header.cbp-af-header-shrink {
            background: rgba(21,21,21,.92) !important;
        }
        @elseif($theme->header_style == 'solid')
        /* Solid header - always dark background */
        .menu-back {
            background: var(--secondary-color) !important;
        }
        .cbp-af-header {
            background: var(--secondary-color) !important;
        }
        .cbp-af-header.cbp-af-header-shrink {
            background: var(--secondary-color) !important;
        }
        .menu-top.background-black {
            background-color: var(--primary-color) !important;
        }
        @else
        /* Default header style - dark with top bar */
        @endif
        
        /* Disable sticky header */
        @if(!$theme->sticky_header)
        .cbp-af-header {
            position: absolute !important;
        }
        .cbp-af-header.cbp-af-header-shrink {
            position: absolute !important;
            top: 0 !important;
        }
        body {
            padding-top: 0 !important;
        }
        @endif
        
        /* Footer colors */
        .footer, .footer-bottom, .background-black.footer {
            background-color: {{ $siteSettings->footer_bg_color ?? '#1a1a1a' }} !important;
        }
        
        /* Footer text color (address, about text, general paragraphs) */
        .footer p.color-grey, .footer .color-grey,
        .footer-bottom p {
            color: {{ $siteSettings->footer_text_color ?? '#888888' }} !important;
        }
        
        /* Footer heading color (Information, About Us titles) */
        .footer h6.color-white, .footer h6 {
            color: {{ $siteSettings->footer_heading_color ?? '#ffffff' }} !important;
        }
        
        /* Footer link color (menu links) */
        .footer a:not(.social-footer-bottom),
        .footer-bottom a.social-footer-bottom {
            color: {{ $siteSettings->footer_link_color ?? '#b59f6a' }} !important;
        }
        
        /* Header colors */
        .menu-back, .cbp-af-header, #menu-wrap {
            background-color: {{ $siteSettings->header_bg_color ?? '#1a2a3a' }} !important;
        }
        
        .cbp-af-header.cbp-af-header-shrink {
            background-color: {{ $siteSettings->header_bg_color ?? '#1a2a3a' }} !important;
        }
        
        .menu-top.background-black {
            background-color: {{ $siteSettings->header_bg_color ?? '#1a2a3a' }} !important;
        }
        
        #menu-wrap .menu ul li a, .menu ul li a, 
        .social-top, .menu-top a {
            color: {{ $siteSettings->header_text_color ?? '#ffffff' }} !important;
        }
        
        /* Phone number with yellow accent (like template) */
        a.call-top {
            color: var(--primary-color, #f7c51e) !important;
            font-weight: 500;
        }
        span.call-top {
            color: {{ $siteSettings->header_text_color ?? '#ffffff' }} !important;
        }
        
        /* Social links hover effect */
        .social-top:hover, a.call-top:hover {
            color: var(--primary-color, #f7c51e) !important;
        }
        
        /* Footer bottom section */
        .footer-bottom {
            background-color: {{ $siteSettings->footer_bg_color ?? '#1a2a3a' }} !important;
        }
        
        .background-dark.footer-bottom {
            background-color: #111c27 !important; /* Slightly darker than header */
        }
        
        /* Scroll buttons */
        .scroll-buttons {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .scroll-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: {{ $siteSettings->header_bg_color ?? '#000000' }};
            color: {{ $siteSettings->header_text_color ?? '#ffffff' }};
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            opacity: 0.8;
        }
        
        .scroll-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }
        
        /* Loader styles - dynamic */
        .loader {
            background-color: var(--loader-bg-color, #ffffff) !important;
        }
        .loader__figure {
            background-color: var(--reveal-color, #1a2a3a) !important;
        }
        @if($theme->loader_image)
        .loader__figure {
            background-image: url('{{ \App\Helpers\ImageHelper::url($theme->loader_image) }}') !important;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 80px !important;
            height: 80px !important;
            margin-left: -40px !important;
            margin-top: -40px !important;
            border-radius: 0 !important;
            background-color: transparent !important;
        }
        @endif
        
        /* Reveal effect color - dynamic */
        .block-revealer__element,
        .slide__figure-reveal {
            background-color: var(--reveal-color, #1a2a3a) !important;
        }
        
        /* Custom CSS from admin */
        {!! $theme->custom_css !!}
    </style>
    
    {{-- Custom Header Code (Google verification, analytics, etc.) --}}
    @if(!empty($siteSettings->custom_header_code))
    {!! $siteSettings->custom_header_code !!}
    @endif
    
    @stack('styles')
</head>
<body class="{{ $theme->layout_style == 'boxed' ? 'boxed-layout' : '' }}" data-sticky-header="{{ $theme->sticky_header ? 'true' : 'false' }}">
    @include('partials.site-header', ['theme' => $theme])

    <main class="min-h-[60vh]">
        @yield('content')
    </main>

    @include('partials.site-footer')
    <!-- JS from resources/ (served via /assets) -->
    <script src="{{ url('/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/assets/js/plugins.js') }}"></script>
    
    <!-- Set reveal color for RevealFx -->
    <script>
        window.REVEAL_COLOR = '{{ $theme->reveal_color ?? "#1a2a3a" }}';
    </script>
    
    <script src="{{ url('/assets/js/reveal-home.js') }}"></script>
    <script src="{{ url('/assets/js/custom.js') }}"></script>
    <script src="{{ url('/assets/js/move-img-effect.js') }}"></script>

    @if(!$theme->sticky_header)
    <script>
        // Disable sticky header behavior
        $(document).ready(function() {
            $(window).off('scroll.cbpAffHeader');
            $('.cbp-af-header').removeClass('cbp-af-header-shrink');
        });
    </script>
    @endif

    @if($siteSettings->show_scroll_buttons ?? true)
    <!-- Scroll to Top/Bottom Buttons -->
    <div class="scroll-buttons">
        <button class="scroll-btn" onclick="scrollToTop()" title="Scroll to Top">
            <i class="fa fa-arrow-up"></i>
        </button>
        <button class="scroll-btn" onclick="scrollToBottom()" title="Scroll to Bottom">
            <i class="fa fa-arrow-down"></i>
        </button>
    </div>
    <script>
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        function scrollToBottom() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }
        
        // Show/hide buttons based on scroll position
        window.addEventListener('scroll', function() {
            const buttons = document.querySelector('.scroll-buttons');
            if (buttons) {
                if (window.scrollY > 200) {
                    buttons.style.opacity = '1';
                } else {
                    buttons.style.opacity = '0.5';
                }
            }
        });
    </script>
    @endif

    @stack('scripts')

    {{-- Custom Footer Code (Chat widgets, tracking pixels, etc.) --}}
    @if(!empty($siteSettings->custom_footer_code))
    {!! $siteSettings->custom_footer_code !!}
    @endif

</body>
</html>

