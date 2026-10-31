<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery Images - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Gallery Images</h1>
      <div class="flex space-x-3">
        <a href="{{ route('gallery') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          <i class="fas fa-eye mr-2"></i>View Gallery
        </a>
        <a href="{{ route('admin.gallery-images.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          <i class="fas fa-plus mr-2"></i>Add Image
        </a>
      </div>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Caption</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sort</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($images as $img)
            @php
              $imgUrl = $img->image_url;
              if (!str_starts_with($imgUrl, 'http') && !str_starts_with($imgUrl, '/assets')) {
                $imgUrl = url('/storage/' . $imgUrl);
              }
            @endphp
            <tr>
              <td class="px-6 py-4"><img src="{{ $imgUrl }}" alt="" class="h-16 w-24 object-cover rounded"></td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $img->caption ?? '-' }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $img->sort_order }}</td>
              <td class="px-6 py-4">
                @if($img->is_active)
                  <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Active</span>
                @else
                  <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">Inactive</span>
                @endif
              </td>
              <td class="px-6 py-4 text-right">
                <a href="{{ route('admin.gallery-images.edit', $img) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.gallery-images.destroy', $img) }}" method="POST" class="inline" onsubmit="return confirm('Delete this image?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No images yet. Click "Add Image" to get started.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>

