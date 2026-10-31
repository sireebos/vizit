<div class="loader">
    <div class="loader__figure"></div>
</div>

<svg class="hidden">
    <svg id="icon-nav" viewbox="0 0 152 63">
        <title>navarrow</title>
        <path d="M115.737 29L92.77 6.283c-.932-.92-1.21-2.84-.617-4.281.594-1.443 1.837-1.862 2.765-.953l28.429 28.116c.574.57.925 1.557.925 2.619 0 1.06-.351 2.046-.925 2.616l-28.43 28.114c-.336.327-.707.486-1.074.486-.659 0-1.307-.509-1.69-1.437-.593-1.442-.315-3.362.617-4.284L115.299 35H3.442C2.032 35 .89 33.656.89 32c0-1.658 1.143-3 2.552-3H115.737z"></path>
    </svg>
</svg>

<!-- Nav and Logo ================================================== -->
@php
    $themeSettings = $theme ?? \App\Models\ThemeSettings::instance();
@endphp
<nav id="menu-wrap" class="menu-back cbp-af-header">
    @if($themeSettings->show_top_bar)
    <div class="menu-top background-black">
        <div class="container">
            <div class="row">
                <div class="col-6 px-0 px-md-3 pl-1 py-3">
                    <span class="call-top">call us:</span>
                    <a href="tel:{{ preg_replace('/\D+/', '', $siteSettings->header_phone ?? $settings->phone ?? '') }}" class="call-top">{{ $siteSettings->header_phone ?? $settings->phone ?? '+965 1234 5678' }}</a>
                </div>
                <div class="col-6 px-0 px-md-3 py-3 text-right">
                    @if($siteSettings->social_booking ?? null)
                    <a href="{{ $siteSettings->social_booking }}" class="social-top" target="_blank">book</a>
                    @endif
                    @if($siteSettings->social_instagram ?? $settings->instagram_url ?? null)
                    <a href="{{ $siteSettings->social_instagram ?? $settings->instagram_url }}" class="social-top" target="_blank">ig</a>
                    @endif
                    @if($siteSettings->social_tiktok ?? null)
                    <a href="{{ $siteSettings->social_tiktok }}" class="social-top" target="_blank">tk</a>
                    @endif
                    @if($siteSettings->social_facebook ?? $settings->facebook_url ?? null)
                    <a href="{{ $siteSettings->social_facebook ?? $settings->facebook_url }}" class="social-top" target="_blank">fb</a>
                    @endif
                    @if($siteSettings->social_twitter ?? $settings->twitter_url ?? null)
                    <a href="{{ $siteSettings->social_twitter ?? $settings->twitter_url }}" class="social-top" target="_blank">tw</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="menu">
        <a href="{{ route('home') }}">
            <div class="logo">
                <img src="@imgUrl($siteSettings->site_logo, '/assets/img/logo.png')" alt="{{ $siteSettings->site_name ?? $settings->site_name ?? 'Logo' }}">
            </div>
        </a>
        @php
            $headerMenu = $siteSettings->header_menu ? json_decode($siteSettings->header_menu, true) : [
                ['label' => 'home', 'url' => '/', 'submenu' => []],
                ['label' => 'rooms', 'url' => '/rooms', 'submenu' => [
                    ['label' => 'Our Rooms', 'url' => '/rooms'],
                    ['label' => 'Room Gallery', 'url' => '/rooms/gallery']
                ]],
                ['label' => 'pages', 'url' => '#', 'submenu' => [
                    ['label' => 'Explore', 'url' => '/explore'],
                    ['label' => 'Search', 'url' => '/search'],
                    ['label' => 'Terms & Conditions', 'url' => '/tandc'],
                    ['label' => 'Services', 'url' => '/services'],
                    ['label' => 'Restaurant', 'url' => '/restaurant']
                ]],
                ['label' => 'about us', 'url' => '/about'],
                ['label' => 'contact', 'url' => '/contact'],
                ['label' => 'book now', 'url' => '/search', 'highlight' => true]
            ];
        @endphp
        <ul>
            @foreach($headerMenu as $item)
            <li>
                @php
                    $isActive = request()->is(ltrim($item['url'], '/')) || request()->is(ltrim($item['url'], '/') . '/*');
                    if (!empty($item['submenu'])) {
                        foreach ($item['submenu'] as $sub) {
                            if (request()->is(ltrim($sub['url'], '/'))) {
                                $isActive = true;
                                break;
                            }
                        }
                    }
                @endphp
                <a class="{{ $isActive ? 'curent-page' : '' }}" href="{{ url($item['url']) }}">
                    @if(!empty($item['highlight']))<span>{{ $item['label'] }}</span>@else{{ $item['label'] }}@endif
                </a>
                @if(!empty($item['submenu']))
                <ul>
                    @foreach($item['submenu'] as $subItem)
                    <li><a href="{{ url($subItem['url']) }}">{{ $subItem['label'] }}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</nav>
