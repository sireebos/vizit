<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="history-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-landmark mr-2 text-amber-600"></i>History Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[history][visible]" value="0">
        <input type="checkbox" name="sections[history][visible]" value="1" {{ ($sectionsData['history']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="history-section" class="section-content p-6">
  
  <div class="space-y-4">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Subtitle</label>
      <input type="text" name="content[history_subtitle]" value="{{ old('content.history_subtitle', $about->content('history_subtitle', 'our story')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Section Heading</label>
      <input type="text" name="content[history_title]" value="{{ old('content.history_title', $about->content('history_title', 'Our History')) }}" class="w-full border rounded px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">History Content</label>
      <textarea name="content[history_content]" rows="10" class="w-full border rounded px-3 py-2" placeholder="Write your hotel's history here...">{{ old('content.history_content', $about->content('history_content', 'Founded with a vision of providing exceptional hospitality, our hotel has grown from humble beginnings to become a landmark destination for travelers from around the world.

Over the years, we have continuously evolved to meet the changing needs of our guests while staying true to our core values of comfort, elegance, and personalized service.

Today, we stand proud as a testament to decades of dedication to hospitality excellence, welcoming guests to experience the perfect blend of traditional warmth and modern luxury.')) }}</textarea>
      <p class="text-xs text-gray-500 mt-1">You can use multiple paragraphs by pressing Enter twice between them.</p>
    </div>
  </div>
  </div>
</div>
