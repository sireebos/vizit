<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="about-services-grid-section">
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
  <div id="about-services-grid-section" class="section-content p-6">
  
  @php
    $defaultTitles = ['Restaurant', 'Swimming Pool', 'Bar & Lounge', 'Activities'];
    $defaultImages = [url('/assets/img/ser-1.jpg'), url('/assets/img/ser-2.jpg'), url('/assets/img/ser-3.jpg'), url('/assets/img/ser-4.jpg')];
    $gridServicesCount = (int) $about->content('about_grid_services_count', 3);
  @endphp
  
  <input type="hidden" name="content[about_grid_services_count]" id="about-grid-services-count" value="{{ $gridServicesCount }}">
  
  <div id="about-grid-services-container">
    @for ($i = 1; $i <= $gridServicesCount; $i++)
    <div class="about-grid-service-item border border-gray-200 rounded-lg p-4 mb-4" data-index="{{ $i }}">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Service {{ $i }}</h3>
        <button type="button" class="remove-about-grid-service text-red-500 hover:text-red-700" title="Remove Service">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-3 gap-4">
        <div>
          @include('admin.partials.image-upload-field', ['name' => "content[about_grid_service{$i}_image]", 'label' => 'Image', 'value' => $about->content("about_grid_service{$i}_image", $defaultImages[($i-1) % 4] ?? '')])
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
          <input type="text" name="content[about_grid_service{{ $i }}_title]" value="{{ old("content.about_grid_service{$i}_title", $about->content("about_grid_service{$i}_title", $defaultTitles[($i-1) % 4] ?? '')) }}" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
          <input type="text" name="content[about_grid_service{{ $i }}_link]" value="{{ old("content.about_grid_service{$i}_link", $about->content("about_grid_service{$i}_link", '/services')) }}" class="w-full border rounded px-3 py-2" />
        </div>
      </div>
    </div>
    @endfor
  </div>
  
  <button type="button" id="add-about-grid-service" class="mt-4 px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700 transition">
    <i class="fas fa-plus mr-2"></i>Add Service
  </button>
  
  <template id="about-grid-service-template">
    <div class="about-grid-service-item border border-gray-200 rounded-lg p-4 mb-4" data-index="__INDEX__">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Service __INDEX__</h3>
        <button type="button" class="remove-about-grid-service text-red-500 hover:text-red-700" title="Remove Service">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
          <input type="text" name="content[about_grid_service__INDEX___image]" value="" class="w-full border rounded px-3 py-2" placeholder="Image URL or upload path" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
          <input type="text" name="content[about_grid_service__INDEX___title]" value="" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
          <input type="text" name="content[about_grid_service__INDEX___link]" value="/services" class="w-full border rounded px-3 py-2" />
        </div>
      </div>
    </div>
  </template>
  
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('about-grid-services-container');
    const countInput = document.getElementById('about-grid-services-count');
    const addBtn = document.getElementById('add-about-grid-service');
    const template = document.getElementById('about-grid-service-template');
    
    if (!container || !countInput || !addBtn || !template) return;
    
    function updateNumbers() {
        const items = container.querySelectorAll('.about-grid-service-item');
        items.forEach((item, idx) => {
            const num = idx + 1;
            item.setAttribute('data-index', num);
            item.querySelector('h3').textContent = 'Service ' + num;
            
            item.querySelectorAll('input, select, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/about_grid_service\d+/, 'about_grid_service' + num));
                }
            });
        });
        countInput.value = items.length;
    }
    
    function addRemoveListener(btn) {
        btn.addEventListener('click', function() {
            if (container.querySelectorAll('.about-grid-service-item').length > 1) {
                btn.closest('.about-grid-service-item').remove();
                updateNumbers();
            } else {
                alert('At least one service is required.');
            }
        });
    }
    
    container.querySelectorAll('.remove-about-grid-service').forEach(addRemoveListener);
    
    addBtn.addEventListener('click', function() {
        const newIndex = container.querySelectorAll('.about-grid-service-item').length + 1;
        const html = template.innerHTML.replace(/__INDEX__/g, newIndex);
        container.insertAdjacentHTML('beforeend', html);
        const newItem = container.lastElementChild;
        addRemoveListener(newItem.querySelector('.remove-about-grid-service'));
        updateNumbers();
    });
});
</script>

