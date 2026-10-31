<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="about-services-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-concierge-bell mr-2 text-indigo-600"></i>About Services Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[about_services][visible]" value="0">
        <input type="checkbox" name="sections[about_services][visible]" value="1" {{ ($sectionsData['about_services']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="about-services-section" class="section-content p-6">
  
  <div class="grid grid-cols-2 gap-4 mb-6">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle</label>
      <input type="text" name="content[about_services_subtitle]" value="{{ old('content.about_services_subtitle', $about->content('about_services_subtitle', 'a bit about us')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
      <input type="text" name="content[about_services_title]" value="{{ old('content.about_services_title', $about->content('about_services_title', 'finest hotel')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>

  {{-- Dynamic About Services --}}
  @php $aboutServicesCount = (int) $about->content('about_services_count', 3); @endphp
  <input type="hidden" name="content[about_services_count]" id="about-services-count" value="{{ $aboutServicesCount }}">

  <div id="about-services-container">
    @for ($i = 1; $i <= $aboutServicesCount; $i++)
    <div class="about-service-item border rounded p-4 mb-4 bg-gray-50" data-index="{{ $i }}">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Service <span class="about-service-number">{{ $i }}</span></h3>
        <button type="button" class="remove-about-service-btn text-red-600 hover:text-red-800" title="Remove Service">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-4 gap-4">
        <div>
          @include('admin.partials.image-upload-field', ['name' => "content[about_service{$i}_icon]", 'label' => 'Icon', 'value' => $about->content("about_service{$i}_icon", '')])
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
          <input type="text" name="content[about_service{{ $i }}_title]" value="{{ old("content.about_service{$i}_title", $about->content("about_service{$i}_title", '')) }}" class="w-full border rounded px-3 py-2 about-service-title" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
          <input type="text" name="content[about_service{{ $i }}_button]" value="{{ old("content.about_service{$i}_button", $about->content("about_service{$i}_button", 'read more')) }}" class="w-full border rounded px-3 py-2 about-service-button" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
          <input type="text" name="content[about_service{{ $i }}_link]" value="{{ old("content.about_service{$i}_link", $about->content("about_service{$i}_link", '/services')) }}" class="w-full border rounded px-3 py-2 about-service-link" />
        </div>
        <div class="col-span-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
          <textarea name="content[about_service{{ $i }}_text]" rows="2" class="w-full border rounded px-3 py-2 about-service-text">{{ old("content.about_service{$i}_text", $about->content("about_service{$i}_text", '')) }}</textarea>
        </div>
      </div>
    </div>
    @endfor
  </div>

  <button type="button" id="add-about-service-btn" class="mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    <i class="fas fa-plus mr-2"></i>Add Service
  </button>

  {{-- About Service Template --}}
  <template id="about-service-template">
    <div class="about-service-item border rounded p-4 mb-4 bg-gray-50" data-index="__INDEX__">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Service <span class="about-service-number">__INDEX__</span></h3>
        <button type="button" class="remove-about-service-btn text-red-600 hover:text-red-800" title="Remove Service">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-4 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Icon URL</label>
          <input type="text" name="content[about_service__INDEX___icon]" value="" class="w-full border rounded px-3 py-2 about-service-icon" placeholder="Icon URL" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
          <input type="text" name="content[about_service__INDEX___title]" value="" class="w-full border rounded px-3 py-2 about-service-title" placeholder="Service title" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
          <input type="text" name="content[about_service__INDEX___button]" value="read more" class="w-full border rounded px-3 py-2 about-service-button" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
          <input type="text" name="content[about_service__INDEX___link]" value="/services" class="w-full border rounded px-3 py-2 about-service-link" />
        </div>
        <div class="col-span-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
          <textarea name="content[about_service__INDEX___text]" rows="2" class="w-full border rounded px-3 py-2 about-service-text" placeholder="Service description"></textarea>
        </div>
      </div>
    </div>
  </template>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('about-services-container');
    const addBtn = document.getElementById('add-about-service-btn');
    const template = document.getElementById('about-service-template');
    const countInput = document.getElementById('about-services-count');

    function updateAboutServiceNumbers() {
      const items = container.querySelectorAll('.about-service-item');
      items.forEach((item, idx) => {
        const newIndex = idx + 1;
        item.dataset.index = newIndex;
        item.querySelector('.about-service-number').textContent = newIndex;
        item.querySelector('.about-service-title').name = `content[about_service${newIndex}_title]`;
        item.querySelector('.about-service-button').name = `content[about_service${newIndex}_button]`;
        item.querySelector('.about-service-link').name = `content[about_service${newIndex}_link]`;
        item.querySelector('.about-service-text').name = `content[about_service${newIndex}_text]`;
        const iconField = item.querySelector('[name*="_icon"]');
        if (iconField) iconField.name = `content[about_service${newIndex}_icon]`;
      });
      countInput.value = items.length;
    }

    function addRemoveListener(btn) {
      btn.addEventListener('click', function() {
        const items = container.querySelectorAll('.about-service-item');
        if (items.length <= 1) {
          alert('You must have at least one service.');
          return;
        }
        btn.closest('.about-service-item').remove();
        updateAboutServiceNumbers();
      });
    }

    container.querySelectorAll('.remove-about-service-btn').forEach(addRemoveListener);

    addBtn.addEventListener('click', function() {
      const currentCount = container.querySelectorAll('.about-service-item').length;
      const newIndex = currentCount + 1;
      const html = template.innerHTML.replace(/__INDEX__/g, newIndex);
      container.insertAdjacentHTML('beforeend', html);
      const newItem = container.querySelector('.about-service-item:last-child');
      addRemoveListener(newItem.querySelector('.remove-about-service-btn'));
      countInput.value = newIndex;
    });
  });
  </script>
  </div>
</div>


