@extends('layouts.app')

@section('content')
@include('admin.partials.sidebar')

<div class="ml-64 min-h-screen bg-gray-50 py-8">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Site Settings</h1>
      <p class="mt-2 text-gray-600">Manage logo, header, footer and social media settings</p>
    </div>

    @if (session('status'))
      <div class="mb-6 bg-green-50 text-green-800 border border-green-200 px-4 py-3 rounded">{{ session('status') }}</div>
    @endif

    @if (session('error'))
      <div class="mb-6 bg-red-50 text-red-800 border border-red-200 px-4 py-3 rounded">{{ session('error') }}</div>
    @endif

    <!-- Global Reset to Defaults -->
    <div class="bg-red-50 border border-red-200 rounded-lg shadow p-6 mb-8">
      <div class="flex items-start justify-between">
        <div>
          <h2 class="text-xl font-semibold text-red-800 flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>Reset All Pages to Default
          </h2>
          <p class="text-sm text-red-600 mt-1">This will reset ALL page settings (Home, About, Rooms, Restaurant, Contact, Services, Explore, Gallery, Search, Terms) to their default values. This action cannot be undone.</p>
        </div>
        <button type="button" onclick="openResetModal()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors flex items-center">
          <i class="fas fa-undo mr-2"></i>Reset All Pages
        </button>
      </div>
    </div>

    <form method="POST" action="{{ route('admin.site-settings.update') }}" class="space-y-8" enctype="multipart/form-data">
      @csrf

      <!-- Logo & Branding -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="branding-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-image mr-2 text-blue-600"></i>Logo & Branding
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="branding-section" class="section-content p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
            <input type="text" name="site_name" value="{{ old('site_name', $settings->site_name) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            @include('admin.partials.image-upload-field', ['name' => 'site_logo', 'label' => 'Site Logo', 'value' => $settings->site_logo ?: url('/assets/img/logo.png')])
          </div>
          <div>
            @include('admin.partials.image-upload-field', ['name' => 'site_favicon', 'label' => 'Favicon', 'value' => $settings->site_favicon ?: ''])
          </div>
        </div>
        </div>
      </div>

      <!-- Currency Settings -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="currency-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-money-bill-wave mr-2 text-green-600"></i>Currency Settings
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="currency-section" class="section-content p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Select Currency</label>
            <select id="currency-selector" class="w-full border rounded px-3 py-2">
              <option value="">-- Select to auto-fill --</option>
              <option value="NGN|₦">NGN - Nigerian Naira (₦)</option>
              <option value="USD|$">USD - US Dollar ($)</option>
              <option value="EUR|€">EUR - Euro (€)</option>
              <option value="GBP|£">GBP - British Pound (£)</option>
              <option value="KWD|د.ك">KWD - Kuwaiti Dinar (د.ك)</option>
              <option value="AED|د.إ">AED - UAE Dirham (د.إ)</option>
              <option value="SAR|﷼">SAR - Saudi Riyal (﷼)</option>
              <option value="INR|₹">INR - Indian Rupee (₹)</option>
              <option value="CNY|¥">CNY - Chinese Yuan (¥)</option>
              <option value="JPY|¥">JPY - Japanese Yen (¥)</option>
              <option value="ZAR|R">ZAR - South African Rand (R)</option>
              <option value="CAD|C$">CAD - Canadian Dollar (C$)</option>
              <option value="AUD|A$">AUD - Australian Dollar (A$)</option>
              <option value="CUSTOM|">Custom Currency</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">Select a currency to auto-fill code and symbol</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Currency Code</label>
            <input type="text" name="currency_code" id="currency-code" value="{{ old('currency_code', $settings->currency_code ?: 'NGN') }}" class="w-full border rounded px-3 py-2" placeholder="NGN, USD, EUR" />
            <p class="text-xs text-gray-500 mt-1">3-letter currency code</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Currency Symbol</label>
            <input type="text" name="currency_symbol" id="currency-symbol" value="{{ old('currency_symbol', $settings->currency_symbol ?: '₦') }}" class="w-full border rounded px-3 py-2" placeholder="₦, $, €, £" />
            <p class="text-xs text-gray-500 mt-1">Symbol shown with prices</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Symbol Position</label>
            <select name="currency_position" id="currency-position" class="w-full border rounded px-3 py-2">
              <option value="before" {{ old('currency_position', $settings->currency_position ?: 'before') == 'before' ? 'selected' : '' }}>Before amount (₦100)</option>
              <option value="after" {{ old('currency_position', $settings->currency_position) == 'after' ? 'selected' : '' }}>After amount (100₦)</option>
            </select>
          </div>
        </div>
        <div class="mt-4 p-3 bg-gray-50 rounded border flex items-center justify-between">
          <div>
            <span class="text-sm text-gray-600">Preview: </span>
            <span id="currency-preview" class="text-lg font-semibold text-green-600">{{ ($settings->currency_position ?: 'before') == 'before' ? ($settings->currency_symbol ?: '₦') . '10,000' : '10,000' . ($settings->currency_symbol ?: '₦') }}</span>
          </div>
          <div class="text-sm text-gray-500">
            Current: <strong>{{ $settings->currency_code ?: 'NGN' }}</strong> ({{ $settings->currency_symbol ?: '₦' }})
          </div>
        </div>
        </div>
      </div>

      <!-- Header Information -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="header-info-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-info-circle mr-2 text-purple-600"></i>Header Information
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="header-info-section" class="section-content p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="text" name="header_phone" value="{{ old('header_phone', $settings->header_phone ?: '+234 816 325 9205') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" name="header_email" value="{{ old('header_email', $settings->header_email ?: 'info@vizithotel.com') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <textarea name="header_address" rows="2" class="w-full border rounded px-3 py-2">{{ old('header_address', $settings->header_address ?: 'Benin City, Edo State, Nigeria') }}</textarea>
          </div>
        </div>
        </div>
      </div>

      <!-- Header & Footer Colors -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="colors-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-palette mr-2 text-pink-600"></i>Header & Footer Colors
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="colors-section" class="section-content p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="p-4 border rounded-lg">
            <h3 class="font-medium text-gray-800 mb-3"><i class="fas fa-arrow-up mr-2"></i>Header Colors</h3>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
                <div class="flex items-center gap-2">
                  <input type="color" id="header_bg_color_picker" value="{{ old('header_bg_color', $settings->header_bg_color ?: '#000000') }}" class="w-12 h-10 border rounded cursor-pointer" onchange="document.getElementById('header_bg_color').value=this.value" />
                  <input type="text" name="header_bg_color" id="header_bg_color" value="{{ old('header_bg_color', $settings->header_bg_color ?: '#000000') }}" class="flex-1 border rounded px-3 py-2 text-sm" onchange="document.getElementById('header_bg_color_picker').value=this.value" />
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Text Color</label>
                <div class="flex items-center gap-2">
                  <input type="color" id="header_text_color_picker" value="{{ old('header_text_color', $settings->header_text_color ?: '#ffffff') }}" class="w-12 h-10 border rounded cursor-pointer" onchange="document.getElementById('header_text_color').value=this.value" />
                  <input type="text" name="header_text_color" id="header_text_color" value="{{ old('header_text_color', $settings->header_text_color ?: '#ffffff') }}" class="flex-1 border rounded px-3 py-2 text-sm" onchange="document.getElementById('header_text_color_picker').value=this.value" />
                </div>
              </div>
            </div>
          </div>
          <div class="p-4 border rounded-lg">
            <h3 class="font-medium text-gray-800 mb-3"><i class="fas fa-arrow-down mr-2"></i>Footer Colors</h3>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
                <div class="flex items-center gap-2">
                  <input type="color" id="footer_bg_color_picker" value="{{ old('footer_bg_color', $settings->footer_bg_color ?: '#1a1a1a') }}" class="w-12 h-10 border rounded cursor-pointer" onchange="document.getElementById('footer_bg_color').value=this.value" />
                  <input type="text" name="footer_bg_color" id="footer_bg_color" value="{{ old('footer_bg_color', $settings->footer_bg_color ?: '#1a1a1a') }}" class="flex-1 border rounded px-3 py-2 text-sm" onchange="document.getElementById('footer_bg_color_picker').value=this.value" />
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Text Color (Address, About)</label>
                <div class="flex items-center gap-2">
                  <input type="color" id="footer_text_color_picker" value="{{ old('footer_text_color', $settings->footer_text_color ?: '#888888') }}" class="w-12 h-10 border rounded cursor-pointer" onchange="document.getElementById('footer_text_color').value=this.value" />
                  <input type="text" name="footer_text_color" id="footer_text_color" value="{{ old('footer_text_color', $settings->footer_text_color ?: '#888888') }}" class="flex-1 border rounded px-3 py-2 text-sm" onchange="document.getElementById('footer_text_color_picker').value=this.value" />
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Heading Color (Information, About Us)</label>
                <div class="flex items-center gap-2">
                  <input type="color" id="footer_heading_color_picker" value="{{ old('footer_heading_color', $settings->footer_heading_color ?: '#ffffff') }}" class="w-12 h-10 border rounded cursor-pointer" onchange="document.getElementById('footer_heading_color').value=this.value" />
                  <input type="text" name="footer_heading_color" id="footer_heading_color" value="{{ old('footer_heading_color', $settings->footer_heading_color ?: '#ffffff') }}" class="flex-1 border rounded px-3 py-2 text-sm" onchange="document.getElementById('footer_heading_color_picker').value=this.value" />
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link Color (Menu Links)</label>
                <div class="flex items-center gap-2">
                  <input type="color" id="footer_link_color_picker" value="{{ old('footer_link_color', $settings->footer_link_color ?: '#b59f6a') }}" class="w-12 h-10 border rounded cursor-pointer" onchange="document.getElementById('footer_link_color').value=this.value" />
                  <input type="text" name="footer_link_color" id="footer_link_color" value="{{ old('footer_link_color', $settings->footer_link_color ?: '#b59f6a') }}" class="flex-1 border rounded px-3 py-2 text-sm" onchange="document.getElementById('footer_link_color_picker').value=this.value" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-4 border-t">
          <label class="flex items-center">
            <input type="hidden" name="show_scroll_buttons" value="0">
            <input type="checkbox" name="show_scroll_buttons" value="1" {{ old('show_scroll_buttons', $settings->show_scroll_buttons ?? true) ? 'checked' : '' }} class="mr-2 w-5 h-5">
            <span class="text-sm font-medium text-gray-700">Show Scroll to Top/Bottom Buttons</span>
          </label>
          <p class="text-xs text-gray-500 mt-1">Display floating buttons on all pages to scroll to top and bottom</p>
        </div>
        </div>
      </div>

      <!-- Header Menu -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="header-menu-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-bars mr-2 text-indigo-600"></i>Header Menu
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="header-menu-section" class="section-content p-6">
        <p class="text-gray-600 text-sm mb-4">Manage main navigation menu items. Drag to reorder. You can add submenu items by clicking the + button.</p>
        <div id="header-menu-container">
          @php
            $headerMenu = $settings->header_menu ? json_decode($settings->header_menu, true) : [
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
          @foreach($headerMenu as $index => $item)
          <div class="menu-item border rounded-lg p-4 mb-3 bg-gray-50 cursor-move" data-index="{{ $index }}">
            <div class="flex items-center gap-4 mb-2">
              <div class="drag-handle text-gray-400 hover:text-gray-600 cursor-grab active:cursor-grabbing" title="Drag to reorder">
                <i class="fas fa-grip-vertical text-lg"></i>
              </div>
              <input type="text" name="header_menu[{{ $index }}][label]" value="{{ $item['label'] }}" placeholder="Label" class="flex-1 border rounded px-3 py-2" />
              <input type="text" name="header_menu[{{ $index }}][url]" value="{{ $item['url'] }}" placeholder="URL (e.g. /about)" class="flex-1 border rounded px-3 py-2" />
              <label class="flex items-center text-sm">
                <input type="checkbox" name="header_menu[{{ $index }}][highlight]" value="1" {{ isset($item['highlight']) && $item['highlight'] ? 'checked' : '' }} class="mr-1" />
                Highlight
              </label>
              <button type="button" onclick="addSubmenu(this, {{ $index }})" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600" title="Add submenu"><i class="fas fa-plus"></i></button>
              <button type="button" onclick="removeMenuItem(this)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600" title="Remove"><i class="fas fa-trash"></i></button>
            </div>
            <div class="submenu-container pl-8 ml-6">
              @if(isset($item['submenu']) && count($item['submenu']) > 0)
              @foreach($item['submenu'] as $subIndex => $subItem)
              <div class="submenu-item flex items-center gap-4 mb-2">
                <span class="text-gray-400">↳</span>
                <input type="text" name="header_menu[{{ $index }}][submenu][{{ $subIndex }}][label]" value="{{ $subItem['label'] }}" placeholder="Submenu Label" class="flex-1 border rounded px-3 py-2 text-sm" />
                <input type="text" name="header_menu[{{ $index }}][submenu][{{ $subIndex }}][url]" value="{{ $subItem['url'] }}" placeholder="URL" class="flex-1 border rounded px-3 py-2 text-sm" />
                <button type="button" onclick="removeSubmenu(this)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600"><i class="fas fa-times"></i></button>
              </div>
              @endforeach
              @endif
            </div>
          </div>
          @endforeach
        </div>
        <button type="button" onclick="addHeaderMenuItem()" class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"><i class="fas fa-plus mr-2"></i>Add Menu Item</button>
        </div>
      </div>

      <!-- Footer Contact Section -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="footer-contact-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-address-card mr-2 text-teal-600"></i>Footer Contact Section
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="footer-contact-section" class="section-content p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle</label>
            <input type="text" name="footer_subtitle" value="{{ old('footer_subtitle', $settings->footer_subtitle ?: 'get in touch') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
            <input type="text" name="footer_title" value="{{ old('footer_title', $settings->footer_title ?: 'drop us a line') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Footer Phone</label>
            <input type="text" name="footer_phone" value="{{ old('footer_phone', $settings->footer_phone ?: '+234 816 325 9205') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Footer Email</label>
            <input type="email" name="footer_email" value="{{ old('footer_email', $settings->footer_email ?: 'info@vizithotel.com') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Check-In Time</label>
            <input type="text" name="check_in_time" value="{{ old('check_in_time', $settings->check_in_time ?: '14:00 pm') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Check-Out Time</label>
            <input type="text" name="check_out_time" value="{{ old('check_out_time', $settings->check_out_time ?: '11:00 am') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Opening Hours</label>
            <input type="text" name="opening_hours" value="{{ old('opening_hours', $settings->opening_hours ?: '8am - 10pm') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Website Name/URL (shown in footer)</label>
            <input type="text" name="footer_website" value="{{ old('footer_website', $settings->footer_website ?: $settings->site_name ?: 'Vizit Hotel & Suites') }}" class="w-full border rounded px-3 py-2" placeholder="e.g. www.vizithotel.com or Vizit Hotel & Suites" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subscribe Button Text</label>
            <input type="text" name="subscribe_button" value="{{ old('subscribe_button', $settings->subscribe_button ?: 'subscribe') }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Footer Address</label>
            <textarea name="footer_address" rows="2" class="w-full border rounded px-3 py-2">{{ old('footer_address', $settings->footer_address ?: 'Benin City, Edo State, Nigeria') }}</textarea>
          </div>
        </div>
        </div>
      </div>

      <!-- Subscribe Section Styling -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="subscribe-styling-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-envelope mr-2 text-pink-600"></i>Subscribe Section Styling
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="subscribe-styling-section" class="section-content p-6">
        
        <!-- Show/Hide Subscribe Section -->
        <div class="mb-6 pb-4 border-b">
          <label class="inline-flex items-center">
            <input type="hidden" name="subscribe_show_section" value="0">
            <input type="checkbox" name="subscribe_show_section" value="1" {{ old('subscribe_show_section', $settings->subscribe_show_section ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="font-medium text-gray-700">Show Subscribe Section in Footer</span>
          </label>
        </div>

        <!-- Style Presets -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">Style Preset</label>
          <div class="grid grid-cols-2 md:grid-cols-6 gap-3">
            @php
              $styles = [
                'classic' => ['name' => 'Classic', 'desc' => 'Dark elegant box', 'icon' => 'fa-square'],
                'modern' => ['name' => 'Modern', 'desc' => 'Clean minimal', 'icon' => 'fa-minus-square'],
                'minimal' => ['name' => 'Minimal', 'desc' => 'Line underline', 'icon' => 'fa-window-minimize'],
                'pill' => ['name' => 'Pill', 'desc' => 'Rounded capsule', 'icon' => 'fa-capsules'],
                'glassmorphism' => ['name' => 'Glass', 'desc' => 'Frosted glass', 'icon' => 'fa-wine-glass'],
                'gradient' => ['name' => 'Gradient', 'desc' => 'Colorful gradient', 'icon' => 'fa-palette'],
              ];
              $currentStyle = old('subscribe_style', $settings->subscribe_style ?: 'classic');
            @endphp
            @foreach($styles as $key => $style)
            <label class="subscribe-style-option cursor-pointer">
              <input type="radio" name="subscribe_style" value="{{ $key }}" {{ $currentStyle === $key ? 'checked' : '' }} class="sr-only peer">
              <div class="p-3 border-2 rounded-lg text-center transition-all peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-400">
                <i class="fas {{ $style['icon'] }} text-2xl mb-1 text-gray-600 peer-checked:text-blue-600"></i>
                <div class="font-medium text-sm">{{ $style['name'] }}</div>
                <div class="text-xs text-gray-500">{{ $style['desc'] }}</div>
              </div>
            </label>
            @endforeach
          </div>
        </div>

        <!-- Subscribe Section Content -->
        <div class="mb-6 pb-4 border-b">
          <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-heading mr-2"></i>Section Content</h4>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Section Title (optional)</label>
              <input type="text" name="subscribe_title" value="{{ old('subscribe_title', $settings->subscribe_title) }}" class="w-full border rounded px-3 py-2" placeholder="e.g. Stay Updated" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle (optional)</label>
              <input type="text" name="subscribe_subtitle" value="{{ old('subscribe_subtitle', $settings->subscribe_subtitle) }}" class="w-full border rounded px-3 py-2" placeholder="e.g. Get exclusive offers" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Input Placeholder</label>
              <input type="text" name="subscribe_placeholder" value="{{ old('subscribe_placeholder', $settings->subscribe_placeholder ?: 'your email here') }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
        </div>

        <!-- Input Styling -->
        <div class="mb-6 pb-4 border-b">
          <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-keyboard mr-2"></i>Input Field Styling</h4>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_input_bg" value="{{ old('subscribe_input_bg', $settings->subscribe_input_bg ?: '#212121') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_input_bg', $settings->subscribe_input_bg ?: '#212121') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_input_bg" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Text Color</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_input_text" value="{{ old('subscribe_input_text', $settings->subscribe_input_text ?: '#ffffff') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_input_text', $settings->subscribe_input_text ?: '#ffffff') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_input_text" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Border Color</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_input_border" value="{{ old('subscribe_input_border', $settings->subscribe_input_border ?: '#333333') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_input_border', $settings->subscribe_input_border ?: '#333333') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_input_border" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Border Radius</label>
              <select name="subscribe_input_border_radius" class="w-full border rounded px-3 py-2">
                <option value="0" {{ old('subscribe_input_border_radius', $settings->subscribe_input_border_radius) === '0' ? 'selected' : '' }}>Square (0px)</option>
                <option value="4px" {{ old('subscribe_input_border_radius', $settings->subscribe_input_border_radius ?: '0') === '4px' ? 'selected' : '' }}>Slight (4px)</option>
                <option value="8px" {{ old('subscribe_input_border_radius', $settings->subscribe_input_border_radius) === '8px' ? 'selected' : '' }}>Rounded (8px)</option>
                <option value="20px" {{ old('subscribe_input_border_radius', $settings->subscribe_input_border_radius) === '20px' ? 'selected' : '' }}>More Rounded (20px)</option>
                <option value="50px" {{ old('subscribe_input_border_radius', $settings->subscribe_input_border_radius) === '50px' ? 'selected' : '' }}>Pill (50px)</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Button Styling -->
        <div class="mb-6 pb-4 border-b">
          <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-mouse-pointer mr-2"></i>Button Styling</h4>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_btn_bg" value="{{ old('subscribe_btn_bg', $settings->subscribe_btn_bg ?: '#000000') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_btn_bg', $settings->subscribe_btn_bg ?: '#000000') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_btn_bg" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Text Color</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_btn_text" value="{{ old('subscribe_btn_text', $settings->subscribe_btn_text ?: '#ffffff') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_btn_text', $settings->subscribe_btn_text ?: '#ffffff') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_btn_text" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Hover Background</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_btn_hover_bg" value="{{ old('subscribe_btn_hover_bg', $settings->subscribe_btn_hover_bg ?: '#333333') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_btn_hover_bg', $settings->subscribe_btn_hover_bg ?: '#333333') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_btn_hover_bg" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Hover Text Color</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_btn_hover_text" value="{{ old('subscribe_btn_hover_text', $settings->subscribe_btn_hover_text ?: '#ffffff') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_btn_hover_text', $settings->subscribe_btn_hover_text ?: '#ffffff') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_btn_hover_text" />
              </div>
            </div>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Border Radius</label>
              <select name="subscribe_btn_border_radius" class="w-full border rounded px-3 py-2">
                <option value="0" {{ old('subscribe_btn_border_radius', $settings->subscribe_btn_border_radius ?: '0') === '0' ? 'selected' : '' }}>Square (0px)</option>
                <option value="4px" {{ old('subscribe_btn_border_radius', $settings->subscribe_btn_border_radius) === '4px' ? 'selected' : '' }}>Slight (4px)</option>
                <option value="8px" {{ old('subscribe_btn_border_radius', $settings->subscribe_btn_border_radius) === '8px' ? 'selected' : '' }}>Rounded (8px)</option>
                <option value="20px" {{ old('subscribe_btn_border_radius', $settings->subscribe_btn_border_radius) === '20px' ? 'selected' : '' }}>More Rounded (20px)</option>
                <option value="50px" {{ old('subscribe_btn_border_radius', $settings->subscribe_btn_border_radius) === '50px' ? 'selected' : '' }}>Pill (50px)</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Button Icon</label>
              <select name="subscribe_btn_icon" class="w-full border rounded px-3 py-2">
                <option value="" {{ !old('subscribe_btn_icon', $settings->subscribe_btn_icon) ? 'selected' : '' }}>None</option>
                <option value="fa-paper-plane" {{ old('subscribe_btn_icon', $settings->subscribe_btn_icon) === 'fa-paper-plane' ? 'selected' : '' }}>✈ Paper Plane</option>
                <option value="fa-envelope" {{ old('subscribe_btn_icon', $settings->subscribe_btn_icon) === 'fa-envelope' ? 'selected' : '' }}>✉ Envelope</option>
                <option value="fa-arrow-right" {{ old('subscribe_btn_icon', $settings->subscribe_btn_icon) === 'fa-arrow-right' ? 'selected' : '' }}>→ Arrow Right</option>
                <option value="fa-bell" {{ old('subscribe_btn_icon', $settings->subscribe_btn_icon) === 'fa-bell' ? 'selected' : '' }}>🔔 Bell</option>
                <option value="fa-check" {{ old('subscribe_btn_icon', $settings->subscribe_btn_icon) === 'fa-check' ? 'selected' : '' }}>✓ Check</option>
                <option value="fa-plus" {{ old('subscribe_btn_icon', $settings->subscribe_btn_icon) === 'fa-plus' ? 'selected' : '' }}>+ Plus</option>
              </select>
            </div>
            <div class="flex items-end">
              <label class="inline-flex items-center">
                <input type="hidden" name="subscribe_btn_icon_only" value="0">
                <input type="checkbox" name="subscribe_btn_icon_only" value="1" {{ old('subscribe_btn_icon_only', $settings->subscribe_btn_icon_only) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">Icon only (no text)</span>
              </label>
            </div>
          </div>
        </div>

        <!-- Container Styling -->
        <div class="mb-6">
          <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-box mr-2"></i>Container Styling</h4>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Container Background</label>
              <div class="flex gap-2">
                <input type="color" name="subscribe_container_bg" value="{{ old('subscribe_container_bg', $settings->subscribe_container_bg ?: '#1a1a1a') }}" class="h-10 w-14 border rounded cursor-pointer" />
                <input type="text" value="{{ old('subscribe_container_bg', $settings->subscribe_container_bg ?: '#1a1a1a') }}" class="flex-1 border rounded px-2 py-1 text-sm subscribe-color-text" data-target="subscribe_container_bg" />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Box Shadow</label>
              <select name="subscribe_container_shadow" class="w-full border rounded px-3 py-2">
                <option value="none" {{ old('subscribe_container_shadow', $settings->subscribe_container_shadow ?: 'large') === 'none' ? 'selected' : '' }}>None</option>
                <option value="small" {{ old('subscribe_container_shadow', $settings->subscribe_container_shadow) === 'small' ? 'selected' : '' }}>Small</option>
                <option value="medium" {{ old('subscribe_container_shadow', $settings->subscribe_container_shadow) === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="large" {{ old('subscribe_container_shadow', $settings->subscribe_container_shadow ?: 'large') === 'large' ? 'selected' : '' }}>Large</option>
                <option value="glow" {{ old('subscribe_container_shadow', $settings->subscribe_container_shadow) === 'glow' ? 'selected' : '' }}>Glow Effect</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Live Preview -->
        <div class="mt-6 p-6 bg-gray-800 rounded-lg">
          <h4 class="text-sm font-semibold text-white mb-4"><i class="fas fa-eye mr-2"></i>Live Preview</h4>
          <div class="flex justify-center">
            <div id="subscribe-preview" class="subscribe-preview-container">
              <!-- Preview will be rendered here by JS -->
            </div>
          </div>
        </div>

        </div>
      </div>

      <!-- Footer Menu (Information Links) -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="footer-menu-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-link mr-2 text-orange-600"></i>Footer Menu (Information Links)
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="footer-menu-section" class="section-content p-6">
        <p class="text-gray-600 text-sm mb-4">These links appear in the "Information" section of the footer. Drag to reorder.</p>
        <div id="footer-menu-container">
          @php
            $footerMenu = $settings->footer_menu ? json_decode($settings->footer_menu, true) : [
              ['label' => 'terms & conditions', 'url' => '/tandc'],
              ['label' => 'services', 'url' => '/services'],
              ['label' => 'restaurant', 'url' => '/restaurant'],
              ['label' => 'testimonials', 'url' => '#'],
              ['label' => 'gallery & images', 'url' => '/rooms/gallery']
            ];
          @endphp
          @foreach($footerMenu as $index => $item)
          <div class="footer-menu-item flex items-center gap-4 mb-2 p-3 bg-gray-50 rounded-lg border border-gray-200 cursor-move hover:bg-gray-100 transition-colors">
            <div class="drag-handle text-gray-400 hover:text-gray-600 cursor-grab active:cursor-grabbing" title="Drag to reorder">
              <i class="fas fa-grip-vertical"></i>
            </div>
            <input type="text" name="footer_menu[{{ $index }}][label]" value="{{ $item['label'] }}" placeholder="Label" class="flex-1 border rounded px-3 py-2" />
            <input type="text" name="footer_menu[{{ $index }}][url]" value="{{ $item['url'] }}" placeholder="URL" class="flex-1 border rounded px-3 py-2" />
            <button type="button" onclick="removeFooterMenuItem(this)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600"><i class="fas fa-trash"></i></button>
          </div>
          @endforeach
        </div>
        <button type="button" onclick="addFooterMenuItem()" class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"><i class="fas fa-plus mr-2"></i>Add Link</button>
        </div>
      </div>

      <!-- Footer About & Bottom -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="footer-about-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-file-alt mr-2 text-gray-600"></i>Footer About & Bottom
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="footer-about-section" class="section-content p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">About Text</label>
            <textarea name="footer_about" rows="3" class="w-full border rounded px-3 py-2">{{ old('footer_about', $settings->footer_about ?: 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.') }}</textarea>
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Copyright Text</label>
            <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $settings->footer_copyright ?: '© ' . date('Y') . ' Vizit Hotel & Suites. All Rights Reserved.') }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
        </div>
      </div>

      <!-- Partner Logos -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="partner-logos-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-handshake mr-2 text-yellow-600"></i>Partner/Certification Logos
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="partner-logos-section" class="section-content p-6">
        <p class="text-gray-600 text-sm mb-4">Upload logos that appear in the footer (e.g., TripAdvisor, certifications)</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @include('admin.partials.image-upload-field', ['name' => 'partner_logo_1', 'label' => 'Logo 1', 'value' => $settings->partner_logo_1 ?: '/assets/img/logos/1.png'])
          @include('admin.partials.image-upload-field', ['name' => 'partner_logo_2', 'label' => 'Logo 2', 'value' => $settings->partner_logo_2 ?: '/assets/img/logos/2.png'])
          @include('admin.partials.image-upload-field', ['name' => 'partner_logo_3', 'label' => 'Logo 3', 'value' => $settings->partner_logo_3 ?: '/assets/img/logos/3.png'])
          @include('admin.partials.image-upload-field', ['name' => 'partner_logo_4', 'label' => 'Logo 4 (optional)', 'value' => $settings->partner_logo_4 ?: ''])
        </div>
        </div>
      </div>

      <!-- Social Media -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="social-media-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-share-alt mr-2 text-blue-500"></i>Social Media Links
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="social-media-section" class="section-content p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fab fa-facebook mr-2"></i>Facebook URL</label>
            <input type="url" name="social_facebook" value="{{ old('social_facebook', $settings->social_facebook) }}" placeholder="https://facebook.com/..." class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fab fa-twitter mr-2"></i>Twitter URL</label>
            <input type="url" name="social_twitter" value="{{ old('social_twitter', $settings->social_twitter) }}" placeholder="https://twitter.com/..." class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fab fa-instagram mr-2"></i>Instagram URL</label>
            <input type="url" name="social_instagram" value="{{ old('social_instagram', $settings->social_instagram) }}" placeholder="https://instagram.com/..." class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fab fa-tiktok mr-2"></i>TikTok URL</label>
            <input type="url" name="social_tiktok" value="{{ old('social_tiktok', $settings->social_tiktok) }}" placeholder="https://tiktok.com/@..." class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fab fa-youtube mr-2"></i>YouTube URL</label>
            <input type="url" name="social_youtube" value="{{ old('social_youtube', $settings->social_youtube) }}" placeholder="https://youtube.com/..." class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fab fa-tripadvisor mr-2"></i>TripAdvisor URL</label>
            <input type="url" name="social_tripadvisor" value="{{ old('social_tripadvisor', $settings->social_tripadvisor) }}" placeholder="https://tripadvisor.com/..." class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-calendar-check mr-2"></i>Booking.com URL</label>
            <input type="url" name="social_booking" value="{{ old('social_booking', $settings->social_booking) }}" placeholder="https://booking.com/..." class="w-full border rounded px-3 py-2" />
          </div>
        </div>
        </div>
      </div>

      <!-- Notification Settings -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="notification-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-bell mr-2 text-red-600"></i>Notification Settings
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="notification-section" class="section-content p-6">
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-envelope mr-2"></i>Notification Email</label>
            <input type="email" name="notification_email" value="{{ old('notification_email', $settings->notification_email) }}" placeholder="admin@yourhotel.com" class="w-full border rounded px-3 py-2" />
            <p class="text-xs text-gray-500 mt-1">Email address to receive notifications when new subscribers sign up</p>
          </div>
        </div>
        </div>
      </div>

      <!-- Custom Code (Header & Footer) -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="custom-code-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-code mr-2 text-purple-600"></i>Custom Code (Verification & Analytics)
          </h2>
          <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </button>
        <div id="custom-code-section" class="section-content p-6">
          <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
              <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
              </div>
              <div class="ml-3">
                <p class="text-sm text-yellow-700">
                  <strong>Use with caution:</strong> Only add trusted code from verified sources like Google, Bing, Facebook, etc. Invalid code may break your site.
                </p>
              </div>
            </div>
          </div>
          
          <div class="space-y-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-heading mr-2"></i>Header Code (inside &lt;head&gt;)
              </label>
              <textarea name="custom_header_code" rows="6" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder="<!-- Google Search Console verification -->
<meta name=&quot;google-site-verification&quot; content=&quot;your-code-here&quot; />

<!-- Bing Webmaster verification -->
<meta name=&quot;msvalidate.01&quot; content=&quot;your-code-here&quot; />

<!-- Google Analytics -->
<script async src=&quot;https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID&quot;></script>">{{ old('custom_header_code', $settings->custom_header_code) }}</textarea>
              <p class="text-xs text-gray-500 mt-1">Add meta tags for search engine verification, analytics scripts, etc. This code will be inserted before the closing &lt;/head&gt; tag.</p>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-shoe-prints mr-2"></i>Footer Code (before &lt;/body&gt;)
              </label>
              <textarea name="custom_footer_code" rows="6" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder="<!-- Chat widgets, tracking pixels, etc. -->">{{ old('custom_footer_code', $settings->custom_footer_code) }}</textarea>
              <p class="text-xs text-gray-500 mt-1">Add scripts that should load at the end of the page (chat widgets, tracking pixels, etc.).</p>
            </div>
          </div>
          
          <div class="mt-4 p-4 bg-gray-50 rounded-lg">
            <h4 class="font-medium text-gray-700 mb-2"><i class="fas fa-lightbulb mr-2 text-yellow-500"></i>Common Verification Codes:</h4>
            <ul class="text-sm text-gray-600 space-y-1">
              <li><strong>Google Search Console:</strong> <code class="bg-gray-200 px-1 rounded">&lt;meta name="google-site-verification" content="..." /&gt;</code></li>
              <li><strong>Bing Webmaster:</strong> <code class="bg-gray-200 px-1 rounded">&lt;meta name="msvalidate.01" content="..." /&gt;</code></li>
              <li><strong>Facebook Domain:</strong> <code class="bg-gray-200 px-1 rounded">&lt;meta name="facebook-domain-verification" content="..." /&gt;</code></li>
              <li><strong>Pinterest:</strong> <code class="bg-gray-200 px-1 rounded">&lt;meta name="p:domain_verify" content="..." /&gt;</code></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">Save Settings</button>
      </div>
    </form>
  </div>
</div>

<script>
let headerMenuIndex = {{ count($headerMenu) }};
let footerMenuIndex = {{ count($footerMenu) }};

// Header Menu Functions
function addHeaderMenuItem() {
  const container = document.getElementById('header-menu-container');
  const html = `
    <div class="menu-item border rounded-lg p-4 mb-3 bg-gray-50 cursor-move" data-index="${headerMenuIndex}">
      <div class="flex items-center gap-4 mb-2">
        <div class="drag-handle text-gray-400 hover:text-gray-600 cursor-grab active:cursor-grabbing" title="Drag to reorder">
          <i class="fas fa-grip-vertical text-lg"></i>
        </div>
        <input type="text" name="header_menu[${headerMenuIndex}][label]" placeholder="Label" class="flex-1 border rounded px-3 py-2" />
        <input type="text" name="header_menu[${headerMenuIndex}][url]" placeholder="URL (e.g. /about)" class="flex-1 border rounded px-3 py-2" />
        <label class="flex items-center text-sm">
          <input type="checkbox" name="header_menu[${headerMenuIndex}][highlight]" value="1" class="mr-1" />
          Highlight
        </label>
        <button type="button" onclick="addSubmenu(this, ${headerMenuIndex})" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600" title="Add submenu"><i class="fas fa-plus"></i></button>
        <button type="button" onclick="removeMenuItem(this)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600" title="Remove"><i class="fas fa-trash"></i></button>
      </div>
      <div class="submenu-container pl-8 ml-6"></div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
  headerMenuIndex++;
}

function removeMenuItem(btn) {
  btn.closest('.menu-item').remove();
}

function addSubmenu(btn, parentIndex) {
  const submenuContainer = btn.closest('.menu-item').querySelector('.submenu-container');
  const subIndex = submenuContainer.querySelectorAll('.submenu-item').length;
  const html = `
    <div class="submenu-item flex items-center gap-4 mb-2">
      <span class="text-gray-400">↳</span>
      <input type="text" name="header_menu[${parentIndex}][submenu][${subIndex}][label]" placeholder="Submenu Label" class="flex-1 border rounded px-3 py-2 text-sm" />
      <input type="text" name="header_menu[${parentIndex}][submenu][${subIndex}][url]" placeholder="URL" class="flex-1 border rounded px-3 py-2 text-sm" />
      <button type="button" onclick="removeSubmenu(this)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600"><i class="fas fa-times"></i></button>
    </div>
  `;
  submenuContainer.insertAdjacentHTML('beforeend', html);
}

function removeSubmenu(btn) {
  btn.closest('.submenu-item').remove();
}

// Footer Menu Functions
function addFooterMenuItem() {
  const container = document.getElementById('footer-menu-container');
  const html = `
    <div class="footer-menu-item flex items-center gap-4 mb-2 p-3 bg-gray-50 rounded-lg border border-gray-200 cursor-move hover:bg-gray-100 transition-colors">
      <div class="drag-handle text-gray-400 hover:text-gray-600 cursor-grab active:cursor-grabbing" title="Drag to reorder">
        <i class="fas fa-grip-vertical"></i>
      </div>
      <input type="text" name="footer_menu[${footerMenuIndex}][label]" placeholder="Label" class="flex-1 border rounded px-3 py-2" />
      <input type="text" name="footer_menu[${footerMenuIndex}][url]" placeholder="URL" class="flex-1 border rounded px-3 py-2" />
      <button type="button" onclick="removeFooterMenuItem(this)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600"><i class="fas fa-trash"></i></button>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
  footerMenuIndex++;
}

function removeFooterMenuItem(btn) {
  btn.closest('.footer-menu-item').remove();
}

// Image Upload Handler
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.image-file-input').forEach(function(input) {
    input.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;

      const targetId = e.target.dataset.target;
      const hiddenInput = document.getElementById(targetId);
      const nameSpan = document.getElementById(targetId + '_name');
      const previewImg = document.getElementById(targetId + '_preview');
      const placeholder = document.getElementById(targetId + '_placeholder');

      nameSpan.textContent = 'Uploading...';

      const formData = new FormData();
      formData.append('image', file);
      formData.append('_token', '{{ csrf_token() }}');

      fetch('{{ route("admin.upload-image") }}', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
          return response.json();
        }
        throw new Error(`Server error (${response.status}). Please try again or check file size (max 5MB).`);
      })
      .then(data => {
        if (data.success) {
          hiddenInput.value = data.url;
          nameSpan.textContent = data.filename;
          previewImg.src = data.url;
          previewImg.style.display = 'block';
          if (placeholder) placeholder.style.display = 'none';
        } else {
          nameSpan.textContent = 'Upload failed';
          alert('Upload failed: ' + (data.message || 'Unknown error'));
        }
      })
      .catch(error => {
        nameSpan.textContent = 'Upload failed';
        alert('Upload error: ' + error.message);
      });
    });
  });
});
</script>
<!-- Currency Preview Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const currencySelector = document.getElementById('currency-selector');
    const codeInput = document.getElementById('currency-code');
    const symbolInput = document.getElementById('currency-symbol');
    const positionSelect = document.getElementById('currency-position');
    const preview = document.getElementById('currency-preview');
    
    function updatePreview() {
        const symbol = symbolInput.value || '₦';
        const position = positionSelect.value || 'before';
        const amount = '10,000';
        
        if (position === 'after') {
            preview.textContent = amount + symbol;
        } else {
            preview.textContent = symbol + amount;
        }
    }
    
    // Currency selector auto-fill
    if (currencySelector) {
        currencySelector.addEventListener('change', function() {
            const value = this.value;
            if (value && value !== 'CUSTOM|') {
                const parts = value.split('|');
                if (parts.length === 2) {
                    codeInput.value = parts[0];
                    symbolInput.value = parts[1];
                    updatePreview();
                }
            } else if (value === 'CUSTOM|') {
                codeInput.value = '';
                symbolInput.value = '';
                codeInput.focus();
            }
        });
    }
    
    if (symbolInput && positionSelect && preview) {
        symbolInput.addEventListener('input', updatePreview);
        positionSelect.addEventListener('change', updatePreview);
        codeInput.addEventListener('input', updatePreview);
    }
});
</script>
<!-- Global Reset Modal -->
<div id="resetModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
  <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6">
    <div class="text-center mb-6">
      <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
      </div>
      <h3 class="text-xl font-bold text-gray-900">Reset All Pages to Default</h3>
      <p class="text-gray-600 mt-2">This action will reset all page settings to their default values. Enter your password to confirm.</p>
    </div>
    
    <form id="resetForm" method="POST" action="{{ route('admin.global-reset') }}">
      @csrf
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Enter Your Password</label>
        <input type="password" name="password" id="resetPassword" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Your current password" />
      </div>
      
      <div class="mb-4">
        <label class="flex items-center">
          <input type="checkbox" name="confirm_reset" id="confirmReset" required class="mr-2 w-4 h-4 text-red-600">
          <span class="text-sm text-gray-700">I understand this action cannot be undone</span>
        </label>
      </div>
      
      <div class="flex gap-3">
        <button type="button" onclick="closeResetModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">
          Cancel
        </button>
        <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
          <i class="fas fa-undo mr-2"></i>Reset All
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function openResetModal() {
  document.getElementById('resetModal').classList.remove('hidden');
  document.getElementById('resetPassword').value = '';
  document.getElementById('confirmReset').checked = false;
}

function closeResetModal() {
  document.getElementById('resetModal').classList.add('hidden');
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeResetModal();
  }
});

// Close modal on backdrop click
document.getElementById('resetModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeResetModal();
  }
});

// Subscribe Preview Functions
function updateSubscribePreview() {
  const style = document.querySelector('input[name="subscribe_style"]:checked')?.value || 'classic';
  const btnText = document.querySelector('input[name="subscribe_button"]')?.value || 'subscribe';
  const placeholder = document.querySelector('input[name="subscribe_placeholder"]')?.value || 'your email here';
  const title = document.querySelector('input[name="subscribe_title"]')?.value || '';
  const subtitle = document.querySelector('input[name="subscribe_subtitle"]')?.value || '';
  
  const inputBg = document.querySelector('input[name="subscribe_input_bg"]')?.value || '#212121';
  const inputText = document.querySelector('input[name="subscribe_input_text"]')?.value || '#ffffff';
  const inputBorder = document.querySelector('input[name="subscribe_input_border"]')?.value || '#333333';
  const inputRadius = document.querySelector('select[name="subscribe_input_border_radius"]')?.value || '0';
  
  const btnBg = document.querySelector('input[name="subscribe_btn_bg"]')?.value || '#000000';
  const btnTextColor = document.querySelector('input[name="subscribe_btn_text"]')?.value || '#ffffff';
  const btnRadius = document.querySelector('select[name="subscribe_btn_border_radius"]')?.value || '0';
  const btnIcon = document.querySelector('select[name="subscribe_btn_icon"]')?.value || '';
  const btnIconOnly = document.querySelector('input[name="subscribe_btn_icon_only"]:checked');
  
  const containerBg = document.querySelector('input[name="subscribe_container_bg"]')?.value || '#1a1a1a';
  const containerShadow = document.querySelector('select[name="subscribe_container_shadow"]')?.value || 'large';
  
  // Shadow mapping
  const shadows = {
    'none': 'none',
    'small': '0 2px 8px rgba(0,0,0,0.2)',
    'medium': '0 4px 15px rgba(0,0,0,0.3)',
    'large': '0 6px 25px rgba(0,0,0,0.6)',
    'glow': '0 0 30px rgba(255,255,255,0.1)'
  };
  
  // Style-specific classes
  const styleClasses = {
    'classic': '',
    'modern': 'border border-gray-600',
    'minimal': 'bg-transparent border-b-2 border-gray-500',
    'pill': 'rounded-full',
    'glassmorphism': 'backdrop-blur-lg bg-opacity-30',
    'gradient': 'bg-gradient-to-r from-purple-600 to-pink-600'
  };

  let iconHtml = '';
  if (btnIcon) {
    iconHtml = `<i class="fas ${btnIcon} ${!btnIconOnly ? 'mr-2' : ''}"></i>`;
  }
  
  const buttonContent = btnIconOnly && btnIcon ? iconHtml : `${iconHtml}${btnText}`;
  
  // Apply style-specific modifications
  let containerClass = '';
  let inputStyle = `background-color: ${inputBg}; color: ${inputText}; border: 1px solid ${inputBorder}; border-radius: ${inputRadius};`;
  let btnStyle = `background-color: ${btnBg}; color: ${btnTextColor}; border-radius: ${btnRadius};`;
  
  if (style === 'minimal') {
    inputStyle = `background-color: transparent; color: ${inputText}; border: none; border-bottom: 2px solid ${inputBorder};`;
    btnStyle = `background-color: transparent; color: ${btnTextColor}; border: 2px solid ${btnBg};`;
  } else if (style === 'glassmorphism') {
    containerClass = 'backdrop-blur-sm';
    inputStyle += ' background: rgba(255,255,255,0.1);';
  } else if (style === 'gradient') {
    btnStyle = `background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: ${btnTextColor}; border-radius: ${btnRadius};`;
  } else if (style === 'pill') {
    inputStyle = `background-color: ${inputBg}; color: ${inputText}; border: 1px solid ${inputBorder}; border-radius: 50px;`;
    btnStyle = `background-color: ${btnBg}; color: ${btnTextColor}; border-radius: 50px;`;
  }
  
  let html = `
    <div class="subscribe-preview ${containerClass}" style="background-color: ${containerBg}; box-shadow: ${shadows[containerShadow]}; padding: 20px 30px; width: 100%; max-width: 500px;">
      ${title ? `<div style="color: #fff; font-size: 14px; text-align: center; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 2px;">${title}</div>` : ''}
      ${subtitle ? `<div style="color: #aaa; font-size: 12px; text-align: center; margin-bottom: 15px;">${subtitle}</div>` : ''}
      <div style="display: flex; position: relative;">
        <input type="text" placeholder="${placeholder}" disabled style="${inputStyle} flex: 1; padding: 15px 20px; font-size: 14px; outline: none;" />
        <button disabled style="${btnStyle} padding: 15px 25px; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; white-space: nowrap;">${buttonContent}</button>
      </div>
    </div>
  `;
  
  document.getElementById('subscribe-preview').innerHTML = html;
}

// Sync color inputs with text inputs
document.querySelectorAll('.subscribe-color-text').forEach(textInput => {
  const target = textInput.dataset.target;
  const colorInput = document.querySelector(`input[name="${target}"]`);
  
  if (colorInput) {
    colorInput.addEventListener('input', function() {
      textInput.value = this.value;
      updateSubscribePreview();
    });
    
    textInput.addEventListener('change', function() {
      colorInput.value = this.value;
      updateSubscribePreview();
    });
  }
});

// Update preview on any input change
document.querySelectorAll('#subscribe-styling-section input, #subscribe-styling-section select').forEach(el => {
  el.addEventListener('change', updateSubscribePreview);
  el.addEventListener('input', updateSubscribePreview);
});

// Initial preview render
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(updateSubscribePreview, 100);
});
</script>

<!-- SortableJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize Sortable for Header Menu
  const headerMenuContainer = document.getElementById('header-menu-container');
  if (headerMenuContainer && typeof Sortable !== 'undefined') {
    new Sortable(headerMenuContainer, {
      animation: 150,
      handle: '.drag-handle',
      ghostClass: 'sortable-ghost',
      chosenClass: 'sortable-chosen',
      dragClass: 'sortable-drag',
      onEnd: function() {
        reindexHeaderMenu();
      }
    });
  }
  
  // Initialize Sortable for Footer Menu
  const footerMenuContainer = document.getElementById('footer-menu-container');
  if (footerMenuContainer && typeof Sortable !== 'undefined') {
    new Sortable(footerMenuContainer, {
      animation: 150,
      handle: '.drag-handle',
      ghostClass: 'sortable-ghost',
      chosenClass: 'sortable-chosen',
      dragClass: 'sortable-drag',
      onEnd: function() {
        reindexFooterMenu();
      }
    });
  }
  
  // Initialize Sortable for submenu items within each header menu item
  initializeSubmenuSortable();
});

