<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Add Gallery Image - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Add Gallery Image</h1>
      <a href="{{ route('admin.gallery-images.index') }}" class="text-gray-600 hover:text-gray-800">
        <i class="fas fa-arrow-left mr-2"></i>Back to Gallery
      </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl">
      @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.gallery-images.store') }}" method="POST" onsubmit="console.log('Form submitting, image_url value:', document.getElementById('image_url').value); return true;">
        @csrf
        <div class="space-y-6">
          @include('admin.partials.image-upload-field', ['name' => 'image_url', 'label' => 'Image', 'value' => old('image_url', ''), 'required' => true])
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Caption (optional)</label>
            <input type="text" name="caption" class="w-full p-3 border rounded" placeholder="Describe this image">
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
              <input type="number" name="sort_order" value="0" class="w-full p-3 border rounded">
            </div>
            <div class="flex items-center pt-8">
              <label class="inline-flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" class="mr-2 h-5 w-5" checked>
                <span class="text-sm text-gray-700">Active (visible on gallery page)</span>
              </label>
            </div>
          </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
          <a href="{{ route('admin.gallery-images.index') }}" class="px-4 py-2 border rounded hover:bg-gray-50">Cancel</a>
          <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            <i class="fas fa-save mr-2"></i>Save Image
          </button>
        </div>
      </form>
    </div>
  </div>
  @include('admin.partials.image-upload-script')
</body>
</html>

