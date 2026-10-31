<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="restaurants-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-utensils mr-2 text-yellow-600"></i>Restaurants Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[restaurants][visible]" value="0">
        <input type="checkbox" name="sections[restaurants][visible]" value="1" {{ ($sectionsData['restaurants']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="restaurants-section" class="section-content p-6">
  
  <div class="grid grid-cols-2 gap-4 mb-6">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle</label>
      <input type="text" name="content[restaurants_subtitle]" value="{{ old('content.restaurants_subtitle', $home->content('restaurants_subtitle', 'Excellent restaurant')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
      <input type="text" name="content[restaurants_title]" value="{{ old('content.restaurants_title', $home->content('restaurants_title', 'Dining & Bars')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>

  {{-- Dynamic Restaurants --}}
  @php $restaurantsCount = (int) $home->content('restaurants_count', 2); @endphp
  <input type="hidden" name="content[restaurants_count]" id="restaurants-count" value="{{ $restaurantsCount }}">

  <div id="restaurants-container">
    @for ($i = 1; $i <= $restaurantsCount; $i++)
    <div class="restaurant-item border rounded p-4 mb-4 bg-gray-50" data-index="{{ $i }}">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Restaurant <span class="restaurant-number">{{ $i }}</span></h3>
        <button type="button" class="remove-restaurant-btn text-red-600 hover:text-red-800" title="Remove Restaurant">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-4 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
          <input type="text" name="content[restaurant{{ $i }}_title]" value="{{ old("content.restaurant{$i}_title", $home->content("restaurant{$i}_title", '')) }}" class="w-full border rounded px-3 py-2 restaurant-title" />
        </div>
        <div>
          @include('admin.partials.image-upload-field', ['name' => "content[restaurant{$i}_image]", 'label' => 'Image', 'value' => $home->content("restaurant{$i}_image", '')])
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
          <input type="text" name="content[restaurant{{ $i }}_button]" value="{{ old("content.restaurant{$i}_button", $home->content("restaurant{$i}_button", 'explore')) }}" class="w-full border rounded px-3 py-2 restaurant-button" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
          <input type="text" name="content[restaurant{{ $i }}_link]" value="{{ old("content.restaurant{$i}_link", $home->content("restaurant{$i}_link", '/restaurant')) }}" class="w-full border rounded px-3 py-2 restaurant-link" />
        </div>
        <div class="col-span-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
          <textarea name="content[restaurant{{ $i }}_text]" rows="2" class="w-full border rounded px-3 py-2 restaurant-text">{{ old("content.restaurant{$i}_text", $home->content("restaurant{$i}_text", '')) }}</textarea>
        </div>
      </div>
    </div>
    @endfor
  </div>

  <button type="button" id="add-restaurant-btn" class="mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    <i class="fas fa-plus mr-2"></i>Add Restaurant
  </button>

  {{-- Restaurant Template --}}
  <template id="restaurant-template">
    <div class="restaurant-item border rounded p-4 mb-4 bg-gray-50" data-index="__INDEX__">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Restaurant <span class="restaurant-number">__INDEX__</span></h3>
        <button type="button" class="remove-restaurant-btn text-red-600 hover:text-red-800" title="Remove Restaurant">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-4 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
          <input type="text" name="content[restaurant__INDEX___title]" value="" class="w-full border rounded px-3 py-2 restaurant-title" placeholder="Restaurant name" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
          <input type="text" name="content[restaurant__INDEX___image]" value="" class="w-full border rounded px-3 py-2 restaurant-image" placeholder="Image URL" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
          <input type="text" name="content[restaurant__INDEX___button]" value="explore" class="w-full border rounded px-3 py-2 restaurant-button" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
          <input type="text" name="content[restaurant__INDEX___link]" value="/restaurant" class="w-full border rounded px-3 py-2 restaurant-link" />
        </div>
        <div class="col-span-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
          <textarea name="content[restaurant__INDEX___text]" rows="2" class="w-full border rounded px-3 py-2 restaurant-text" placeholder="Restaurant description"></textarea>
        </div>
      </div>
    </div>
  </template>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('restaurants-container');
    const addBtn = document.getElementById('add-restaurant-btn');
    const template = document.getElementById('restaurant-template');
    const countInput = document.getElementById('restaurants-count');

    function updateRestaurantNumbers() {
      const items = container.querySelectorAll('.restaurant-item');
      items.forEach((item, idx) => {
        const newIndex = idx + 1;
        item.dataset.index = newIndex;
        item.querySelector('.restaurant-number').textContent = newIndex;
        item.querySelector('.restaurant-title').name = `content[restaurant${newIndex}_title]`;
        item.querySelector('.restaurant-button').name = `content[restaurant${newIndex}_button]`;
        item.querySelector('.restaurant-link').name = `content[restaurant${newIndex}_link]`;
        item.querySelector('.restaurant-text').name = `content[restaurant${newIndex}_text]`;
        const imgField = item.querySelector('[name*="_image"]');
        if (imgField) imgField.name = `content[restaurant${newIndex}_image]`;
      });
      countInput.value = items.length;
    }

    function addRemoveListener(btn) {
      btn.addEventListener('click', function() {
        const items = container.querySelectorAll('.restaurant-item');
        if (items.length <= 1) {
          alert('You must have at least one restaurant.');
          return;
        }
        btn.closest('.restaurant-item').remove();
        updateRestaurantNumbers();
      });
    }

    container.querySelectorAll('.remove-restaurant-btn').forEach(addRemoveListener);

    addBtn.addEventListener('click', function() {
      const currentCount = container.querySelectorAll('.restaurant-item').length;
      const newIndex = currentCount + 1;
      const html = template.innerHTML.replace(/__INDEX__/g, newIndex);
      container.insertAdjacentHTML('beforeend', html);
      const newItem = container.querySelector('.restaurant-item:last-child');
      addRemoveListener(newItem.querySelector('.remove-restaurant-btn'));
      countInput.value = newIndex;
    });
  });
  </script>
  </div>
</div>


