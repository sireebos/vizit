<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
  <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="about-quotes-section">
    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
      <i class="fas fa-quote-left mr-2 text-emerald-600"></i>Quotes Section
    </h2>
    <div class="flex items-center gap-4">
      <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
        <input type="hidden" name="sections[quotes][visible]" value="0">
        <input type="checkbox" name="sections[quotes][visible]" value="1" {{ ($sectionsData['quotes']['visible'] ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-gray-600">Show</span>
      </label>
      <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </div>
  </button>
  <div id="about-quotes-section" class="section-content p-6">
  
  <div class="mb-6">
    @include('admin.partials.image-upload-field', ['name' => 'content[about_quotes_bg]', 'label' => 'Background Image', 'value' => $about->content('about_quotes_bg', url('/assets/img/5.jpg'))])
  </div>

  {{-- Dynamic About Quotes --}}
  @php $aboutQuotesCount = (int) $about->content('about_quotes_count', 3); @endphp
  <input type="hidden" name="content[about_quotes_count]" id="about-quotes-count" value="{{ $aboutQuotesCount }}">

  <div id="about-quotes-container">
    @for ($i = 1; $i <= $aboutQuotesCount; $i++)
    <div class="about-quote-item border rounded p-4 mb-4 bg-gray-50" data-index="{{ $i }}">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Quote <span class="about-quote-number">{{ $i }}</span></h3>
        <button type="button" class="remove-about-quote-btn text-red-600 hover:text-red-800" title="Remove Quote">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Quote Text</label>
          <textarea name="content[about_quote{{ $i }}_text]" rows="2" class="w-full border rounded px-3 py-2 about-quote-text">{{ old("content.about_quote{$i}_text", $about->content("about_quote{$i}_text", '')) }}</textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
          <input type="text" name="content[about_quote{{ $i }}_author]" value="{{ old("content.about_quote{$i}_author", $about->content("about_quote{$i}_author", '')) }}" class="w-full border rounded px-3 py-2 about-quote-author" />
        </div>
      </div>
    </div>
    @endfor
  </div>

  <button type="button" id="add-about-quote-btn" class="mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    <i class="fas fa-plus mr-2"></i>Add Quote
  </button>

  {{-- About Quote Template --}}
  <template id="about-quote-template">
    <div class="about-quote-item border rounded p-4 mb-4 bg-gray-50" data-index="__INDEX__">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-medium text-gray-800">Quote <span class="about-quote-number">__INDEX__</span></h3>
        <button type="button" class="remove-about-quote-btn text-red-600 hover:text-red-800" title="Remove Quote">
          <i class="fas fa-trash"></i>
        </button>
      </div>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Quote Text</label>
          <textarea name="content[about_quote__INDEX___text]" rows="2" class="w-full border rounded px-3 py-2 about-quote-text" placeholder="Enter quote text"></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
          <input type="text" name="content[about_quote__INDEX___author]" value="" class="w-full border rounded px-3 py-2 about-quote-author" placeholder="Enter author name" />
        </div>
      </div>
    </div>
  </template>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('about-quotes-container');
    const addBtn = document.getElementById('add-about-quote-btn');
    const template = document.getElementById('about-quote-template');
    const countInput = document.getElementById('about-quotes-count');

    function updateAboutQuoteNumbers() {
      const items = container.querySelectorAll('.about-quote-item');
      items.forEach((item, idx) => {
        const newIndex = idx + 1;
        item.dataset.index = newIndex;
        item.querySelector('.about-quote-number').textContent = newIndex;
        item.querySelector('.about-quote-text').name = `content[about_quote${newIndex}_text]`;
        item.querySelector('.about-quote-author').name = `content[about_quote${newIndex}_author]`;
      });
      countInput.value = items.length;
    }

    function addRemoveListener(btn) {
      btn.addEventListener('click', function() {
        const items = container.querySelectorAll('.about-quote-item');
        if (items.length <= 1) {
          alert('You must have at least one quote.');
          return;
        }
        btn.closest('.about-quote-item').remove();
        updateAboutQuoteNumbers();
      });
    }

    container.querySelectorAll('.remove-about-quote-btn').forEach(addRemoveListener);

    addBtn.addEventListener('click', function() {
      const currentCount = container.querySelectorAll('.about-quote-item').length;
      const newIndex = currentCount + 1;
      const html = template.innerHTML.replace(/__INDEX__/g, newIndex);
      container.insertAdjacentHTML('beforeend', html);
      const newItem = container.querySelector('.about-quote-item:last-child');
      addRemoveListener(newItem.querySelector('.remove-about-quote-btn'));
      countInput.value = newIndex;
    });
  });
  </script>
  </div>
</div>


