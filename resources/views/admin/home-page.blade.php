@extends('layouts.app')

@section('content')
@include('admin.partials.sidebar')

<div class="ml-64 min-h-screen bg-gray-50 py-8">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Home Page Editor</h1>
      <p class="mt-2 text-gray-600">Edit content and toggle sections on/off</p>
    </div>

    @if (session('status'))
      <div class="mb-6 bg-green-50 text-green-800 border border-green-200 px-4 py-3 rounded">{{ session('status') }}</div>
    @endif

    <!-- Reset to Defaults -->
    @include('admin.partials.reset-button', ['resetRoute' => route('admin.home-page.reset')])

    <form method="POST" action="{{ route('admin.home-page.update') }}" class="space-y-8" enctype="multipart/form-data">
      @csrf

      <!-- Page Styles Section -->
      @include('admin.partials.page-styles-section', ['pageSettings' => $home])

      <!-- Section Order (Drag & Drop) -->
      @include('admin.partials.section-order', ['pageSettings' => $home])

      <!-- SEO -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="seo-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-search mr-2 text-green-600"></i>SEO / Page Title
          </h2>
          <div class="flex items-center gap-4">
            <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
              <input type="hidden" name="sections[page_title][visible]" value="0">
              <input type="checkbox" name="sections[page_title][visible]" value="1" {{ ($home->sections['page_title']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="text-gray-600">Show</span>
            </label>
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
          </div>
        </button>
        <div id="seo-section" class="section-content p-6">
        <div class="grid grid-cols-1 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $home->seo_title) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
            <textarea name="seo_description" rows="3" class="w-full border rounded px-3 py-2">{{ old('seo_description', $home->seo_description) }}</textarea>
          </div>
        </div>
        </div>
      </div>

      @php $sectionsData = $home->sections ?? []; @endphp

      <!-- HERO SECTION -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="hero-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-image mr-2 text-indigo-600"></i>Hero Section
          </h2>
          <div class="flex items-center gap-4">
            <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
              <input type="hidden" name="sections[hero][visible]" value="0">
              <input type="checkbox" name="sections[hero][visible]" value="1" {{ ($sectionsData['hero']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="text-gray-600">Show</span>
            </label>
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
          </div>
        </button>
        <div id="hero-section" class="section-content p-6">
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hero Title (HTML allowed, use &lt;br&gt; for line breaks)</label>
            <input type="text" name="content[hero_title]" value="{{ old('content.hero_title', $home->content('hero_title', 'For the Joy<br>of Life')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          
          <!-- Hero Type Selection -->
          <div class="border-t pt-4 mt-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Hero Display Type</label>
            <div class="flex gap-4">
              <label class="inline-flex items-center">
                <input type="radio" name="content[hero_type]" value="default" {{ $home->content('hero_type', 'default') === 'default' ? 'checked' : '' }} class="mr-2 text-blue-600 focus:ring-blue-500" onchange="toggleHeroType(this.value)">
                <span class="text-gray-700">Single Image (Default)</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="content[hero_type]" value="slider" {{ $home->content('hero_type', 'default') === 'slider' ? 'checked' : '' }} class="mr-2 text-blue-600 focus:ring-blue-500" onchange="toggleHeroType(this.value)">
                <span class="text-gray-700">Image Slider/Carousel</span>
              </label>
            </div>
          </div>

          <!-- Default Single Image -->
          <div id="hero-default-options" class="{{ $home->content('hero_type', 'default') === 'slider' ? 'hidden' : '' }}">
            <label class="block text-sm font-medium text-gray-700 mb-1">Hero Background Image</label>
            @if($home->content('hero_background'))
              <div class="mb-2">
                <img src="{{ \App\Helpers\ImageHelper::url($home->content('hero_background')) }}" alt="Current background" class="h-32 object-cover rounded">
              </div>
            @endif
            <input type="file" name="images[hero_background]" accept="image/*" class="w-full border rounded px-3 py-2" />
            <p class="text-xs text-gray-500 mt-1">Recommended size: 1920x1080px. Leave empty to keep current image.</p>
          </div>

          <!-- Slider Options -->
          <div id="hero-slider-options" class="{{ $home->content('hero_type', 'default') === 'slider' ? '' : 'hidden' }}">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
              <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-2"></i>
                <p class="text-sm text-blue-700">Upload multiple images for the hero slider. Each slide can have its own title and subtitle. Drag to reorder slides.</p>
              </div>
            </div>

            <!-- Slider Settings -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Autoplay Speed (ms)</label>
                <input type="number" name="content[hero_slider_speed]" value="{{ old('content.hero_slider_speed', $home->content('hero_slider_speed', 5000)) }}" min="1000" step="500" class="w-full border rounded px-3 py-2" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Transition Effect</label>
                <select name="content[hero_slider_effect]" class="w-full border rounded px-3 py-2">
                  <option value="fade" {{ $home->content('hero_slider_effect', 'fade') === 'fade' ? 'selected' : '' }}>Fade</option>
                  <option value="slide" {{ $home->content('hero_slider_effect') === 'slide' ? 'selected' : '' }}>Slide</option>
                  <option value="fadeUp" {{ $home->content('hero_slider_effect') === 'fadeUp' ? 'selected' : '' }}>Fade Up</option>
                  <option value="backSlide" {{ $home->content('hero_slider_effect') === 'backSlide' ? 'selected' : '' }}>Back Slide</option>
                  <option value="goDown" {{ $home->content('hero_slider_effect') === 'goDown' ? 'selected' : '' }}>Go Down</option>
                  <option value="scaleUp" {{ $home->content('hero_slider_effect') === 'scaleUp' ? 'selected' : '' }}>Scale Up</option>
                  <option value="kenburns" {{ $home->content('hero_slider_effect') === 'kenburns' ? 'selected' : '' }}>Ken Burns (Video-like)</option>
                  <option value="zoomOut" {{ $home->content('hero_slider_effect') === 'zoomOut' ? 'selected' : '' }}>Zoom Out</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Show Navigation</label>
                <select name="content[hero_slider_nav]" class="w-full border rounded px-3 py-2">
                  <option value="1" {{ $home->content('hero_slider_nav', '1') === '1' ? 'selected' : '' }}>Yes</option>
                  <option value="0" {{ $home->content('hero_slider_nav') === '0' ? 'selected' : '' }}>No</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Show Pagination Dots</label>
                <select name="content[hero_slider_dots]" class="w-full border rounded px-3 py-2">
                  <option value="1" {{ $home->content('hero_slider_dots', '1') === '1' ? 'selected' : '' }}>Yes</option>
                  <option value="0" {{ $home->content('hero_slider_dots') === '0' ? 'selected' : '' }}>No</option>
                </select>
              </div>
            </div>

            <!-- Overlay Settings -->
            <div class="border-t pt-4 mt-2 mb-4">
              <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-layer-group mr-2"></i>Overlay Settings</h4>
              <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Overlay Color</label>
                  <div class="flex gap-2">
                    <input type="color" name="content[hero_overlay_color]" value="{{ $home->content('hero_overlay_color', '#000000') }}" class="h-10 w-16 border rounded cursor-pointer" />
                    <input type="text" name="content[hero_overlay_color_text]" value="{{ $home->content('hero_overlay_color', '#000000') }}" class="flex-1 border rounded px-3 py-2 text-sm" placeholder="#000000" onchange="this.previousElementSibling.value = this.value" />
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Overlay Opacity (%)</label>
                  <input type="range" name="content[hero_overlay_opacity]" value="{{ $home->content('hero_overlay_opacity', 30) }}" min="0" max="100" step="5" class="w-full" oninput="this.nextElementSibling.textContent = this.value + '%'" />
                  <span class="text-sm text-gray-500">{{ $home->content('hero_overlay_opacity', 30) }}%</span>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Overlay Blend Mode</label>
                  <select name="content[hero_overlay_blend]" class="w-full border rounded px-3 py-2">
                    <option value="normal" {{ $home->content('hero_overlay_blend', 'normal') === 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="multiply" {{ $home->content('hero_overlay_blend') === 'multiply' ? 'selected' : '' }}>Multiply</option>
                    <option value="screen" {{ $home->content('hero_overlay_blend') === 'screen' ? 'selected' : '' }}>Screen</option>
                    <option value="overlay" {{ $home->content('hero_overlay_blend') === 'overlay' ? 'selected' : '' }}>Overlay</option>
                    <option value="darken" {{ $home->content('hero_overlay_blend') === 'darken' ? 'selected' : '' }}>Darken</option>
                    <option value="lighten" {{ $home->content('hero_overlay_blend') === 'lighten' ? 'selected' : '' }}>Lighten</option>
                    <option value="color-dodge" {{ $home->content('hero_overlay_blend') === 'color-dodge' ? 'selected' : '' }}>Color Dodge</option>
                    <option value="color-burn" {{ $home->content('hero_overlay_blend') === 'color-burn' ? 'selected' : '' }}>Color Burn</option>
                    <option value="hard-light" {{ $home->content('hero_overlay_blend') === 'hard-light' ? 'selected' : '' }}>Hard Light</option>
                    <option value="soft-light" {{ $home->content('hero_overlay_blend') === 'soft-light' ? 'selected' : '' }}>Soft Light</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Gradient Overlay</label>
                  <select name="content[hero_overlay_gradient]" class="w-full border rounded px-3 py-2">
                    <option value="none" {{ $home->content('hero_overlay_gradient', 'none') === 'none' ? 'selected' : '' }}>None</option>
                    <option value="top-bottom" {{ $home->content('hero_overlay_gradient') === 'top-bottom' ? 'selected' : '' }}>Top to Bottom</option>
                    <option value="bottom-top" {{ $home->content('hero_overlay_gradient') === 'bottom-top' ? 'selected' : '' }}>Bottom to Top</option>
                    <option value="left-right" {{ $home->content('hero_overlay_gradient') === 'left-right' ? 'selected' : '' }}>Left to Right</option>
                    <option value="radial" {{ $home->content('hero_overlay_gradient') === 'radial' ? 'selected' : '' }}>Radial (Center)</option>
                    <option value="radial-corner" {{ $home->content('hero_overlay_gradient') === 'radial-corner' ? 'selected' : '' }}>Radial (Corner)</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Overlay Image/Pattern -->
            <div class="border-t pt-4 mt-2 mb-4">
              <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-image mr-2"></i>Overlay Image/Pattern (Optional)</h4>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Overlay Pattern</label>
                  <select name="content[hero_overlay_pattern]" class="w-full border rounded px-3 py-2">
                    <option value="none" {{ $home->content('hero_overlay_pattern', 'none') === 'none' ? 'selected' : '' }}>None</option>
                    <option value="dots" {{ $home->content('hero_overlay_pattern') === 'dots' ? 'selected' : '' }}>Dots</option>
                    <option value="lines" {{ $home->content('hero_overlay_pattern') === 'lines' ? 'selected' : '' }}>Diagonal Lines</option>
                    <option value="grid" {{ $home->content('hero_overlay_pattern') === 'grid' ? 'selected' : '' }}>Grid</option>
                    <option value="noise" {{ $home->content('hero_overlay_pattern') === 'noise' ? 'selected' : '' }}>Noise/Grain</option>
                    <option value="custom" {{ $home->content('hero_overlay_pattern') === 'custom' ? 'selected' : '' }}>Custom Image</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Pattern Opacity (%)</label>
                  <input type="range" name="content[hero_pattern_opacity]" value="{{ $home->content('hero_pattern_opacity', 20) }}" min="0" max="100" step="5" class="w-full" oninput="this.nextElementSibling.textContent = this.value + '%'" />
                  <span class="text-sm text-gray-500">{{ $home->content('hero_pattern_opacity', 20) }}%</span>
                </div>
                <div id="hero-custom-overlay-upload" class="{{ $home->content('hero_overlay_pattern') === 'custom' ? '' : 'hidden' }}">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Custom Overlay Image</label>
                  @if($home->content('hero_overlay_image'))
                    <img src="{{ \App\Helpers\ImageHelper::url($home->content('hero_overlay_image')) }}" alt="Overlay" class="h-12 mb-1 rounded">
                  @endif
                  <input type="file" name="images[hero_overlay_image]" accept="image/*" class="w-full text-sm border rounded px-2 py-1" />
                </div>
              </div>
            </div>

            <!-- Existing Slides -->
            @php $heroSlides = $home->getHeroSlides(); @endphp
            <div id="hero-slides-container" class="space-y-4">
              @forelse($heroSlides as $index => $slide)
              <div class="hero-slide-item bg-gray-50 border rounded-lg p-4" data-index="{{ $index }}">
                <div class="flex justify-between items-start mb-3">
                  <div class="flex items-center gap-2">
                    <i class="fas fa-grip-vertical text-gray-400 cursor-move hero-slide-handle"></i>
                    <span class="font-medium text-gray-700">Slide {{ $index + 1 }}</span>
                  </div>
                  <button type="button" onclick="removeHeroSlide(this)" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div>
                    @if(!empty($slide['image']))
                    <img src="{{ \App\Helpers\ImageHelper::url($slide['image']) }}" alt="Slide {{ $index + 1 }}" class="h-24 w-full object-cover rounded mb-2">
                    <input type="hidden" name="hero_slides[{{ $index }}][existing_image]" value="{{ $slide['image'] }}">
                    @endif
                    <input type="file" name="hero_slides[{{ $index }}][image]" accept="image/*" class="w-full text-sm border rounded px-2 py-1" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Slide Title (optional)</label>
                    <input type="text" name="hero_slides[{{ $index }}][title]" value="{{ $slide['title'] ?? '' }}" class="w-full border rounded px-3 py-2 text-sm" placeholder="Slide specific title" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Slide Subtitle (optional)</label>
                    <input type="text" name="hero_slides[{{ $index }}][subtitle]" value="{{ $slide['subtitle'] ?? '' }}" class="w-full border rounded px-3 py-2 text-sm" placeholder="Slide specific subtitle" />
                  </div>
                </div>
              </div>
              @empty
              <p class="text-gray-500 text-sm" id="no-slides-message">No slides added yet. Click "Add Slide" to create your first slide.</p>
              @endforelse
            </div>

            <!-- Add Slide Button -->
            <button type="button" onclick="addHeroSlide()" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
              <i class="fas fa-plus mr-2"></i> Add Slide
            </button>
          </div>
        </div>
        </div>
      </div>

      <!-- BOOKING BAR SECTION -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="booking-bar-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-calendar-check mr-2 text-orange-600"></i>Booking Bar
          </h2>
          <div class="flex items-center gap-4">
            <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
              <input type="hidden" name="sections[booking_bar][visible]" value="0">
              <input type="checkbox" name="sections[booking_bar][visible]" value="1" {{ ($sectionsData['booking_bar']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="text-gray-600">Show</span>
            </label>
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
          </div>
        </button>
        <div id="booking-bar-section" class="section-content p-6">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
            <input type="text" name="content[booking_button_text]" value="{{ old('content.booking_button_text', $home->content('booking_button_text', 'book now')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
            <input type="text" name="content[booking_button_link]" value="{{ old('content.booking_button_link', $home->content('booking_button_link', '/search')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
        </div>
      </div>

      <!-- INTRO SECTION -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="intro-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-info-circle mr-2 text-teal-600"></i>Intro Section
          </h2>
          <div class="flex items-center gap-4">
            <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
              <input type="hidden" name="sections[intro][visible]" value="0">
              <input type="checkbox" name="sections[intro][visible]" value="1" {{ ($sectionsData['intro']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="text-gray-600">Show</span>
            </label>
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
          </div>
        </button>
        <div id="intro-section" class="section-content p-6">
        <div class="grid grid-cols-1 gap-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
              <input type="text" name="content[intro_subtitle]" value="{{ old('content.intro_subtitle', $home->content('intro_subtitle', 'welcome')) }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input type="text" name="content[intro_title]" value="{{ old('content.intro_title', $home->content('intro_title', 'Vermon Hotel Bar')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Text</label>
            <textarea name="content[intro_text]" rows="3" class="w-full border rounded px-3 py-2">{{ old('content.intro_text', $home->content('intro_text', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')) }}</textarea>
          </div>
          @include('admin.partials.image-upload-field', ['name' => 'content[intro_image]', 'label' => 'Image', 'value' => $home->content('intro_image', '')])
        </div>
        </div>
      </div>

      <!-- FEATURES PAIR SECTION -->
      @include('admin.partials.home-features-pair', ['home' => $home, 'sectionsData' => $sectionsData])

      <!-- SERVICES GRID SECTION -->
      @include('admin.partials.home-services-grid', ['home' => $home, 'sectionsData' => $sectionsData])

      <!-- FEATURES GRID SECTION -->
      @include('admin.partials.home-features-grid', ['home' => $home, 'sectionsData' => $sectionsData])

      <!-- PARALLAX CTA SECTION -->
      @include('admin.partials.home-parallax-cta', ['home' => $home, 'sectionsData' => $sectionsData])

      <!-- ROOMS SECTION -->
      @include('admin.partials.home-rooms', ['home' => $home, 'sectionsData' => $sectionsData])

      <!-- QUOTES SECTION -->
      @include('admin.partials.home-quotes', ['home' => $home, 'sectionsData' => $sectionsData])

      <!-- VIDEO SECTION -->
      @include('admin.partials.home-video', ['home' => $home, 'sectionsData' => $sectionsData])

      <!-- RESTAURANTS SECTION -->
      @include('admin.partials.home-restaurants', ['home' => $home, 'sectionsData' => $sectionsData])

      <div class="flex justify-end">
        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script>
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

      // Show uploading state
      nameSpan.textContent = 'Uploading...';

      // Create form data
      const formData = new FormData();
      formData.append('image', file);
      formData.append('_token', '{{ csrf_token() }}');

      fetch('{{ route("admin.upload-image") }}', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
          return response.json();
        }
        // If not JSON, throw error with status
        throw new Error(`Server error (${response.status}). Please try again or check file size.`);
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

// Hero Slider Functions
function toggleHeroType(type) {
  const defaultOptions = document.getElementById('hero-default-options');
  const sliderOptions = document.getElementById('hero-slider-options');
  
  if (type === 'slider') {
    defaultOptions.classList.add('hidden');
    sliderOptions.classList.remove('hidden');
  } else {
    defaultOptions.classList.remove('hidden');
    sliderOptions.classList.add('hidden');
  }
}

let heroSlideIndex = {{ count($home->getHeroSlides()) }};

function addHeroSlide() {
  const container = document.getElementById('hero-slides-container');
  const noSlidesMessage = document.getElementById('no-slides-message');
  if (noSlidesMessage) noSlidesMessage.remove();

  const slideHtml = `
    <div class="hero-slide-item bg-gray-50 border rounded-lg p-4" data-index="${heroSlideIndex}">
      <div class="flex justify-between items-start mb-3">
        <div class="flex items-center gap-2">
          <i class="fas fa-grip-vertical text-gray-400 cursor-move hero-slide-handle"></i>
          <span class="font-medium text-gray-700">Slide ${heroSlideIndex + 1}</span>
        </div>
        <button type="button" onclick="removeHeroSlide(this)" class="text-red-500 hover:text-red-700">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <input type="file" name="hero_slides[${heroSlideIndex}][image]" accept="image/*" class="w-full text-sm border rounded px-2 py-1" required />
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-600 mb-1">Slide Title (optional)</label>
          <input type="text" name="hero_slides[${heroSlideIndex}][title]" class="w-full border rounded px-3 py-2 text-sm" placeholder="Slide specific title" />
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-600 mb-1">Slide Subtitle (optional)</label>
          <input type="text" name="hero_slides[${heroSlideIndex}][subtitle]" class="w-full border rounded px-3 py-2 text-sm" placeholder="Slide specific subtitle" />
        </div>
      </div>
    </div>
  `;
  
  container.insertAdjacentHTML('beforeend', slideHtml);
  heroSlideIndex++;
  updateSlideNumbers();
}

function removeHeroSlide(button) {
  const slideItem = button.closest('.hero-slide-item');
  slideItem.remove();
  updateSlideNumbers();
  
  // Show "no slides" message if empty
  const container = document.getElementById('hero-slides-container');
  if (container.querySelectorAll('.hero-slide-item').length === 0) {
    container.innerHTML = '<p class="text-gray-500 text-sm" id="no-slides-message">No slides added yet. Click "Add Slide" to create your first slide.</p>';
  }
}

function updateSlideNumbers() {
  const slides = document.querySelectorAll('.hero-slide-item');
  slides.forEach((slide, index) => {
    slide.querySelector('.font-medium').textContent = `Slide ${index + 1}`;
    // Update input names to maintain correct indices
    slide.querySelectorAll('input[name^="hero_slides["]').forEach(input => {
      input.name = input.name.replace(/hero_slides\[\d+\]/, `hero_slides[${index}]`);
    });
  });
}

// Initialize Sortable for slides (if SortableJS is available)
document.addEventListener('DOMContentLoaded', function() {
  const slidesContainer = document.getElementById('hero-slides-container');
  if (slidesContainer && typeof Sortable !== 'undefined') {
    new Sortable(slidesContainer, {
      animation: 150,
      handle: '.hero-slide-handle',
      onEnd: updateSlideNumbers
    });
  }

  // Toggle custom overlay image upload
  const patternSelect = document.querySelector('select[name="content[hero_overlay_pattern]"]');
  const customUpload = document.getElementById('hero-custom-overlay-upload');
  if (patternSelect && customUpload) {
    patternSelect.addEventListener('change', function() {
      customUpload.classList.toggle('hidden', this.value !== 'custom');
    });
  }

  // Sync color picker with text input
  const colorPicker = document.querySelector('input[name="content[hero_overlay_color]"]');
  const colorText = document.querySelector('input[name="content[hero_overlay_color_text]"]');
  if (colorPicker && colorText) {
    colorPicker.addEventListener('input', function() {
      colorText.value = this.value;
    });
  }
});
</script>

@include('admin.partials.collapsible-scripts', ['pageKey' => 'home_page'])
@endsection

