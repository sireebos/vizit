<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room Type - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @include('admin.partials.sidebar')

    <div class="ml-64 p-8">
        <div class="mb-6 flex items-center space-x-4">
            <a href="{{ route('admin.room-types.index') }}" class="text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left"></i></a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Room Type</h1>
                <p class="text-gray-600 mt-1">Update {{ $roomType->name }}</p>
            </div>
        </div>

            <div class="bg-white rounded-lg shadow-md">
                <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Room Type Name *</label>
                            <input type="text" name="name" id="name" required
                                   class="w-full p-3 border border-gray-300 rounded-lg"
                                   value="{{ old('name', $roomType->name) }}">
                        </div>
                        <div>
                            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                            <input type="text" name="subtitle" id="subtitle"
                                   class="w-full p-3 border border-gray-300 rounded-lg"
                                   value="{{ old('subtitle', $roomType->subtitle) }}"
                                   placeholder="e.g., pool suite, small room">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="base_price" class="block text-sm font-medium text-gray-700 mb-2">Base Price per Night (₦) *</label>
                            <input type="number" name="base_price" id="base_price" step="1" min="0" required
                                   class="w-full p-3 border border-gray-300 rounded-lg"
                                   value="{{ old('base_price', $roomType->base_price) }}">
                        </div>
                        <div>
                            <label for="stars" class="block text-sm font-medium text-gray-700 mb-2">Star Rating</label>
                            <select name="stars" id="stars" class="w-full p-3 border border-gray-300 rounded-lg">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('stars', $roomType->stars ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full p-3 border border-gray-300 rounded-lg">{{ old('description', $roomType->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label for="max_occupancy" class="block text-sm font-medium text-gray-700 mb-2">Max Occupancy *</label>
                            <select name="max_occupancy" id="max_occupancy" required class="w-full p-3 border border-gray-300 rounded-lg">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('max_occupancy', $roomType->max_occupancy) == $i ? 'selected' : '' }}>{{ $i }} Guest{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="max_adults" class="block text-sm font-medium text-gray-700 mb-2">Max Adults *</label>
                            <input type="number" name="max_adults" id="max_adults" min="1" required
                                   class="w-full p-3 border border-gray-300 rounded-lg"
                                   value="{{ old('max_adults', $roomType->max_adults) }}">
                        </div>
                        <div>
                            <label for="max_children" class="block text-sm font-medium text-gray-700 mb-2">Max Children *</label>
                            <input type="number" name="max_children" id="max_children" min="0" required
                                   class="w-full p-3 border border-gray-300 rounded-lg"
                                   value="{{ old('max_children', $roomType->max_children) }}">
                        </div>
                        <div>
                            <label for="size_sqft" class="block text-sm font-medium text-gray-700 mb-2">Size (sq ft)</label>
                            <input type="number" name="size_sqft" id="size_sqft" step="0.01" min="0"
                                   class="w-full p-3 border border-gray-300 rounded-lg"
                                   value="{{ old('size_sqft', $roomType->size_sqft) }}">
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amenities</label>
                        <div id="amenities-container" class="space-y-2">
                            @forelse($roomType->amenities ?? [] as $amenity)
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="amenities[]" class="flex-1 p-3 border border-gray-300 rounded-lg" value="{{ $amenity }}">
                                    <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"><i class="fas fa-minus"></i></button>
                                </div>
                            @empty
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="amenities[]" class="flex-1 p-3 border border-gray-300 rounded-lg" placeholder="e.g., Free WiFi">
                                    <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"><i class="fas fa-minus"></i></button>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addAmenity()" class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"><i class="fas fa-plus mr-2"></i>Add Amenity</button>
                    </div>

                    <!-- Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Room Images</label>
                        <div id="images-container" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($roomType->images ?? [] as $image)
                                <div class="relative group">
                                    <input type="hidden" name="images[]" value="{{ $image }}">
                                    <img src="{{ str_starts_with($image, 'http') ? $image : url('/storage/' . $image) }}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                                    <button type="button" onclick="this.parentElement.remove()"
                                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white w-6 h-6 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <input type="file" id="image-upload" accept="image/*" class="hidden" multiple>
                        <button type="button" onclick="document.getElementById('image-upload').click()" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"><i class="fas fa-upload mr-2"></i>Upload Images</button>
                        <p class="text-gray-500 text-sm mt-2">PNG, JPG, GIF up to 2MB each. You can select multiple images.</p>
                    </div>

                    <div class="flex items-center space-x-6">
                        <div>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $roomType->is_active) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active (visible on website)</label>
                        </div>
                        <div>
                            <label for="sort_order" class="text-sm font-medium text-gray-700 mr-2">Sort Order:</label>
                            <input type="number" name="sort_order" id="sort_order" min="0" class="w-20 p-2 border border-gray-300 rounded-lg" value="{{ old('sort_order', $roomType->sort_order) }}">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <a href="{{ route('admin.room-types.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Update Room Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addAmenity() {
            const container = document.getElementById('amenities-container');
            const div = document.createElement('div');
            div.className = 'flex items-center space-x-2';
            div.innerHTML = `<input type="text" name="amenities[]" class="flex-1 p-3 border border-gray-300 rounded-lg" placeholder="e.g., Free WiFi">
                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"><i class="fas fa-minus"></i></button>`;
            container.appendChild(div);
        }

        // Image upload handling
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const files = e.target.files;
            if (!files.length) return;

            Array.from(files).forEach(file => {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                fetch('/admin/upload-image', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addImagePreview(data.path, data.url);
                    } else {
                        alert('Upload failed: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Upload failed. Please try again.');
                });
            });

            // Reset file input
            e.target.value = '';
        });

        function addImagePreview(path, url) {
            const container = document.getElementById('images-container');
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <input type="hidden" name="images[]" value="${path}">
                <img src="${url}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                <button type="button" onclick="this.parentElement.remove()"
                        class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white w-6 h-6 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <i class="fas fa-times text-xs"></i>
                </button>
            `;
            container.appendChild(div);
        }
    </script>
    @include('admin.partials.admin-collapsible', ['pageKey' => 'room_type_edit'])
</body>
</html>