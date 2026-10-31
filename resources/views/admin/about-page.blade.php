@extends('layouts.app')

@section('content')
@include('admin.partials.sidebar')

<div class="ml-64 min-h-screen bg-gray-50 py-8">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900">About Page Editor</h1>
      <p class="mt-2 text-gray-600">Edit content and toggle sections on/off</p>
    </div>

    @if (session('status'))
      <div class="mb-6 bg-green-50 text-green-800 border border-green-200 px-4 py-3 rounded">{{ session('status') }}</div>
    @endif

    <!-- Reset to Defaults -->
    @include('admin.partials.reset-button', ['resetRoute' => route('admin.about-page.reset')])

    <form method="POST" action="{{ route('admin.about-page.update') }}" class="space-y-8" enctype="multipart/form-data">
      @csrf

      <!-- Page Styles Section -->
      @include('admin.partials.page-styles-section', ['pageSettings' => $about])

      <!-- Section Order (Drag & Drop) -->
      @include('admin.partials.section-order', ['pageSettings' => $about])

      <!-- SEO -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="seo-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-search mr-2 text-green-600"></i>SEO / Page Title
          </h2>
          <div class="flex items-center gap-4">
            <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
              <input type="hidden" name="sections[page_title][visible]" value="0">
              <input type="checkbox" name="sections[page_title][visible]" value="1" {{ ($about->sections['page_title']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="text-gray-600">Show</span>
            </label>
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
          </div>
        </button>
        <div id="seo-section" class="section-content p-6">
        <div class="grid grid-cols-1 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $about->seo_title) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
            <textarea name="seo_description" rows="3" class="w-full border rounded px-3 py-2">{{ old('seo_description', $about->seo_description) }}</textarea>
          </div>
        </div>
        </div>
      </div>

      @php $sectionsData = $about->sections ?? []; @endphp

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
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
            <input type="text" name="content[hero_title]" value="{{ old('content.hero_title', $about->content('hero_title', 'About Us')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Video URL (MP4)</label>
            <input type="text" name="content[hero_video]" value="{{ old('content.hero_video', $about->content('hero_video', 'video/video-about.mp4')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Hero Background Image</label>
            @if($about->content('hero_background'))
              <div class="mb-2">
                <img src="{{ \App\Helpers\ImageHelper::url($about->content('hero_background')) }}" alt="Current background" class="h-32 object-cover rounded">
              </div>
            @endif
            <input type="file" name="images[hero_background]" accept="image/*" class="w-full border rounded px-3 py-2" />
            <p class="text-xs text-gray-500 mt-1">Recommended size: 1920x1080px. Leave empty to keep current image.</p>
          </div>
        </div>
        </div>
      </div>

      <!-- VIDEO PRESENTATION SECTION -->
      <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
        <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="video-presentation-section">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-video mr-2 text-red-600"></i>Video Presentation Section
          </h2>
          <div class="flex items-center gap-4">
            <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
              <input type="hidden" name="sections[video_presentation][visible]" value="0">
              <input type="checkbox" name="sections[video_presentation][visible]" value="1" {{ ($sectionsData['video_presentation']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="text-gray-600">Show</span>
            </label>
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
          </div>
        </button>
        <div id="video-presentation-section" class="section-content p-6">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
            <input type="text" name="content[video_subtitle]" value="{{ old('content.video_subtitle', $about->content('video_subtitle', 'A new dimension of luxury.')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Duration Text</label>
            <input type="text" name="content[video_duration]" value="{{ old('content.video_duration', $about->content('video_duration', 'our presentation, 0:48 min')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Video Link (Vimeo/YouTube)</label>
            <input type="text" name="content[video_link]" value="{{ old('content.video_link', $about->content('video_link', 'https://vimeo.com/54851233')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
        </div>
      </div>

      <!-- ABOUT SERVICES SECTION -->
      @include('admin.partials.about-services', ['about' => $about, 'sectionsData' => $sectionsData])

      <!-- HISTORY SECTION -->
      @include('admin.partials.about-history', ['about' => $about, 'sectionsData' => $sectionsData])

      <!-- FEATURES PAIR SECTION -->
      @include('admin.partials.about-features-pair', ['about' => $about, 'sectionsData' => $sectionsData])

      <!-- QUOTES SECTION -->
      @include('admin.partials.about-quotes', ['about' => $about, 'sectionsData' => $sectionsData])

      <!-- SERVICES GRID SECTION -->
      @include('admin.partials.about-services-grid', ['about' => $about, 'sectionsData' => $sectionsData])

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

@include('admin.partials.collapsible-scripts', ['pageKey' => 'about_page'])
@endsection

