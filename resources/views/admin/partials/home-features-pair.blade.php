<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="features-pair-section">
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
  <div id="features-pair-section" class="section-content p-6">
    
    @php
      // Get the current feature count from content, default to 2
      $featureCount = (int) $home->content('features_pair_count', 2);
      if ($featureCount < 1) $featureCount = 2;
    @endphp
    
    <input type="hidden" name="content[features_pair_count]" id="features-pair-count" value="{{ $featureCount }}">
    
    <div id="features-pair-container">
      @for ($i = 1; $i <= $featureCount; $i++)
        <div class="feature-pair-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-feature-index="{{ $i }}">
          <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-medium text-gray-800">
              <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
              Feature {{ $i }} ({{ $i % 2 == 1 ? 'Left Image' : 'Right Image' }})
            </h3>
            @if ($i > 2)
              <button type="button" class="remove-feature-btn text-red-500 hover:text-red-700 text-sm" onclick="removeFeaturePair(this)">
                <i class="fas fa-trash mr-1"></i> Remove
              </button>
            @endif
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              @include('admin.partials.image-upload-field', ['name' => 'content[feature'.$i.'_image]', 'label' => 'Image', 'value' => $home->content('feature'.$i.'_image', '')])
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Image Label</label>
              <input type="text" name="content[feature{{ $i }}_label]" value="{{ old('content.feature'.$i.'_label', $home->content('feature'.$i.'_label', '')) }}" class="w-full border rounded px-3 py-2" placeholder="e.g. Pearl Room" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input type="text" name="content[feature{{ $i }}_title]" value="{{ old('content.feature'.$i.'_title', $home->content('feature'.$i.'_title', '')) }}" class="w-full border rounded px-3 py-2" placeholder="Feature title" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Price (optional)</label>
              <input type="text" name="content[feature{{ $i }}_price]" value="{{ old('content.feature'.$i.'_price', $home->content('feature'.$i.'_price', '')) }}" class="w-full border rounded px-3 py-2" placeholder="e.g. 43,500" />
            </div>
            <div class="col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
              <textarea name="content[feature{{ $i }}_text]" rows="2" class="w-full border rounded px-3 py-2" placeholder="Feature description">{{ old('content.feature'.$i.'_text', $home->content('feature'.$i.'_text', '')) }}</textarea>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
              <input type="text" name="content[feature{{ $i }}_button_text]" value="{{ old('content.feature'.$i.'_button_text', $home->content('feature'.$i.'_button_text', 'check availability')) }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
              <input type="text" name="content[feature{{ $i }}_button_link]" value="{{ old('content.feature'.$i.'_button_link', $home->content('feature'.$i.'_button_link', '/search')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
        </div>
      @endfor
    </div>
    
    <div class="mt-4">
      <button type="button" id="add-feature-pair-btn" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
        <i class="fas fa-plus mr-2"></i> Add Feature
      </button>
    </div>
    
  </div>
</div>

<template id="feature-pair-template">
  <div class="feature-pair-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-feature-index="__INDEX__">
    <div class="flex justify-between items-center mb-3">
      <h3 class="text-lg font-medium text-gray-800">
        <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
        Feature __INDEX__ (__POSITION__)
      </h3>
      <button type="button" class="remove-feature-btn text-red-500 hover:text-red-700 text-sm" onclick="removeFeaturePair(this)">
        <i class="fas fa-trash mr-1"></i> Remove
      </button>
    </div>
    <div class="grid grid-cols-2 gap-4">
      <div>
        <div class="image-upload-group">
          <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
          <input type="hidden" name="content[feature__INDEX___image]" id="content_feature__INDEX___image_" value="" />
          <div class="relative w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 cursor-pointer hover:border-blue-400" onclick="document.getElementById('content_feature__INDEX___image__file').click()">
            <img id="content_feature__INDEX___image__preview" src="" alt="Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;" />
            <div id="content_feature__INDEX___image__placeholder" style="display: flex; position: absolute; inset: 0; flex-direction: column; align-items: center; justify-content: center;">
              <i class="fas fa-cloud-upload-alt" style="font-size: 24px; color: #9ca3af; margin-bottom: 4px;"></i>
              <span style="font-size: 12px; color: #6b7280;">Upload</span>
            </div>
          </div>
          <input type="file" id="content_feature__INDEX___image__file" name="images[feature__INDEX___image]" class="image-file-input" data-target="content_feature__INDEX___image_" accept="image/*" style="display: none;" />
          <div class="mt-1">
            <span id="content_feature__INDEX___image__name" style="font-size: 12px; color: #6b7280; display: block; max-width: 128px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">No file selected</span>
          </div>
        </div>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Image Label</label>
        <input type="text" name="content[feature__INDEX___label]" value="" class="w-full border rounded px-3 py-2" placeholder="e.g. Pearl Room" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" name="content[feature__INDEX___title]" value="" class="w-full border rounded px-3 py-2" placeholder="Feature title" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Price (optional)</label>
        <input type="text" name="content[feature__INDEX___price]" value="" class="w-full border rounded px-3 py-2" placeholder="e.g. 43,500" />
      </div>
      <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="content[feature__INDEX___text]" rows="2" class="w-full border rounded px-3 py-2" placeholder="Feature description"></textarea>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
        <input type="text" name="content[feature__INDEX___button_text]" value="check availability" class="w-full border rounded px-3 py-2" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
        <input type="text" name="content[feature__INDEX___button_link]" value="/search" class="w-full border rounded px-3 py-2" />
      </div>
    </div>
  </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const addBtn = document.getElementById('add-feature-pair-btn');
  const container = document.getElementById('features-pair-container');
  const countInput = document.getElementById('features-pair-count');
  const template = document.getElementById('feature-pair-template');
  
  // Initialize image preview handlers for existing and new elements
  function initImagePreview(fileInput) {
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
  
  // Initialize existing image inputs
  document.querySelectorAll('.image-file-input').forEach(initImagePreview);
  
  if (addBtn) {
    addBtn.addEventListener('click', function() {
      let currentCount = parseInt(countInput.value) || 2;
      currentCount++;
      countInput.value = currentCount;
      
      let position = currentCount % 2 === 1 ? 'Left Image' : 'Right Image';
      let html = template.innerHTML
        .replace(/__INDEX__/g, currentCount)
        .replace(/__POSITION__/g, position);
      
      container.insertAdjacentHTML('beforeend', html);
      
      // Initialize image preview for newly added element
      const newItem = container.lastElementChild;
      const newFileInput = newItem.querySelector('.image-file-input');
      if (newFileInput) {
        initImagePreview(newFileInput);
      }
    });
  }
});

function removeFeaturePair(btn) {
  if (confirm('Are you sure you want to remove this feature?')) {
    const item = btn.closest('.feature-pair-item');
    item.remove();
    
    // Update the count
    const countInput = document.getElementById('features-pair-count');
    const items = document.querySelectorAll('.feature-pair-item');
    countInput.value = items.length;
    
    // Re-index remaining items
    items.forEach((item, idx) => {
      const index = idx + 1;
      item.dataset.featureIndex = index;
      const position = index % 2 === 1 ? 'Left Image' : 'Right Image';
      item.querySelector('h3').innerHTML = `<i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i> Feature ${index} (${position})`;
    });
  }
}
</script>