// Re-index header menu items after drag
function reindexHeaderMenu() {
  const container = document.getElementById('header-menu-container');
  const items = container.querySelectorAll('.menu-item');
  
  items.forEach((item, index) => {
    item.dataset.index = index;
    
    // Update main item inputs
    const labelInput = item.querySelector('input[name*="[label]"]');
    const urlInput = item.querySelector('input[name*="[url]"]');
    const highlightInput = item.querySelector('input[name*="[highlight]"]');
    const addSubmenuBtn = item.querySelector('button[onclick*="addSubmenu"]');
    
    if (labelInput) labelInput.name = `header_menu[${index}][label]`;
    if (urlInput) urlInput.name = `header_menu[${index}][url]`;
    if (highlightInput) highlightInput.name = `header_menu[${index}][highlight]`;
    if (addSubmenuBtn) addSubmenuBtn.setAttribute('onclick', `addSubmenu(this, ${index})`);
    
    // Update submenu inputs
    const submenuItems = item.querySelectorAll('.submenu-item');
    submenuItems.forEach((subItem, subIndex) => {
      const subLabelInput = subItem.querySelector('input[name*="[label]"]');
      const subUrlInput = subItem.querySelector('input[name*="[url]"]');
      
      if (subLabelInput) subLabelInput.name = `header_menu[${index}][submenu][${subIndex}][label]`;
      if (subUrlInput) subUrlInput.name = `header_menu[${index}][submenu][${subIndex}][url]`;
    });
  });
}

