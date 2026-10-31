<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Contact Page - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Edit Contact Page</h1>
      <a href="{{ route('contact') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        <i class="fas fa-eye mr-2"></i>View Page
      </a>
    </div>

    @if(session('status'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('status') }}
      </div>
    @endif

    <!-- Reset to Defaults -->
    @include('admin.partials.reset-button', ['resetRoute' => route('admin.contact-page.reset')])

    <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Page Styles Section -->
      @include('admin.partials.page-styles-section', ['pageSettings' => $contact])

      <!-- Section Order (Drag & Drop) -->
      @include('admin.partials.section-order', ['pageSettings' => $contact])

      {{-- SEO Settings --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">SEO Settings</h2>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Page Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $contact->seo_title) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
            <textarea name="seo_description" rows="2" class="w-full border rounded px-3 py-2">{{ old('seo_description', $contact->seo_description) }}</textarea>
          </div>
        </div>
      </div>

      {{-- Hero Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Hero Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[hero][visible]" value="0">
            <input type="checkbox" name="sections[hero][visible]" value="1" {{ $contact->visible('hero') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
            <input type="text" name="content[hero_title]" value="{{ old('content.hero_title', $contact->content('hero_title', 'Get in Touch')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          @include('admin.partials.image-upload-field', ['name' => 'content[hero_image]', 'label' => 'Background Image', 'value' => $contact->content('hero_image', url('/assets/img/gallery/10.jpg'))])
        </div>
      </div>

      {{-- Video Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Video Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[video][visible]" value="0">
            <input type="checkbox" name="sections[video][visible]" value="1" {{ $contact->visible('video') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
            <input type="text" name="content[video_tagline]" value="{{ old('content.video_tagline', $contact->content('video_tagline', 'A new dimension of luxury.')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Video Label</label>
              <input type="text" name="content[video_label]" value="{{ old('content.video_label', $contact->content('video_label', 'our presentation, 0:48 min')) }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
              <input type="text" name="content[video_url]" value="{{ old('content.video_url', $contact->content('video_url', 'https://vimeo.com/54851233')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
        </div>
      </div>

      {{-- Contact Form Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Contact Form Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[contact_form][visible]" value="0">
            <input type="checkbox" name="sections[contact_form][visible]" value="1" {{ $contact->visible('contact_form') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
              <input type="text" name="content[form_subtitle]" value="{{ old('content.form_subtitle', $contact->content('form_subtitle', 'get in touch')) }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
              <input type="text" name="content[form_title]" value="{{ old('content.form_title', $contact->content('form_title', 'drop us a line')) }}" class="w-full border rounded px-3 py-2" />
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Form Recipient Email</label>
            <input type="email" name="content[form_email]" value="{{ old('content.form_email', $contact->content('form_email', '')) }}" class="w-full border rounded px-3 py-2" placeholder="Email address to receive form submissions" />
          </div>
        </div>
      </div>


      {{-- Contact Info Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Contact Info Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[contact_info][visible]" value="0">
            <input type="checkbox" name="sections[contact_info][visible]" value="1" {{ $contact->visible('contact_info') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <input type="text" name="content[info_address]" value="{{ old('content.info_address', $contact->content('info_address', 'Benin City, Edo State, Nigeria')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
            <input type="text" name="content[info_city]" value="{{ old('content.info_city', $contact->content('info_city', 'Benin City')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="text" name="content[info_phone]" value="{{ old('content.info_phone', $contact->content('info_phone', '+234 816 325 9205')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="content[info_email]" value="{{ old('content.info_email', $contact->content('info_email', 'info@vizithotel.com')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Check-In Time</label>
            <input type="text" name="content[info_checkin]" value="{{ old('content.info_checkin', $contact->content('info_checkin', '14:00 pm')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Check-Out Time</label>
            <input type="text" name="content[info_checkout]" value="{{ old('content.info_checkout', $contact->content('info_checkout', '11:00 am')) }}" class="w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Opening Hours</label>
            <input type="text" name="content[info_hours]" value="{{ old('content.info_hours', $contact->content('info_hours', '8am - 10pm')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
      </div>

      {{-- Newsletter Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Newsletter Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[newsletter][visible]" value="0">
            <input type="checkbox" name="sections[newsletter][visible]" value="1" {{ $contact->visible('newsletter') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Subscribe Button Text</label>
          <input type="text" name="content[newsletter_button]" value="{{ old('content.newsletter_button', $contact->content('newsletter_button', 'subscribe')) }}" class="w-full border rounded px-3 py-2" />
        </div>
      </div>

      {{-- Map Section --}}
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
          <h2 class="text-xl font-semibold text-gray-700">Map Section</h2>
          <label class="flex items-center">
            <input type="hidden" name="sections[map][visible]" value="0">
            <input type="checkbox" name="sections[map][visible]" value="1" {{ $contact->visible('map') ? 'checked' : '' }} class="mr-2">
            <span class="text-sm text-gray-600">Visible</span>
          </label>
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Google Maps Embed URL</label>
            <input type="text" name="content[map_embed_url]" value="{{ old('content.map_embed_url', $contact->content('map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3477.123456789!2d47.9783!3d29.3759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjnCsDIyJzMzLjIiTiA0N8KwNTgnNDEuOSJF!5e0!3m2!1sen!2skw!4v1234567890')) }}" class="w-full border rounded px-3 py-2" placeholder="Paste Google Maps embed URL here" />
            <p class="text-xs text-gray-500 mt-1">Get embed URL from Google Maps > Share > Embed a map</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Map Height (px)</label>
            <input type="number" name="content[map_height]" value="{{ old('content.map_height', $contact->content('map_height', '450')) }}" class="w-full border rounded px-3 py-2" />
          </div>
        </div>
      </div>

      {{-- Submit Button --}}
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
          <i class="fas fa-save mr-2"></i>Save Changes
        </button>
      </div>
    </form>
  </div>
  @include('admin.partials.image-upload-script')
  @include('admin.partials.admin-collapsible', ['pageKey' => 'contact_page'])
</body>
</html>
