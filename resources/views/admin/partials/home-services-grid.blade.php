<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="services-grid-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-grip-horizontal mr-2 text-cyan-600"></i>Services Grid Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[services_grid][visible]" value="0">
        <input type="checkbox" name="sections[services_grid][visible]" value="1" {{ ($sectionsData['services_grid']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="services-grid-section" class="section-content p-6">

    @php
      $serviceCount = (int) $home->content('services_grid_count', 4);
      if ($serviceCount < 1) $serviceCount = 4;
      $defaultTitles = ['spa salon', 'restaurant', 'pool', 'activities'];
    @endphp
    
    <input type="hidden" name="content[services_grid_count]" id="services-grid-count" value="{{ $serviceCount }}">
    
    <div id="services-grid-container">
      @for ($i = 1; $i <= $serviceCount; $i++)
        <div class="service-grid-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-service-index="{{ $i }}">
          <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-medium text-gray-800">
              <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
              Service {{ $i }}
            </h3>
            @if ($i > 1)
              <button type="button" class="remove-service-btn text-red-500 hover:text-red-700 text-sm" onclick="removeServiceGrid(this)">
                <i class="fas fa-trash mr-1"></i> Remove
              </button>
            @endif
          </div>
          <div class="grid grid-cols-3 gap-4">
            <div>
              @include('admin.partials.image-upload-field', ['name' => "content[service{$i}_image]", 'label' => 'Image', 'value' => $home->content("service{$i}_image", '')])
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input type="text" name="content[service{{ $i }}_title]" value="{{ old("content.service{$i}_title", $home->content("service{$i}_title", $defaultTitles[$i-1] ?? '')) }}" class="w-full border rounded px-3 py-2" placeholder="Service title" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
              <input type="text" name="content[service{{ $i }}_link]" value="{{ old("content.service{$i}_link", $home->content("service{$i}_link", '/services')) }}" class="w-full border rounded px-3 py-2" placeholder="/services" />
            </div>
          </div>
        </div>
      @endfor
    </div>
    
    <div class="mt-4">
      <button type="button" id="add-service-grid-btn" class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition">
        <i class="fas fa-plus mr-2"></i> Add Service
      </button>
    </div>
    
  </div>
</div>

<template id="service-grid-template">
  <div class="service-grid-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-service-index="__INDEX__">
    <div class="flex justify-between items-center mb-3">
      <h3 class="text-lg font-medium text-gray-800">
        <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
        Service __INDEX__
      </h3>
      <button type="button" class="remove-service-btn text-red-500 hover:text-red-700 text-sm" onclick="removeServiceGrid(this)">
        <i class="fas fa-trash mr-1"></i> Remove
      </button>
    </div>
    <div class="grid grid-cols-3 gap-4">
      <div>
        <div class="image-upload-group">
          <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
          <input type="hidden" name="content[service__INDEX___image]" id="content_service__INDEX___image_" value="" />
          <div class="relative w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 cursor-pointer hover:border-blue-400" onclick="document.getElementById('content_service__INDEX___image__file').click()">
            <img id="content_service__INDEX___image__preview" src="" alt="Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;" />
            <div id="content_service__INDEX___image__placeholder" style="display: flex; position: absolute; inset: 0; flex-direction: column; align-items: center; justify-content: center;">
              <i class="fas fa-cloud-upload-alt" style="font-size: 24px; color: #9ca3af; margin-bottom: 4px;"></i>
              <span style="font-size: 12px; color: #6b7280;">Upload</span>
            </div>
          </div>
          <input type="file" id="content_service__INDEX___image__file" name="images[service__INDEX___image]" class="image-file-input" data-target="content_service__INDEX___image_" accept="image/*" style="display: none;" />
          <div class="mt-1">
            <span id="content_service__INDEX___image__name" style="font-size: 12px; color: #6b7280; display: block; max-width: 128px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">No file selected</span>
          </div>
        </div>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" name="content[service__INDEX___title]" value="" class="w-full border rounded px-3 py-2" placeholder="Service title" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
        <input type="text" name="content[service__INDEX___link]" value="/services" class="w-full border rounded px-3 py-2" placeholder="/services" />
      </div>
    </div>
  </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const addServiceBtn = document.getElementById('add-service-grid-btn');
  const serviceContainer = document.getElementById('services-grid-container');
  const serviceCountInput = document.getElementById('services-grid-count');
  const serviceTemplate = document.getElementById('service-grid-template');
  
  // Initialize image preview handlers for service grid elements
  function initServiceImagePreview(fileInput) {
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
  
  // Initialize existing service image inputs
  serviceContainer.querySelectorAll('.image-file-input').forEach(initServiceImagePreview);
  
  if (addServiceBtn) {
    addServiceBtn.addEventListener('click', function() {
      let currentCount = parseInt(serviceCountInput.value) || 4;
      currentCount++;
      serviceCountInput.value = currentCount;
      
      let html = serviceTemplate.innerHTML.replace(/__INDEX__/g, currentCount);
      
      serviceContainer.insertAdjacentHTML('beforeend', html);
      
      // Initialize image preview for newly added element
      const newItem = serviceContainer.lastElementChild;
      const newFileInput = newItem.querySelector('.image-file-input');
      if (newFileInput) {
        initServiceImagePreview(newFileInput);
      }
    });
  }
});

function removeServiceGrid(btn) {
  if (confirm('Are you sure you want to remove this service?')) {
    const item = btn.closest('.service-grid-item');
    item.remove();
    
    // Update the count
    const countInput = document.getElementById('services-grid-count');
    const items = document.querySelectorAll('.service-grid-item');
    countInput.value = items.length;
    
    // Re-index remaining items
    items.forEach((item, idx) => {
      const index = idx + 1;
      item.dataset.serviceIndex = index;
      item.querySelector('h3').innerHTML = `<i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i> Service ${index}`;
    });
  }
}
</script>

