<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Search Page - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Edit Search Page</h1>
      <a href="{{ route('search') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        <i class="fas fa-eye mr-2"></i>View Page
      </a>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <!-- Reset to Defaults -->
    @include('admin.partials.reset-button', ['resetRoute' => route('admin.search-page.reset')])

    <form action="{{ route('admin.search-page.update') }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="content[hero_title]" value="{{ old('content.hero_title', $page->content('hero_title', 'Search')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          @include('admin.partials.image-upload-field', ['name' => 'content[hero_image]', 'label' => 'Background Image', 'value' => $page->content('hero_image', url('/assets/img/3.jpg'))])
        </div>
      </div>

      {{-- Search Results Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Search Results Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[search_results][visible]" value="0">
            <input type="checkbox" name="sections[search_results][visible]" value="1" {{ $page->visible('search_results') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
            <input type="text" name="content[search_subtitle]" value="{{ old('content.search_subtitle', $page->content('search_subtitle', 'elegant suites')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="content[search_title]" value="{{ old('content.search_title', $page->content('search_title', 'Search results')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
        <p class="text-gray-500 text-sm mt-3">Search results are dynamically generated from room listings.</p>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
          <i class="fas fa-save mr-2"></i>Save Changes
        </button>
      </div>
    </form>
  </div>
  @include('admin.partials.image-upload-script')
  @include('admin.partials.admin-collapsible', ['pageKey' => 'search_page'])
</body>
</html>