// Re-index footer menu items after drag
function reindexFooterMenu() {
  const container = document.getElementById('footer-menu-container');
  const items = container.querySelectorAll('.footer-menu-item');
  
  items.forEach((item, index) => {
    const labelInput = item.querySelector('input[name*="[label]"]');
    const urlInput = item.querySelector('input[name*="[url]"]');
    
    if (labelInput) labelInput.name = `footer_menu[${index}][label]`;
    if (urlInput) urlInput.name = `footer_menu[${index}][url]`;
  });
}

// Initialize sortable for submenu containers
function initializeSubmenuSortable() {
  document.querySelectorAll('.submenu-container').forEach(container => {
    if (container.dataset.sortableInit) return;
    container.dataset.sortableInit = 'true';
    
    new Sortable(container, {
      animation: 150,
      ghostClass: 'sortable-ghost',
      chosenClass: 'sortable-chosen',
      onEnd: function() {
        reindexHeaderMenu();
      }
    });
  });
}

// Override addSubmenu to also init sortable on new submenus
const originalAddSubmenu = addSubmenu;
addSubmenu = function(btn, parentIndex) {
  originalAddSubmenu(btn, parentIndex);
  setTimeout(initializeSubmenuSortable, 10);
};

// Override addHeaderMenuItem to reinit sortable
const originalAddHeaderMenuItem = addHeaderMenuItem;
addHeaderMenuItem = function() {
  originalAddHeaderMenuItem();
  setTimeout(initializeSubmenuSortable, 10);
};
</script>

<style>
/* Sortable styles for menu items */
.sortable-ghost {
  opacity: 0.4;
  background-color: #c8ebfb !important;
}

.sortable-chosen {
  background-color: #f0f9ff !important;
}

.sortable-drag {
  background-color: #fff !important;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

.drag-handle:hover {
  color: #4f46e5;
}

/* Submenu drag styles */
.submenu-item {
  cursor: move;
  transition: background-color 0.2s;
}

.submenu-item:hover {
  background-color: #f3f4f6;
  border-radius: 0.375rem;
}
</style>

@include('admin.partials.collapsible-scripts', ['pageKey' => 'site_settings'])
@endsection

