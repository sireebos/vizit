<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Services Page - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Edit Services Page</h1>
      <a href="{{ route('services') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        <i class="fas fa-eye mr-2"></i>View Page
      </a>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <!-- Reset to Defaults -->
    @include('admin.partials.reset-button', ['resetRoute' => route('admin.services-page.reset')])

    <form action="{{ route('admin.services-page.update') }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="content[hero_title]" value="{{ old('content.hero_title', $page->content('hero_title', 'Services')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          @include('admin.partials.image-upload-field', ['name' => 'content[hero_image]', 'label' => 'Background Image', 'value' => $page->content('hero_image', url('/assets/img/3.jpg'))])
        </div>
      </div>

      {{-- Video Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Video Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[video][visible]" value="0">
            <input type="checkbox" name="sections[video][visible]" value="1" {{ $page->visible('video') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
            <input type="text" name="content[video_tagline]" value="{{ old('content.video_tagline', $page->content('video_tagline', 'A new dimension of luxury.')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Video Label</label>
            <input type="text" name="content[video_label]" value="{{ old('content.video_label', $page->content('video_label', 'our presentation, 0:48 min')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
            <input type="text" name="content[video_url]" value="{{ old('content.video_url', $page->content('video_url', 'https://vimeo.com/54851233')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
      </div>

      {{-- Services Grid Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Services Grid Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[services_boxes][visible]" value="0">
            <input type="checkbox" name="sections[services_boxes][visible]" value="1" {{ $page->visible('services_boxes') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
            <input type="text" name="content[services_subtitle]" value="{{ old('content.services_subtitle', $page->content('services_subtitle', 'elegant suites')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="content[services_title]" value="{{ old('content.services_title', $page->content('services_title', 'Unpretentious luxury')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>

        {{-- Dynamic Service Boxes --}}
        @php $boxesCount = (int) $page->content('boxes_count', 6); @endphp
        <input type="hidden" name="content[boxes_count]" id="boxes-count" value="{{ $boxesCount }}">

        <div id="boxes-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          @for($i = 1; $i <= $boxesCount; $i++)
          <div class="box-item border rounded-lg p-4 bg-gray-50" data-index="{{ $i }}">
            <div class="flex justify-between items-center mb-3">
              <h4 class="font-semibold text-gray-700">Box <span class="box-number">{{ $i }}</span></h4>
              <button type="button" class="remove-box-btn text-red-600 hover:text-red-800" title="Remove Box">
                <i class="fas fa-trash"></i>
              </button>
            </div>
            <div class="space-y-3">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="content[box{{ $i }}_title]" value="{{ old('content.box'.$i.'_title', $page->content('box'.$i.'_title', '')) }}" class="w-full border rounded px-3 py-2 box-title" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="content[box{{ $i }}_description]" rows="2" class="w-full border rounded px-3 py-2 box-description">{{ old('content.box'.$i.'_description', $page->content('box'.$i.'_description', '')) }}</textarea>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                <input type="text" name="content[box{{ $i }}_button]" value="{{ old('content.box'.$i.'_button', $page->content('box'.$i.'_button', 'read more')) }}" class="w-full border rounded px-3 py-2 box-button" />
              </div>
              @include('admin.partials.image-upload-field', ['name' => 'content[box'.$i.'_icon]', 'label' => 'Icon (SVG)', 'value' => $page->content('box'.$i.'_icon', '')])
            </div>
          </div>
          @endfor
        </div>

        <button type="button" id="add-box-btn" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          <i class="fas fa-plus mr-2"></i>Add Box
        </button>

        {{-- Box Template --}}
        <template id="box-template">
          <div class="box-item border rounded-lg p-4 bg-gray-50" data-index="__INDEX__">
            <div class="flex justify-between items-center mb-3">
              <h4 class="font-semibold text-gray-700">Box <span class="box-number">__INDEX__</span></h4>
              <button type="button" class="remove-box-btn text-red-600 hover:text-red-800" title="Remove Box">
                <i class="fas fa-trash"></i>
              </button>
            </div>
            <div class="space-y-3">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="content[box__INDEX___title]" value="" class="w-full border rounded px-3 py-2 box-title" placeholder="Box title" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="content[box__INDEX___description]" rows="2" class="w-full border rounded px-3 py-2 box-description" placeholder="Box description"></textarea>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                <input type="text" name="content[box__INDEX___button]" value="read more" class="w-full border rounded px-3 py-2 box-button" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon URL</label>
                <input type="text" name="content[box__INDEX___icon]" value="" class="w-full border rounded px-3 py-2 box-icon" placeholder="Icon URL" />
              </div>
            </div>
          </div>
        </template>
      </div>

      {{-- Amenities Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Amenities Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[amenities][visible]" value="0">
            <input type="checkbox" name="sections[amenities][visible]" value="1" {{ $page->visible('amenities') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>

        @php
          $amenityDefaults = [
            ['icon' => '/assets/img/icons/1.svg', 'label' => 'no smoking'],
            ['icon' => '/assets/img/icons/2.svg', 'label' => 'big beds'],
            ['icon' => '/assets/img/icons/3.svg', 'label' => 'yacht riding'],
            ['icon' => '/assets/img/icons/4.svg', 'label' => 'free drinks'],
            ['icon' => '/assets/img/icons/5.svg', 'label' => 'swimming pool'],
            ['icon' => '/assets/img/icons/6.svg', 'label' => 'room breakfast'],
          ];
        @endphp
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          @for($i = 1; $i <= 6; $i++)
          <div class="border rounded-lg p-3 bg-gray-50 text-center">
            <h4 class="font-semibold text-gray-700 mb-2 text-sm">Amenity {{ $i }}</h4>
            <div class="space-y-2">
              <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Label</label>
                <input type="text" name="content[amenity{{ $i }}_label]" value="{{ old('content.amenity'.$i.'_label', $page->content('amenity'.$i.'_label', $amenityDefaults[$i-1]['label'])) }}" class="w-full border rounded px-2 py-1 text-sm" />
              </div>
              @include('admin.partials.image-upload-field', ['name' => 'content[amenity'.$i.'_icon]', 'label' => 'Icon', 'value' => $page->content('amenity'.$i.'_icon', $amenityDefaults[$i-1]['icon'])])
            </div>
          </div>
          @endfor
        </div>
      </div>

      {{-- Offers Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Offers Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[offers][visible]" value="0">
            <input type="checkbox" name="sections[offers][visible]" value="1" {{ $page->visible('offers') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
            <input type="text" name="content[offers_subtitle]" value="{{ old('content.offers_subtitle', $page->content('offers_subtitle', 'Excellent services')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="content[offers_title]" value="{{ old('content.offers_title', $page->content('offers_title', 'what we offer')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>

        {{-- Dynamic Service Offers --}}
        @php $offersCount = (int) $page->content('offers_count', 4); @endphp
        <input type="hidden" name="content[offers_count]" id="offers-count" value="{{ $offersCount }}">

        <div id="offers-container">
          @for($i = 1; $i <= $offersCount; $i++)
          <div class="offer-item border rounded-lg p-4 mb-4 bg-gray-50" data-index="{{ $i }}">
            <div class="flex justify-between items-center mb-3">
              <h3 class="font-semibold text-gray-700">Service <span class="offer-number">{{ $i }}</span></h3>
              <button type="button" class="remove-offer-btn text-red-600 hover:text-red-800" title="Remove Service">
                <i class="fas fa-trash"></i>
              </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="content[service{{ $i }}_title]" value="{{ old('content.service'.$i.'_title', $page->content('service'.$i.'_title', '')) }}" class="w-full border rounded px-3 py-2 offer-title" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                <input type="text" name="content[service{{ $i }}_button]" value="{{ old('content.service'.$i.'_button', $page->content('service'.$i.'_button', 'explore')) }}" class="w-full border rounded px-3 py-2 offer-button" />
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="content[service{{ $i }}_description]" rows="2" class="w-full border rounded px-3 py-2 offer-description">{{ old('content.service'.$i.'_description', $page->content('service'.$i.'_description', '')) }}</textarea>
              </div>
              <div class="md:col-span-2">
                @include('admin.partials.image-upload-field', ['name' => 'content[service'.$i.'_image]', 'label' => 'Image', 'value' => $page->content('service'.$i.'_image', '')])
              </div>
            </div>
          </div>
          @endfor
        </div>

        <button type="button" id="add-offer-btn" class="mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          <i class="fas fa-plus mr-2"></i>Add Service
        </button>

        {{-- Offer Template --}}
        <template id="offer-template">
          <div class="offer-item border rounded-lg p-4 mb-4 bg-gray-50" data-index="__INDEX__">
            <div class="flex justify-between items-center mb-3">
              <h3 class="font-semibold text-gray-700">Service <span class="offer-number">__INDEX__</span></h3>
              <button type="button" class="remove-offer-btn text-red-600 hover:text-red-800" title="Remove Service">
                <i class="fas fa-trash"></i>
              </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="content[service__INDEX___title]" value="" class="w-full border rounded px-3 py-2 offer-title" placeholder="Service title" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                <input type="text" name="content[service__INDEX___button]" value="explore" class="w-full border rounded px-3 py-2 offer-button" />
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="content[service__INDEX___description]" rows="2" class="w-full border rounded px-3 py-2 offer-description" placeholder="Service description"></textarea>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                <input type="text" name="content[service__INDEX___image]" value="" class="w-full border rounded px-3 py-2 offer-image" placeholder="Image URL" />
              </div>
            </div>
          </div>
        </template>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
          <i class="fas fa-save mr-2"></i>Save Changes
        </button>
      </div>
    </form>
  </div>
  @include('admin.partials.image-upload-script')
  @include('admin.partials.admin-collapsible', ['pageKey' => 'services_page'])

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Boxes dynamic functionality
    const boxesContainer = document.getElementById('boxes-container');
    const addBoxBtn = document.getElementById('add-box-btn');
    const boxTemplate = document.getElementById('box-template');
    const boxesCountInput = document.getElementById('boxes-count');

    function updateBoxNumbers() {
      const items = boxesContainer.querySelectorAll('.box-item');
      items.forEach((item, idx) => {
        const newIndex = idx + 1;
        item.dataset.index = newIndex;
        item.querySelector('.box-number').textContent = newIndex;
        item.querySelector('.box-title').name = `content[box${newIndex}_title]`;
        item.querySelector('.box-description').name = `content[box${newIndex}_description]`;
        item.querySelector('.box-button').name = `content[box${newIndex}_button]`;
        const iconField = item.querySelector('[name*="_icon"]');
        if (iconField) iconField.name = `content[box${newIndex}_icon]`;
      });
      boxesCountInput.value = items.length;
    }

    function addBoxRemoveListener(btn) {
      btn.addEventListener('click', function() {
        const items = boxesContainer.querySelectorAll('.box-item');
        if (items.length <= 1) {
          alert('You must have at least one box.');
          return;
        }
        btn.closest('.box-item').remove();
        updateBoxNumbers();
      });
    }

    boxesContainer.querySelectorAll('.remove-box-btn').forEach(addBoxRemoveListener);

    addBoxBtn.addEventListener('click', function() {
      const currentCount = boxesContainer.querySelectorAll('.box-item').length;
      const newIndex = currentCount + 1;
      const html = boxTemplate.innerHTML.replace(/__INDEX__/g, newIndex);
      boxesContainer.insertAdjacentHTML('beforeend', html);
      const newItem = boxesContainer.querySelector('.box-item:last-child');
      addBoxRemoveListener(newItem.querySelector('.remove-box-btn'));
      boxesCountInput.value = newIndex;
    });

    // Offers dynamic functionality
    const offersContainer = document.getElementById('offers-container');
    const addOfferBtn = document.getElementById('add-offer-btn');
    const offerTemplate = document.getElementById('offer-template');
    const offersCountInput = document.getElementById('offers-count');

    function updateOfferNumbers() {
      const items = offersContainer.querySelectorAll('.offer-item');
      items.forEach((item, idx) => {
        const newIndex = idx + 1;
        item.dataset.index = newIndex;
        item.querySelector('.offer-number').textContent = newIndex;
        item.querySelector('.offer-title').name = `content[service${newIndex}_title]`;
        item.querySelector('.offer-button').name = `content[service${newIndex}_button]`;
        item.querySelector('.offer-description').name = `content[service${newIndex}_description]`;
        const imgField = item.querySelector('[name*="_image"]');
        if (imgField) imgField.name = `content[service${newIndex}_image]`;
      });
      offersCountInput.value = items.length;
    }

    function addOfferRemoveListener(btn) {
      btn.addEventListener('click', function() {
        const items = offersContainer.querySelectorAll('.offer-item');
        if (items.length <= 1) {
          alert('You must have at least one service.');
          return;
        }
        btn.closest('.offer-item').remove();
        updateOfferNumbers();
      });
    }

    offersContainer.querySelectorAll('.remove-offer-btn').forEach(addOfferRemoveListener);

    addOfferBtn.addEventListener('click', function() {
      const currentCount = offersContainer.querySelectorAll('.offer-item').length;
      const newIndex = currentCount + 1;
      const html = offerTemplate.innerHTML.replace(/__INDEX__/g, newIndex);
      offersContainer.insertAdjacentHTML('beforeend', html);
      const newItem = offersContainer.querySelector('.offer-item:last-child');
      addOfferRemoveListener(newItem.querySelector('.remove-offer-btn'));
      offersCountInput.value = newIndex;
    });
  });
  </script>
</body>
</html>


