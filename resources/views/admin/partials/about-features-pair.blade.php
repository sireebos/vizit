<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="about-features-pair-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-th-large mr-2 text-purple-600"></i>Features Pair Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[features_pair][visible]" value="0">
        <input type="checkbox" name="sections[features_pair][visible]" value="1" {{ ($sectionsData['features_pair']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="about-features-pair-section" class="section-content p-6">
  
  <h3 class="text-lg font-medium text-gray-800 mb-3">Feature 1 (Left Image)</h3>
  <div class="grid grid-cols-2 gap-4 mb-6">
    <div>
      @include('admin.partials.image-upload-field', ['name' => 'content[about_feature1_image]', 'label' => 'Image', 'value' => $about->content('about_feature1_image', url('/assets/img/room1.jpg'))])
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Image Label</label>
      <input type="text" name="content[about_feature1_label]" value="{{ old('content.about_feature1_label', $about->content('about_feature1_label', 'private pool suite')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
      <input type="text" name="content[about_feature1_title]" value="{{ old('content.about_feature1_title', $about->content('about_feature1_title', 'Private pool suite')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
      <input type="text" name="content[about_feature1_button]" value="{{ old('content.about_feature1_button', $about->content('about_feature1_button', 'check availability')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div class="col-span-2">
      <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
      <textarea name="content[about_feature1_text]" rows="2" class="w-full border rounded px-3 py-2">{{ old('content.about_feature1_text', $about->content('about_feature1_text', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.')) }}</textarea>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
      <input type="text" name="content[about_feature1_link]" value="{{ old('content.about_feature1_link', $about->content('about_feature1_link', '/search')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>

  <h3 class="text-lg font-medium text-gray-800 mb-3">Feature 2 (Right Image)</h3>
  <div class="grid grid-cols-2 gap-4">
    <div>
      @include('admin.partials.image-upload-field', ['name' => 'content[about_feature2_image]', 'label' => 'Image', 'value' => $about->content('about_feature2_image', url('/assets/img/room2.jpg'))])
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Image Label</label>
      <input type="text" name="content[about_feature2_label]" value="{{ old('content.about_feature2_label', $about->content('about_feature2_label', 'sea view suite')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
      <input type="text" name="content[about_feature2_title]" value="{{ old('content.about_feature2_title', $about->content('about_feature2_title', 'Sea view suite')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
      <input type="text" name="content[about_feature2_button]" value="{{ old('content.about_feature2_button', $about->content('about_feature2_button', 'check availability')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div class="col-span-2">
      <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
      <textarea name="content[about_feature2_text]" rows="2" class="w-full border rounded px-3 py-2">{{ old('content.about_feature2_text', $about->content('about_feature2_text', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.')) }}</textarea>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
      <input type="text" name="content[about_feature2_link]" value="{{ old('content.about_feature2_link', $about->content('about_feature2_link', '/search')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>
  </div>
</div>

