<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - {{ $settings->site_name ?? config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: {{ $catalogSettings->primary_color }};
            --dark-bg: {{ $catalogSettings->background_color }};
            --card-bg: {{ $catalogSettings->card_bg_color }};
            --text-light: {{ $catalogSettings->text_color }};
            --text-muted: {{ $catalogSettings->muted_text_color }};
            --price-color: {{ $catalogSettings->price_color ?? $catalogSettings->primary_color }};
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--dark-bg) 0%, #0f0f23 100%);
            min-height: 100vh;
            color: var(--text-light);
        }
        
        .header-section {
            background: linear-gradient(135deg, var(--card-bg) 0%, var(--dark-bg) 100%);
            padding: 30px 20px;
            text-align: center;
            border-bottom: 3px solid var(--primary-color);
        }
        
        .logo-container {
            margin-bottom: 20px;
        }
        
        .logo-container img {
            max-height: 80px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }
        
        .logo-text {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .tagline {
            color: var(--text-muted);
            font-size: 1rem;
            margin-top: 10px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .contact-bar {
            background: rgba(0,0,0,0.3);
            padding: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            font-size: 0.9rem;
        }
        
        .contact-bar a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .contact-bar a:hover {
            color: var(--primary-color);
        }
        
        .contact-bar i {
            color: var(--primary-color);
            margin-right: 5px;
        }
        
        .category-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 30px 20px;
            background: rgba(0,0,0,0.2);
        }
        
        .category-tab {
            background: var(--card-bg);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 20px 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-light);
            min-width: 150px;
        }
        
        .category-tab:hover, .category-tab.active {
            border-color: var(--primary-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(181, 159, 106, 0.2);
            color: var(--text-light);
        }
        
        .category-tab i {
            font-size: 2rem;
            color: var(--primary-color);
            display: block;
            margin-bottom: 10px;
        }
        
        .category-tab .name {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .category-tab .count {
            background: var(--primary-color);
            color: #000;
            border-radius: 20px;
            padding: 2px 12px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-top: 8px;
            display: inline-block;
        }
        
        .content-section {
            padding: 30px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .section-title h2 {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        /* Grid View */
        .items-grid.grid-view {
            display: grid;
            grid-template-columns: repeat({{ $catalogSettings->items_per_row }}, 1fr);
            gap: 20px;
        }
        
        /* List View */
        .items-grid.list-view {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .items-grid.list-view .item-card {
            display: flex;
            flex-direction: row;
        }
        
        .items-grid.list-view .item-image {
            width: 150px;
            min-width: 150px;
            height: 120px;
        }
        
        .items-grid.list-view .item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        /* Compact View */
        .items-grid.compact-view {
            display: grid;
            grid-template-columns: repeat({{ $catalogSettings->items_per_row + 1 }}, 1fr);
            gap: 10px;
        }
        
        .items-grid.compact-view .item-card {
            border-radius: 10px;
        }
        
        .items-grid.compact-view .item-image {
            height: 100px;
        }
        
        .items-grid.compact-view .item-details {
            padding: 10px;
        }
        
        .items-grid.compact-view .item-name {
            font-size: 0.95rem;
        }
        
        .items-grid.compact-view .item-description {
            display: none;
        }
        
        .item-card {
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            color: var(--text-light);
            display: block;
        }
        
        .item-image {
            height: 180px;
            background: #2a2a4a;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .item-image i {
            font-size: 4rem;
            color: var(--primary-color);
            opacity: 0.5;
        }
        
        .item-details {
            padding: 15px;
        }
        
        .item-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        
        .item-description {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .item-price {
            color: var(--price-color);
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        .item-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--primary-color);
            color: #000;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .item-card-wrapper {
            position: relative;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .footer-section {
            background: var(--card-bg);
            padding: 20px;
            text-align: center;
            margin-top: 40px;
            border-top: 2px solid var(--primary-color);
        }
        
        .footer-section p {
            color: var(--text-muted);
            margin: 0;
        }
        
        .footer-section a {
            color: var(--primary-color);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .back-to-site {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary-color);
            color: #000;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transition: transform 0.3s;
            z-index: 1000;
        }
        
        .back-to-site:hover {
            transform: scale(1.1);
            color: #000;
        }

        @media (max-width: 1200px) {
            .items-grid.grid-view {
                grid-template-columns: repeat(3, 1fr);
            }
            .items-grid.compact-view {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 992px) {
            .items-grid.grid-view {
                grid-template-columns: repeat(2, 1fr);
            }
            .items-grid.compact-view {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .category-tab {
                min-width: 120px;
                padding: 15px 20px;
            }
            
            .category-tab i {
                font-size: 1.5rem;
            }
            
            .contact-bar {
                flex-direction: column;
                gap: 10px;
            }
            
            .items-grid.grid-view,
            .items-grid.compact-view {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .items-grid.list-view .item-card {
                flex-direction: column;
            }
            
            .items-grid.list-view .item-image {
                width: 100%;
                height: 150px;
            }
        }

        @media (max-width: 480px) {
            .items-grid.grid-view,
            .items-grid.compact-view {
                grid-template-columns: 1fr;
            }
        }
        
        /* Custom CSS from settings */
        {!! $catalogSettings->custom_css !!}
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header-section">
        <div class="logo-container">
            @if($siteSettings->site_logo ?? false)
                <img src="{{ \App\Helpers\ImageHelper::url($siteSettings->site_logo) }}" alt="{{ $settings->site_name ?? 'Hotel' }}">
            @else
                <div class="logo-text">{{ $settings->site_name ?? 'Vizit Hotel & Suites' }}</div>
            @endif
        </div>
        @if($catalogSettings->tagline)
        <p class="tagline">{{ $catalogSettings->tagline }}</p>
        @endif
    </div>
    
    <!-- Contact Bar -->
    @if($catalogSettings->show_contact_bar)
    <div class="contact-bar">
        @if($catalogSettings->show_phone && ($siteSettings->header_phone ?? false))
        <a href="tel:{{ $siteSettings->header_phone }}">
            <i class="fas fa-phone"></i> {{ $siteSettings->header_phone }}
        </a>
        @endif
        @if($catalogSettings->show_email && ($siteSettings->header_email ?? false))
        <a href="mailto:{{ $siteSettings->header_email }}">
            <i class="fas fa-envelope"></i> {{ $siteSettings->header_email }}
        </a>
        @endif
        @if($catalogSettings->show_address && ($siteSettings->header_address ?? false))
        <span>
            <i class="fas fa-map-marker-alt"></i> {{ $siteSettings->header_address }}
        </span>
        @endif
        @if($catalogSettings->show_website)
        <a href="{{ url('/') }}">
            <i class="fas fa-globe"></i> {{ request()->getHost() }}
        </a>
        @endif
    </div>
    @endif
    
    <!-- Category Tabs -->
    <div class="category-tabs">
        @if($catalogSettings->show_drinks_section)
        <a href="#drinks" class="category-tab {{ $catalogSettings->default_tab == 'drinks' ? 'active' : '' }}" data-tab="drinks">
            <i class="fas fa-glass-martini-alt"></i>
            <div class="name">Drinks</div>
            @if($catalogSettings->show_item_count)
            <span class="count">{{ $drinksCount }}</span>
            @endif
        </a>
        @endif
        @if($catalogSettings->show_food_section)
        <a href="#food" class="category-tab {{ $catalogSettings->default_tab == 'food' ? 'active' : '' }}" data-tab="food">
            <i class="fas fa-utensils"></i>
            <div class="name">Food</div>
            @if($catalogSettings->show_item_count)
            <span class="count">{{ $foodCount }}</span>
            @endif
        </a>
        @endif
        @if($catalogSettings->show_rooms_section)
        <a href="#rooms" class="category-tab {{ $catalogSettings->default_tab == 'rooms' ? 'active' : '' }}" data-tab="rooms">
            <i class="fas fa-bed"></i>
            <div class="name">Rooms</div>
            @if($catalogSettings->show_item_count)
            <span class="count">{{ $roomsCount }}</span>
            @endif
        </a>
        @endif
        @if($catalogSettings->show_qrcode_tab)
        <a href="{{ route('catalog.qrcode') }}" class="category-tab">
            <i class="fas fa-qrcode"></i>
            <div class="name">QR Code</div>
            <span class="count"><i class="fas fa-arrow-right"></i></span>
        </a>
        @endif
    </div>
    
    <!-- Search Box -->
    <div class="search-section" style="padding: 20px; background: rgba(0,0,0,0.2);">
        <div style="max-width: 600px; margin: 0 auto;">
            <div style="position: relative;">
                <input type="text" id="catalogSearch" placeholder="Search menu items..." 
                    style="width: 100%; padding: 15px 50px 15px 20px; border-radius: 30px; border: 2px solid var(--primary-color); font-size: 16px; background: var(--card-bg); color: var(--text-light);">
                <button type="button" id="searchBtn" 
                    style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: var(--primary-color); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer;">
                    <i class="fas fa-search" style="color: #000;"></i>
                </button>
            </div>
            <p id="searchResults" style="text-align: center; margin-top: 10px; color: var(--primary-color); font-size: 14px;"></p>
        </div>
    </div>
    
    <!-- Content Section -->
    <div class="content-section">
        <!-- Drinks Tab -->
        @if($catalogSettings->show_drinks_section)
        <div id="drinks" class="tab-content {{ $catalogSettings->default_tab == 'drinks' ? 'active' : '' }}">
            <div class="section-title">
                <h2><i class="fas fa-glass-martini-alt"></i> Drinks Menu</h2>
            </div>
            @if($drinks->count() > 0)
            <div class="items-grid {{ $catalogSettings->display_mode }}-view">
                @foreach($drinks as $drink)
                <div class="item-card catalog-item" data-name="{{ strtolower($drink->name) }}" data-description="{{ strtolower($drink->description ?? '') }}" data-category="drinks">
                    <div class="item-card-wrapper">
                        @if($catalogSettings->show_featured_badge && $drink->is_featured)
                        <span class="item-badge">Featured</span>
                        @endif
                        @if($catalogSettings->show_images)
                        <div class="item-image">
                            @if($drink->image)
                                <img src="{{ \App\Helpers\ImageHelper::url($drink->image) }}" alt="{{ $drink->name }}">
                            @else
                                <i class="fas fa-glass-martini-alt"></i>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $drink->name }}</div>
                        @if($catalogSettings->show_descriptions && $drink->description)
                        <div class="item-description">{{ $drink->description }}</div>
                        @endif
                        @if($catalogSettings->show_prices)
                        <div class="item-price">{{ $drink->formatted_price }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-glass-martini-alt"></i>
                <p>No drinks available at the moment.</p>
            </div>
            @endif
        </div>
        @endif
        
        <!-- Food Tab -->
        @if($catalogSettings->show_food_section)
        <div id="food" class="tab-content {{ $catalogSettings->default_tab == 'food' ? 'active' : '' }}">
            <div class="section-title">
                <h2><i class="fas fa-utensils"></i> Food Menu</h2>
            </div>
            @if($foods->count() > 0)
            <div class="items-grid {{ $catalogSettings->display_mode }}-view">
                @foreach($foods as $food)
                <div class="item-card catalog-item" data-name="{{ strtolower($food->name) }}" data-description="{{ strtolower($food->description ?? '') }}" data-category="food">
                    <div class="item-card-wrapper">
                        @if($catalogSettings->show_featured_badge && $food->is_featured)
                        <span class="item-badge">Featured</span>
                        @endif
                        @if($catalogSettings->show_images)
                        <div class="item-image">
                            @if($food->image)
                                <img src="{{ \App\Helpers\ImageHelper::url($food->image) }}" alt="{{ $food->name }}">
                            @else
                                <i class="fas fa-utensils"></i>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $food->name }}</div>
                        @if($catalogSettings->show_descriptions && $food->description)
                        <div class="item-description">{{ $food->description }}</div>
                        @endif
                        @if($catalogSettings->show_prices)
                        <div class="item-price">{{ $siteSettings->currency_symbol ?? '₦' }}{{ number_format($food->price, 2) }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-utensils"></i>
                <p>No food items available at the moment.</p>
            </div>
            @endif
        </div>
        @endif
        
        <!-- Rooms Tab -->
        @if($catalogSettings->show_rooms_section)
        <div id="rooms" class="tab-content {{ $catalogSettings->default_tab == 'rooms' ? 'active' : '' }}">
            <div class="section-title">
                <h2><i class="fas fa-bed"></i> Our Rooms</h2>
            </div>
            @if($rooms->count() > 0)
            <div class="items-grid {{ $catalogSettings->display_mode }}-view">
                @foreach($rooms as $room)
                <div class="item-card catalog-item" data-name="{{ strtolower($room->name) }}" data-description="{{ strtolower($room->short_description ?? $room->description ?? '') }}" data-category="rooms">
                    <div class="item-card-wrapper">
                        @if($catalogSettings->show_images)
                        <div class="item-image">
                            @if($room->featured_image)
                                <img src="{{ \App\Helpers\ImageHelper::url($room->featured_image) }}" alt="{{ $room->name }}">
                            @else
                                <i class="fas fa-bed"></i>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $room->name }}</div>
                        @if($catalogSettings->show_descriptions)
                        <div class="item-description">{{ $room->short_description ?? Str::limit($room->description, 80) }}</div>
                        @endif
                        @if($catalogSettings->show_prices)
                        <div class="item-price">{{ $siteSettings->currency_symbol ?? '₦' }}{{ number_format($room->base_price, 2) }}<small>/night</small></div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-bed"></i>
                <p>No rooms available at the moment.</p>
            </div>
            @endif
        </div>
        @endif
    </div>
    
    <!-- Footer -->
    @if($catalogSettings->show_footer)
    <div class="footer-section">
        <p>{{ $siteSettings->footer_copyright ?? '© ' . date('Y') . ' ' . ($settings->site_name ?? 'Vizit Hotel & Suites') . '. All rights reserved.' }}</p>
    </div>
    @endif
    
    <!-- Back to Site Button -->
    @if($catalogSettings->show_back_button)
    <a href="{{ url('/') }}" class="back-to-site" title="Back to Website">
        <i class="fas fa-home"></i>
    </a>
    @endif
    
    <script>
        // Tab switching functionality
        document.querySelectorAll('.category-tab[data-tab]').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTab = this.getAttribute('data-tab');
                
                // Update active tab
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Show target content
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
                document.getElementById(targetTab).classList.add('active');
                
                // Clear search when switching tabs
                document.getElementById('catalogSearch').value = '';
                searchCatalog();
                
                // Scroll to content
                document.querySelector('.content-section').scrollIntoView({ behavior: 'smooth' });
            });
        });
        
        // Handle hash in URL
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            const tab = document.querySelector(`.category-tab[data-tab="${hash}"]`);
            if (tab) {
                tab.click();
            }
        }
        
        // Search functionality
        function searchCatalog() {
            const searchInput = document.getElementById('catalogSearch');
            const searchResults = document.getElementById('searchResults');
            const filter = searchInput.value.toLowerCase().trim();
            const items = document.querySelectorAll('.catalog-item');
            let visibleCount = 0;
            let totalInActiveTab = 0;
            
            // Get active tab category
            const activeTab = document.querySelector('.tab-content.active');
            const activeCategory = activeTab ? activeTab.id : null;
            
            items.forEach(item => {
                const name = item.getAttribute('data-name') || '';
                const description = item.getAttribute('data-description') || '';
                const category = item.getAttribute('data-category') || '';
                const isInActiveTab = category === activeCategory;
                
                if (isInActiveTab) {
                    totalInActiveTab++;
                }
                
                if (filter === '') {
                    // No search - show all items
                    item.style.display = '';
                    if (isInActiveTab) visibleCount++;
                } else {
                    // Search - filter items in active tab
                    if (isInActiveTab && (name.includes(filter) || description.includes(filter))) {
                        item.style.display = '';
                        visibleCount++;
                    } else if (isInActiveTab) {
                        item.style.display = 'none';
                    }
                }
            });
            
            // Update results counter
            if (filter === '') {
                searchResults.textContent = '';
            } else {
                searchResults.textContent = visibleCount + ' of ' + totalInActiveTab + ' items found';
            }
        }
        
        // Trigger search on input
        document.getElementById('catalogSearch').addEventListener('keyup', searchCatalog);
    </script>
</body>
</html>
