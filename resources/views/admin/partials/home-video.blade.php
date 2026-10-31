<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="video-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-video mr-2 text-red-600"></i>Video Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[video][visible]" value="0">
        <input type="checkbox" name="sections[video][visible]" value="1" {{ ($sectionsData['video']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="video-section" class="section-content p-6">
  
  <div class="grid grid-cols-3 gap-4">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
      <input type="text" name="content[video_title]" value="{{ old('content.video_title', $home->content('video_title', 'A new dimension of luxury.')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
      <input type="text" name="content[video_subtitle]" value="{{ old('content.video_subtitle', $home->content('video_subtitle', 'our presentation, 0:48 min')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
      <input type="text" name="content[video_url]" value="{{ old('content.video_url', $home->content('video_url', 'https://vimeo.com/54851233')) }}" class="w-full border rounded px-3 py-2" />
    </div>
  </div>
  </div>
</div>

