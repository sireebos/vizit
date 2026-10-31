<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="rooms-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-bed mr-2 text-blue-600"></i>Rooms Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[rooms][visible]" value="0">
        <input type="checkbox" name="sections[rooms][visible]" value="1" {{ ($sectionsData['rooms']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="rooms-section" class="section-content p-6">
  
  <div class="grid grid-cols-2 gap-4 mb-6">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle</label>
      <input type="text" name="content[rooms_subtitle]" value="{{ old('content.rooms_subtitle', $home->content('rooms_subtitle', 'luxury')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
      <input type="text" name="content[rooms_title]" value="{{ old('content.rooms_title', $home->content('rooms_title', 'Our rooms')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>

  @php
    $roomCount = (int) $home->content('rooms_count', 4);
    if ($roomCount < 1) $roomCount = 4;
    $defaultRooms = [
      ['name' => 'suite tanya', 'type' => 'pool suite', 'price' => 'book from ₦130,000', 'image' => 'room3.jpg'],
      ['name' => 'suite helen', 'type' => 'small room', 'price' => 'book from ₦80,000', 'image' => 'room4.jpg'],
      ['name' => 'suite andrea', 'type' => 'Apartment', 'price' => 'book from ₦110,000', 'image' => 'room5.jpg'],
      ['name' => 'suite diana', 'type' => 'big Apartment', 'price' => 'book from ₦160,000', 'image' => 'room6.jpg'],
    ];
  @endphp

  <input type="hidden" name="content[rooms_count]" id="rooms-count" value="{{ $roomCount }}">

  <div id="rooms-container">
    @for ($i = 1; $i <= $roomCount; $i++)
      <div class="room-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-room-index="{{ $i }}">
        <div class="flex justify-between items-center mb-3">
          <h3 class="text-lg font-medium text-gray-800">
            <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
            Room {{ $i }}
          </h3>
          @if ($i > 1)
            <button type="button" class="remove-room-btn text-red-500 hover:text-red-700 text-sm" onclick="removeRoom(this)">
              <i class="fas fa-trash mr-1"></i> Remove
            </button>
          @endif
        </div>
        <div class="grid grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="content[room{{ $i }}_name]" value="{{ old("content.room{$i}_name", $home->content("room{$i}_name", $defaultRooms[$i-1]['name'] ?? '')) }}" class="w-full border rounded px-3 py-2" placeholder="Room name" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <input type="text" name="content[room{{ $i }}_type]" value="{{ old("content.room{$i}_type", $home->content("room{$i}_type", $defaultRooms[$i-1]['type'] ?? '')) }}" class="w-full border rounded px-3 py-2" placeholder="Room type" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Price Button</label>
            <input type="text" name="content[room{{ $i }}_price]" value="{{ old("content.room{$i}_price", $home->content("room{$i}_price", $defaultRooms[$i-1]['price'] ?? '')) }}" class="w-full border rounded px-3 py-2" placeholder="book from ₦XX,XXX" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
            <input type="text" name="content[room{{ $i }}_link]" value="{{ old("content.room{$i}_link", $home->content("room{$i}_link", '/search')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="col-span-2">
            @include('admin.partials.image-upload-field', ['name' => "content[room{$i}_image]", 'label' => 'Image', 'value' => $home->content("room{$i}_image", '')])
          </div>
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="content[room{{ $i }}_text]" rows="2" class="w-full border rounded px-3 py-2" placeholder="Room description">{{ old("content.room{$i}_text", $home->content("room{$i}_text", '')) }}</textarea>
          </div>
        </div>
      </div>
    @endfor
  </div>

  <div class="mt-4">
    <button type="button" id="add-room-btn" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
      <i class="fas fa-plus mr-2"></i> Add Room
    </button>
  </div>

  </div>
</div>

<template id="room-template">
  <div class="room-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-room-index="__INDEX__">
    <div class="flex justify-between items-center mb-3">
      <h3 class="text-lg font-medium text-gray-800">
        <i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i>
        Room __INDEX__
      </h3>
      <button type="button" class="remove-room-btn text-red-500 hover:text-red-700 text-sm" onclick="removeRoom(this)">
        <i class="fas fa-trash mr-1"></i> Remove
      </button>
    </div>
    <div class="grid grid-cols-4 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="content[room__INDEX___name]" value="" class="w-full border rounded px-3 py-2" placeholder="Room name" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
        <input type="text" name="content[room__INDEX___type]" value="" class="w-full border rounded px-3 py-2" placeholder="Room type" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Price Button</label>
        <input type="text" name="content[room__INDEX___price]" value="" class="w-full border rounded px-3 py-2" placeholder="book from ₦XX,XXX" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
        <input type="text" name="content[room__INDEX___link]" value="/search" class="w-full border rounded px-3 py-2" />
      </div>
      <div class="col-span-2">
        <div class="image-upload-group">
          <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
          <input type="hidden" name="content[room__INDEX___image]" id="content_room__INDEX___image_" value="" />
          <div class="relative w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 cursor-pointer hover:border-blue-400" onclick="document.getElementById('content_room__INDEX___image__file').click()">
            <img id="content_room__INDEX___image__preview" src="" alt="Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;" />
            <div id="content_room__INDEX___image__placeholder" style="display: flex; position: absolute; inset: 0; flex-direction: column; align-items: center; justify-content: center;">
              <i class="fas fa-cloud-upload-alt" style="font-size: 24px; color: #9ca3af; margin-bottom: 4px;"></i>
              <span style="font-size: 12px; color: #6b7280;">Upload</span>
            </div>
          </div>
          <input type="file" id="content_room__INDEX___image__file" name="images[room__INDEX___image]" class="image-file-input" data-target="content_room__INDEX___image_" accept="image/*" style="display: none;" />
          <div class="mt-1">
            <span id="content_room__INDEX___image__name" style="font-size: 12px; color: #6b7280; display: block; max-width: 128px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">No file selected</span>
          </div>
        </div>
      </div>
      <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="content[room__INDEX___text]" rows="2" class="w-full border rounded px-3 py-2" placeholder="Room description"></textarea>
      </div>
    </div>
  </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const addRoomBtn = document.getElementById('add-room-btn');
  const roomContainer = document.getElementById('rooms-container');
  const roomCountInput = document.getElementById('rooms-count');
  const roomTemplate = document.getElementById('room-template');
  
  // Initialize image preview handlers for room elements
  function initRoomImagePreview(fileInput) {
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
  
  // Initialize existing room image inputs
  roomContainer.querySelectorAll('.image-file-input').forEach(initRoomImagePreview);
  
  if (addRoomBtn) {
    addRoomBtn.addEventListener('click', function() {
      let currentCount = parseInt(roomCountInput.value) || 4;
      currentCount++;
      roomCountInput.value = currentCount;
      
      let html = roomTemplate.innerHTML.replace(/__INDEX__/g, currentCount);
      
      roomContainer.insertAdjacentHTML('beforeend', html);
      
      // Initialize image preview for newly added element
      const newItem = roomContainer.lastElementChild;
      const newFileInput = newItem.querySelector('.image-file-input');
      if (newFileInput) {
        initRoomImagePreview(newFileInput);
      }
    });
  }
});

function removeRoom(btn) {
  if (confirm('Are you sure you want to remove this room?')) {
    const item = btn.closest('.room-item');
    item.remove();
    
    // Update the count
    const countInput = document.getElementById('rooms-count');
    const items = document.querySelectorAll('.room-item');
    countInput.value = items.length;
    
    // Re-index remaining items
    items.forEach((item, idx) => {
      const index = idx + 1;
      item.dataset.roomIndex = index;
      item.querySelector('h3').innerHTML = `<i class="fas fa-grip-vertical text-gray-400 mr-2 cursor-move"></i> Room ${index}`;
    });
  }
}
</script>

