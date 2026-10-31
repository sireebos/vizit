<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="parallax-cta-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-images mr-2 text-pink-600"></i>Parallax CTA Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[parallax_cta][visible]" value="0">
        <input type="checkbox" name="sections[parallax_cta][visible]" value="1" {{ ($sectionsData['parallax_cta']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="parallax-cta-section" class="section-content p-6">

  <div class="grid grid-cols-3 gap-4">
    <div>
      @include('admin.partials.image-upload-field', ['name' => 'content[parallax_cta_bg]', 'label' => 'Background Image', 'value' => $home->content('parallax_cta_bg', '')])
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
      <input type="text" name="content[parallax_cta_button_text]" value="{{ old('content.parallax_cta_button_text', $home->content('parallax_cta_button_text', 'book now')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
      <input type="text" name="content[parallax_cta_button_link]" value="{{ old('content.parallax_cta_button_link', $home->content('parallax_cta_button_link', '/search')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>
  </div>
</div>

