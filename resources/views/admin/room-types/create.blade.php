<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Room Type - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @include('admin.partials.sidebar')

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.room-types.index') }}"
                   class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Create Room Type</h1>
                    <p class="text-gray-600 mt-1">Add a new room type to your hotel</p>
                </div>
            </div>
        </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-md">
                <form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Room Type Name *
                            </label>
                            <input type="text" name="name" id="name" required
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., Deluxe Suite"
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                                Subtitle
                            </label>
                            <input type="text" name="subtitle" id="subtitle"
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., pool suite, small room"
                                   value="{{ old('subtitle') }}">
                            @error('subtitle')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="base_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Base Price per Night (₦) *
                            </label>
                            <input type="number" name="base_price" id="base_price" step="1" min="0" required
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="50000"
                                   value="{{ old('base_price') }}">
                            @error('base_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stars" class="block text-sm font-medium text-gray-700 mb-2">
                                Star Rating
                            </label>
                            <select name="stars" id="stars"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('stars', 5) == $i ? 'selected' : '' }}>
                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('stars')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Describe the room type, its features, and what makes it special...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Room Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="max_occupancy" class="block text-sm font-medium text-gray-700 mb-2">
                                Max Occupancy *
                            </label>
                            <select name="max_occupancy" id="max_occupancy" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('max_occupancy', 2) == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}
                                    </option>
                                @endfor
                            </select>
                            @error('max_occupancy')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="max_adults" class="block text-sm font-medium text-gray-700 mb-2">
                                Max Adults *
                            </label>
                            <input type="number" name="max_adults" id="max_adults" min="1" required
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="2"
                                   value="{{ old('max_adults', 2) }}">
                            @error('max_adults')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="max_children" class="block text-sm font-medium text-gray-700 mb-2">
                                Max Children *
                            </label>
                            <input type="number" name="max_children" id="max_children" min="0" required
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="2"
                                   value="{{ old('max_children', 2) }}">
                            @error('max_children')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="size_sqft" class="block text-sm font-medium text-gray-700 mb-2">
                                Size (sq ft)
                            </label>
                            <input type="number" name="size_sqft" id="size_sqft" step="0.01" min="0"
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="450"
                                   value="{{ old('size_sqft') }}">
                            @error('size_sqft')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                Sort Order
                            </label>
                            <input type="number" name="sort_order" id="sort_order" min="0"
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0"
                                   value="{{ old('sort_order', 0) }}">
                            @error('sort_order')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Amenities
                        </label>
                        <div id="amenities-container" class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <input type="text" name="amenities[]" 
                                       class="flex-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="e.g., Free WiFi">
                                <button type="button" onclick="removeAmenity(this)" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" onclick="addAmenity()" 
                                class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded flex items-center">
                            <i class="fas fa-plus mr-2"></i>Add Amenity
                        </button>
                    </div>

                    <!-- Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Room Images
                        </label>
                        <div id="images-container" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Images will be added here dynamically -->
                        </div>
                        <input type="file" id="image-upload" accept="image/*" class="hidden" multiple>
                        <button type="button" onclick="document.getElementById('image-upload').click()"
                                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center">
                            <i class="fas fa-upload mr-2"></i>Upload Images
                        </button>
                        <p class="text-gray-500 text-sm mt-2">PNG, JPG, GIF up to 2MB each. You can select multiple images.</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Active (visible on website)
                        </label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <a href="{{ route('admin.room-types.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg">
                            Cancel
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                            Create Room Type
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <script>
        function addAmenity() {
            const container = document.getElementById('amenities-container');
            const div = document.createElement('div');
            div.className = 'flex items-center space-x-2';
            div.innerHTML = `
                <input type="text" name="amenities[]"
                       class="flex-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="e.g., Free WiFi">
                <button type="button" onclick="removeAmenity(this)"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(div);
        }

        function removeAmenity(button) {
            const container = document.getElementById('amenities-container');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
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
</body>
</html>
