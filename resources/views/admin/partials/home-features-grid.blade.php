<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="features-grid-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-th mr-2 text-amber-600"></i>Features Grid Section (Amenities)
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[features_grid][visible]" value="0">
        <input type="checkbox" name="sections[features_grid][visible]" value="1" {{ ($sectionsData['features_grid']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="features-grid-section" class="section-content p-6">

  <div class="grid grid-cols-2 gap-4 mb-6">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle</label>
      <input type="text" name="content[features_grid_subtitle]" value="{{ old('content.features_grid_subtitle', $home->content('features_grid_subtitle', 'elegant suites')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
      <input type="text" name="content[features_grid_title]" value="{{ old('content.features_grid_title', $home->content('features_grid_title', 'Unpretentious luxury')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>

  @php
    $amenityCount = (int) $home->content('amenities_count', 6);
    if ($amenityCount < 1) $amenityCount = 6;
    $defaultAmenities = [
      ['title' => 'smoking free', 'icon' => '1.svg'],
      ['title' => 'king beds', 'icon' => '2.svg'],
      ['title' => 'Yacht rental', 'icon' => '3.svg'],
      ['title' => 'welcome drink', 'icon' => '4.svg'],
      ['title' => 'swimming pool', 'icon' => '5.svg'],
      ['title' => 'food included', 'icon' => '6.svg'],
    ];
  @endphp

  <input type="hidden" name="content[amenities_count]" id="amenities-count" value="{{ $amenityCount }}">

  <div id="amenities-container">
    @for ($i = 1; $i <= $amenityCount; $i++)
      <div class="amenity-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-amenity-index="{{ $i }}">
        <div class="flex justify-between items-center mb-3">
          <h3 class="text-lg font-medium text-gray-800">
            <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
            Amenity {{ $i }}
          </h3>
          @if ($i > 1)
            <button type="button" class="remove-amenity-btn text-red-500 hover:text-red-700 text-sm" onclick="removeAmenity(this)">
              <i class="fas fa-trash mr-1"></i> Remove
            </button>
          @endif
        </div>
        <div class="grid grid-cols-4 gap-4">
          <div>
            @include('admin.partials.image-upload-field', ['name' => "content[amenity{$i}_icon]", 'label' => 'Icon', 'value' => $home->content("amenity{$i}_icon", '')])
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="content[amenity{{ $i }}_title]" value="{{ old("content.amenity{$i}_title", $home->content("amenity{$i}_title", $defaultAmenities[$i-1]['title'] ?? '')) }}" class="w-full border rounded px-3 py-2" placeholder="Amenity title" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
            <input type="text" name="content[amenity{{ $i }}_button]" value="{{ old("content.amenity{$i}_button", $home->content("amenity{$i}_button", 'read more')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
            <input type="text" name="content[amenity{{ $i }}_link]" value="{{ old("content.amenity{$i}_link", $home->content("amenity{$i}_link", '/services')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="col-span-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="content[amenity{{ $i }}_text]" rows="2" class="w-full border rounded px-3 py-2" placeholder="Amenity description">{{ old("content.amenity{$i}_text", $home->content("amenity{$i}_text", '')) }}</textarea>
          </div>
        </div>
      </div>
    @endfor
  </div>

  <div class="mt-4">
    <button type="button" id="add-amenity-btn" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
      <i class="fas fa-plus mr-2"></i> Add Amenity
    </button>
  </div>

  </div>
</div>

<template id="amenity-template">
  <div class="amenity-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-amenity-index="__INDEX__">
    <div class="flex justify-between items-center mb-3">
      <h3 class="text-lg font-medium text-gray-800">
        <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
        Amenity __INDEX__
      </h3>
      <button type="button" class="remove-amenity-btn text-red-500 hover:text-red-700 text-sm" onclick="removeAmenity(this)">
        <i class="fas fa-trash mr-1"></i> Remove
      </button>
    </div>
    <div class="grid grid-cols-4 gap-4">
      <div>
        <div class="image-upload-group">
          <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
          <input type="hidden" name="content[amenity__INDEX___icon]" id="content_amenity__INDEX___icon_" value="" />
          <div class="relative w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 cursor-pointer hover:border-blue-400" onclick="document.getElementById('content_amenity__INDEX___icon__file').click()">
            <img id="content_amenity__INDEX___icon__preview" src="" alt="Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;" />
            <div id="content_amenity__INDEX___icon__placeholder" style="display: flex; position: absolute; inset: 0; flex-direction: column; align-items: center; justify-content: center;">
              <i class="fas fa-cloud-upload-alt" style="font-size: 24px; color: #9ca3af; margin-bottom: 4px;"></i>
              <span style="font-size: 12px; color: #6b7280;">Upload</span>
            </div>
          </div>
          <input type="file" id="content_amenity__INDEX___icon__file" name="images[amenity__INDEX___icon]" class="image-file-input" data-target="content_amenity__INDEX___icon_" accept="image/*" style="display: none;" />
          <div class="mt-1">
            <span id="content_amenity__INDEX___icon__name" style="font-size: 12px; color: #6b7280; display: block; max-width: 128px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">No file selected</span>
          </div>
        </div>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" name="content[amenity__INDEX___title]" value="" class="w-full border rounded px-3 py-2" placeholder="Amenity title" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
        <input type="text" name="content[amenity__INDEX___button]" value="read more" class="w-full border rounded px-3 py-2" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
        <input type="text" name="content[amenity__INDEX___link]" value="/services" class="w-full border rounded px-3 py-2" />
      </div>
      <div class="col-span-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="content[amenity__INDEX___text]" rows="2" class="w-full border rounded px-3 py-2" placeholder="Amenity description"></textarea>
      </div>
    </div>
  </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const addAmenityBtn = document.getElementById('add-amenity-btn');
  const amenityContainer = document.getElementById('amenities-container');
  const amenityCountInput = document.getElementById('amenities-count');
  const amenityTemplate = document.getElementById('amenity-template');
  
  // Initialize image preview handlers for amenity elements
  function initAmenityImagePreview(fileInput) {
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      const targetId = this.dataset.target || this.id.replace('_file', '_');
      const preview = document.getElementById(targetId + '_preview') || document.getElementById(targetId.replace(/_$/, '') + '_preview');
      const placeholder = document.getElementById(targetId + '_placeholder') || document.getElementById(targetId.replace(/_$/, '') + '_placeholder');
      const nameSpan = document.getElementById(targetId + '_name') || document.getElementById(targetId.replace(/_$/, '') + '_name');
      
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          if (preview) {
            preview.src = e.target.result;
            preview.style.display = 'block';
          }
          if (placeholder) {
            placeholder.style.display = 'none';
          }
          if (nameSpan) {
            nameSpan.textContent = file.name;
          }
        };
        reader.readAsDataURL(file);
      }
    });
  }
  
  // Initialize existing amenity image inputs
  amenityContainer.querySelectorAll('.image-file-input').forEach(initAmenityImagePreview);
  
  if (addAmenityBtn) {
    addAmenityBtn.addEventListener('click', function() {
      let currentCount = parseInt(amenityCountInput.value) || 6;
      currentCount++;
      amenityCountInput.value = currentCount;
      
      let html = amenityTemplate.innerHTML.replace(/__INDEX__/g, currentCount);
      
      amenityContainer.insertAdjacentHTML('beforeend', html);
      
      // Initialize image preview for newly added element
      const newItem = amenityContainer.lastElementChild;
      const newFileInput = newItem.querySelector('.image-file-input');
      if (newFileInput) {
        initAmenityImagePreview(newFileInput);
      }
    });
  }
});

function removeAmenity(btn) {
  if (confirm('Are you sure you want to remove this amenity?')) {
    const item = btn.closest('.amenity-item');
    item.remove();
    
    // Update the count
    const countInput = document.getElementById('amenities-count');
    const items = document.querySelectorAll('.amenity-item');
    countInput.value = items.length;
    
    // Re-index remaining items
    items.forEach((item, idx) => {
      const index = idx + 1;
      item.dataset.amenityIndex = index;
      item.querySelector('h3').innerHTML = `<i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i> Amenity ${index}`;
    });
  }
}
</script>

