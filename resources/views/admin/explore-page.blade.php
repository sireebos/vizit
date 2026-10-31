<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Explore Page - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Edit Explore Page</h1>
      <a href="{{ route('explore') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        <i class="fas fa-eye mr-2"></i>View Page
      </a>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <!-- Reset to Defaults -->
    @include('admin.partials.reset-button', ['resetRoute' => route('admin.explore-page.reset')])

    <form action="{{ route('admin.explore-page.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Page Styles Section -->
      @include('admin.partials.page-styles-section', ['pageSettings' => $page])

      <!-- Section Order (Drag & Drop) -->
      @include('admin.partials.section-order', ['pageSettings' => $page])

      {{-- SEO Settings --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">SEO Settings</h2>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Page Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
            <textarea name="seo_description" rows="2" class="w-full border rounded px-3 py-2">{{ old('seo_description', $page->seo_description) }}</textarea>
          </div>
        </div>
      </div>

      {{-- Hero Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Hero Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[hero][visible]" value="0">
            <input type="checkbox" name="sections[hero][visible]" value="1" {{ $page->visible('hero') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
            <input type="text" name="content[hero_title]" value="{{ old('content.hero_title', $page->content('hero_title', 'Explore')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          @include('admin.partials.image-upload-field', ['name' => 'content[hero_image]', 'label' => 'Poster/Fallback Image', 'value' => $page->content('hero_image', url('/assets/img/7.jpg'))])
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Background Video URL (MP4)</label>
            <input type="text" name="content[hero_video]" value="{{ old('content.hero_video', $page->content('hero_video', '')) }}" class="w-full border rounded px-3 py-2" placeholder="Leave empty to use default video" />
            <p class="text-xs text-gray-500 mt-1">Enter full URL to an MP4 video file or leave empty for default</p>
          </div>
        </div>
      </div>

      {{-- Intro Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Intro Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[intro][visible]" value="0">
            <input type="checkbox" name="sections[intro][visible]" value="1" {{ $page->visible('intro') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
              <input type="text" name="content[intro_subtitle]" value="{{ old('content.intro_subtitle', $page->content('intro_subtitle', 'elegant suites')) }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input type="text" name="content[intro_title]" value="{{ old('content.intro_title', $page->content('intro_title', 'Unpretentious luxury')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="content[intro_text]" rows="3" class="w-full border rounded px-3 py-2">{{ old('content.intro_text', $page->content('intro_text', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.')) }}</textarea>
          </div>
          @include('admin.partials.image-upload-field', ['name' => 'content[intro_image]', 'label' => 'Image', 'value' => $page->content('intro_image', url('/assets/img/rooms/room1.jpg'))])
        </div>
      </div>

      {{-- Features Section (Gallery Images) --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Features Gallery Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[features][visible]" value="0">
            <input type="checkbox" name="sections[features][visible]" value="1" {{ $page->visible('features') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          {{-- Feature 1 --}}
          <div class="border rounded p-4 bg-gray-50">
            <h4 class="font-medium text-gray-700 mb-3">Feature Image 1 (Left)</h4>
            @include('admin.partials.image-upload-field', ['name' => 'content[feature_1_image]', 'label' => 'Image', 'value' => $page->content('feature_1_image', '/assets/img/explore2.jpg')])
            <div class="mt-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
              <input type="text" name="content[feature_1_caption]" value="{{ old('content.feature_1_caption', $page->content('feature_1_caption', 'night life')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
          {{-- Feature 2 --}}
          <div class="border rounded p-4 bg-gray-50">
            <h4 class="font-medium text-gray-700 mb-3">Feature Image 2 (Right)</h4>
            @include('admin.partials.image-upload-field', ['name' => 'content[feature_2_image]', 'label' => 'Image', 'value' => $page->content('feature_2_image', '/assets/img/explore4.jpg')])
            <div class="mt-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
              <input type="text" name="content[feature_2_caption]" value="{{ old('content.feature_2_caption', $page->content('feature_2_caption', 'night life')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
          {{-- Feature 3 (Full Width) --}}
          <div class="border rounded p-4 bg-gray-50 md:col-span-2">
            <h4 class="font-medium text-gray-700 mb-3">Feature Image 3 (Full Width)</h4>
            @include('admin.partials.image-upload-field', ['name' => 'content[feature_3_image]', 'label' => 'Image', 'value' => $page->content('feature_3_image', '/assets/img/explore3.jpg')])
            <div class="mt-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
              <input type="text" name="content[feature_3_caption]" value="{{ old('content.feature_3_caption', $page->content('feature_3_caption', 'city view')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
        </div>
      </div>

      {{-- Rooms Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Rooms Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[rooms][visible]" value="0">
            <input type="checkbox" name="sections[rooms][visible]" value="1" {{ $page->visible('rooms') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle</label>
            <input type="text" name="content[rooms_subtitle]" value="{{ old('content.rooms_subtitle', $page->content('rooms_subtitle', 'luxury')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
            <input type="text" name="content[rooms_title]" value="{{ old('content.rooms_title', $page->content('rooms_title', 'Our rooms')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
        
        {{-- Room Data Info --}}
        <div class="border rounded p-4 bg-blue-50">
          <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
            <div>
              <h4 class="font-medium text-blue-800 mb-2">Room Data Source</h4>
              <p class="text-sm text-blue-700 mb-3">This section automatically displays up to 3 active room types from your database. To manage the rooms shown here:</p>
              <a href="{{ route('admin.room-types.index') }}" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-bed mr-2"></i>Manage Room Types
              </a>
            </div>
          </div>
          @if(isset($roomTypes) && $roomTypes->count() > 0)
          <div class="mt-4 pt-4 border-t border-blue-200">
            <p class="text-sm font-medium text-blue-800 mb-2">Currently displaying:</p>
            <ul class="text-sm text-blue-700 space-y-1">
              @foreach($roomTypes as $roomType)
              <li class="flex items-center">
                <i class="fas fa-check text-green-600 mr-2"></i>
                {{ $roomType->name }} - {{ config('hotel.currency_symbol', '₦') }}{{ number_format($roomType->base_price) }}
              </li>
              @endforeach
            </ul>
          </div>
          @else
          <div class="mt-4 pt-4 border-t border-blue-200">
            <p class="text-sm text-amber-700"><i class="fas fa-exclamation-triangle mr-2"></i>No active room types found. Fallback content will be displayed.</p>
          </div>
          @endif
        </div>
      </div>

      {{-- Services Banner Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Services Banner Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[services_banner][visible]" value="0">
            <input type="checkbox" name="sections[services_banner][visible]" value="1" {{ $page->visible('services_banner') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        
        {{-- Section Colors --}}
        <div class="border rounded p-4 bg-gray-50 mb-4">
          <h4 class="font-medium text-gray-700 mb-3"><i class="fas fa-palette mr-2"></i>Section Colors</h4>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
              <div class="flex items-center gap-2">
                <input type="color" name="content[services_banner_bg_color]" value="{{ $page->content('services_banner_bg_color', '#1a1a1a') }}" class="w-10 h-10 border rounded cursor-pointer" />
                <input type="text" value="{{ $page->content('services_banner_bg_color', '#1a1a1a') }}" class="w-full border rounded px-2 py-1 text-sm color-text-sync" readonly />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Text Color</label>
              <div class="flex items-center gap-2">
                <input type="color" name="content[services_banner_text_color]" value="{{ $page->content('services_banner_text_color', '#ffffff') }}" class="w-10 h-10 border rounded cursor-pointer" />
                <input type="text" value="{{ $page->content('services_banner_text_color', '#ffffff') }}" class="w-full border rounded px-2 py-1 text-sm color-text-sync" readonly />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Overlay Color</label>
              <div class="flex items-center gap-2">
                <input type="color" name="content[services_banner_overlay_color]" value="{{ $page->content('services_banner_overlay_color', '#000000') }}" class="w-10 h-10 border rounded cursor-pointer" />
                <input type="text" value="{{ $page->content('services_banner_overlay_color', '#000000') }}" class="w-full border rounded px-2 py-1 text-sm color-text-sync" readonly />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Overlay Opacity (%)</label>
              <input type="number" name="content[services_banner_overlay_opacity]" value="{{ $page->content('services_banner_overlay_opacity', '50') }}" min="0" max="100" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @for($i = 1; $i <= 4; $i++)
          <div class="border rounded p-4 bg-gray-50">
            <h4 class="font-medium text-gray-700 mb-3">Service {{ $i }}</h4>
            @include('admin.partials.image-upload-field', ['name' => 'content[service_'.$i.'_image]', 'label' => 'Image', 'value' => $page->content('service_'.$i.'_image', '/assets/img/ser-'.$i.'.jpg')])
            <div class="mt-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input type="text" name="content[service_{{ $i }}_title]" value="{{ old('content.service_'.$i.'_title', $page->content('service_'.$i.'_title', $i == 1 ? 'spa salon' : ($i == 2 ? 'restaurant' : ($i == 3 ? 'pool' : 'activities')))) }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div class="mt-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Link URL</label>
              <input type="text" name="content[service_{{ $i }}_url]" value="{{ old('content.service_'.$i.'_url', $page->content('service_'.$i.'_url', '')) }}" class="w-full border rounded px-3 py-2" placeholder="Leave empty for services page" />
            </div>
          </div>
          @endfor
        </div>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
          <i class="fas fa-save mr-2"></i>Save Changes
        </button>
      </div>
    </form>
  </div>
  @include('admin.partials.image-upload-script')
  @include('admin.partials.admin-collapsible', ['pageKey' => 'explore_page'])
  
  <script>
    // Sync color picker with text input
    document.querySelectorAll('input[type="color"]').forEach(colorInput => {
      const textInput = colorInput.parentElement.querySelector('.color-text-sync');
      if (textInput) {
        colorInput.addEventListener('input', function() {
          textInput.value = this.value;
        });
      }
    });
  </script>
</body>
</html>

