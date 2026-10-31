<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Terms & Conditions Page - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Edit Terms & Conditions Page</h1>
      <a href="{{ route('tandc') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        <i class="fas fa-eye mr-2"></i>View Page
      </a>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <!-- Reset to Defaults -->
    @include('admin.partials.reset-button', ['resetRoute' => route('admin.tandc-page.reset')])

    <form action="{{ route('admin.tandc-page.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Page Styles Section -->
      @include('admin.partials.page-styles-section', ['pageSettings' => $page])

      <!-- Section Order (Drag & Drop) -->
      @include('admin.partials.section-order', ['pageSettings' => $page])

      {{-- SEO Settings --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">SEO Settings</h2>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Page Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
            <textarea name="seo_description" rows="2" class="w-full border rounded px-3 py-2">{{ old('seo_description', $page->seo_description) }}</textarea>
          </div>
        </div>
      </div>

      {{-- Hero Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Hero Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[hero][visible]" value="0">
            <input type="checkbox" name="sections[hero][visible]" value="1" {{ $page->visible('hero') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
            <input type="text" name="content[hero_title]" value="{{ old('content.hero_title', $page->content('hero_title', 'Terms & Conditions')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          @include('admin.partials.image-upload-field', ['name' => 'content[hero_image]', 'label' => 'Background Image', 'value' => $page->content('hero_image', url('/assets/img/8.jpg'))])
        </div>
      </div>

      {{-- FAQ Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">FAQ Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[faq][visible]" value="0">
            <input type="checkbox" name="sections[faq][visible]" value="1" {{ $page->visible('faq') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
            <input type="text" name="content[faq_subtitle]" value="{{ old('content.faq_subtitle', $page->content('faq_subtitle', 'frequently asked questions')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="content[faq_title]" value="{{ old('content.faq_title', $page->content('faq_title', 'General queries')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>

        {{-- Dynamic FAQ Items --}}
        @php $faqCount = (int) $page->content('faq_count', 5); @endphp
        <input type="hidden" name="content[faq_count]" id="faq-count" value="{{ $faqCount }}">
        
        <div id="faq-items-container">
          @for($i = 1; $i <= $faqCount; $i++)
          <div class="faq-item border rounded p-4 mb-3 bg-gray-50" data-index="{{ $i }}">
            <div class="flex justify-between items-center mb-2">
              <h3 class="font-medium text-gray-700">FAQ Item <span class="faq-number">{{ $i }}</span></h3>
              <button type="button" class="remove-faq-btn text-red-600 hover:text-red-800" title="Remove FAQ Item">
                <i class="fas fa-trash"></i>
              </button>
            </div>
            <div class="mb-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
              <input type="text" name="content[faq_{{ $i }}_question]" value="{{ old('content.faq_'.$i.'_question', $page->content('faq_'.$i.'_question', '')) }}" class="w-full border rounded px-3 py-2 faq-question" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Answer</label>
              <textarea name="content[faq_{{ $i }}_answer]" rows="3" class="w-full border rounded px-3 py-2 faq-answer">{{ old('content.faq_'.$i.'_answer', $page->content('faq_'.$i.'_answer', '')) }}</textarea>
            </div>
          </div>
          @endfor
        </div>

        <button type="button" id="add-faq-btn" class="mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          <i class="fas fa-plus mr-2"></i>Add FAQ Item
        </button>
      </div>

      {{-- FAQ Template (hidden) --}}
      <template id="faq-template">
        <div class="faq-item border rounded p-4 mb-3 bg-gray-50" data-index="__INDEX__">
          <div class="flex justify-between items-center mb-2">
            <h3 class="font-medium text-gray-700">FAQ Item <span class="faq-number">__INDEX__</span></h3>
            <button type="button" class="remove-faq-btn text-red-600 hover:text-red-800" title="Remove FAQ Item">
              <i class="fas fa-trash"></i>
            </button>
          </div>
          <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
            <input type="text" name="content[faq___INDEX___question]" value="" class="w-full border rounded px-3 py-2 faq-question" placeholder="Enter question" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Answer</label>
            <textarea name="content[faq___INDEX___answer]" rows="3" class="w-full border rounded px-3 py-2 faq-answer" placeholder="Enter answer"></textarea>
          </div>
        </div>
      </template>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
          <i class="fas fa-save mr-2"></i>Save Changes
        </button>
      </div>
    </form>
  </div>
  @include('admin.partials.image-upload-script')
  @include('admin.partials.admin-collapsible', ['pageKey' => 'tandc_page'])

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('faq-items-container');
    const addBtn = document.getElementById('add-faq-btn');
    const template = document.getElementById('faq-template');
    const countInput = document.getElementById('faq-count');

    function updateFaqNumbers() {
      const items = container.querySelectorAll('.faq-item');
      items.forEach((item, idx) => {
        const newIndex = idx + 1;
        item.dataset.index = newIndex;
        item.querySelector('.faq-number').textContent = newIndex;
        
        // Update input names
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        question.name = `content[faq_${newIndex}_question]`;
        answer.name = `content[faq_${newIndex}_answer]`;
      });
      countInput.value = items.length;
    }

    function addRemoveListener(btn) {
      btn.addEventListener('click', function() {
        const items = container.querySelectorAll('.faq-item');
        if (items.length <= 1) {
          alert('You must have at least one FAQ item.');
          return;
        }
        btn.closest('.faq-item').remove();
        updateFaqNumbers();
      });
    }

    // Initialize remove buttons
    container.querySelectorAll('.remove-faq-btn').forEach(addRemoveListener);

    // Add new FAQ item
    addBtn.addEventListener('click', function() {
      const currentCount = container.querySelectorAll('.faq-item').length;
      const newIndex = currentCount + 1;
      const html = template.innerHTML.replace(/__INDEX__/g, newIndex);
      container.insertAdjacentHTML('beforeend', html);
      
      const newItem = container.querySelector('.faq-item:last-child');
      addRemoveListener(newItem.querySelector('.remove-faq-btn'));
      countInput.value = newIndex;
    });
  });
  </script>
</body>
</html>


