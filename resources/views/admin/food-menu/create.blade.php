<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/admin/home-page" class="text-xl font-bold text-gray-800"><i class="fas fa-crown mr-2"></i>Vermon Admin</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/" class="text-gray-600 hover:text-gray-800"><i class="fas fa-home mr-1"></i>View Website</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center space-x-4">
                <a href="{{ route('admin.food-menu.index') }}" class="text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left"></i></a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add Menu Item</h1>
                    <p class="text-gray-600 mt-1">Create a new menu item</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <form action="{{ route('admin.food-menu.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" name="name" id="name" required class="w-full p-3 border border-gray-300 rounded-lg" value="{{ old('name') }}" placeholder="Grilled Salmon">
                            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select name="category" id="category" required class="w-full p-3 border border-gray-300 rounded-lg">
                                @foreach($categories as $key => $name)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="3" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Describe the dish...">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ({{ $siteSettings->currency_symbol ?? '₦' }}) *</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" required class="w-full p-3 border border-gray-300 rounded-lg" value="{{ old('price') }}" placeholder="19.99">
                        </div>
                        <div>
                            <label for="preparation_time" class="block text-sm font-medium text-gray-700 mb-2">Prep Time (mins)</label>
                            <input type="number" name="preparation_time" id="preparation_time" min="0" class="w-full p-3 border border-gray-300 rounded-lg" value="{{ old('preparation_time') }}" placeholder="15">
                        </div>
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" min="0" class="w-full p-3 border border-gray-300 rounded-lg" value="{{ old('sort_order', 0) }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <input type="hidden" name="image" id="image-value" value="{{ old('image') }}">
                        <div class="flex items-center space-x-4">
                            <div id="image-preview" class="w-32 h-32 bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden">
                                <span class="text-gray-400 text-sm text-center px-2">No image</span>
                            </div>
                            <div class="flex-1">
                                <input type="file" id="image-upload" accept="image/*" class="hidden">
                                <button type="button" onclick="document.getElementById('image-upload').click()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                    <i class="fas fa-upload mr-2"></i>Upload Image
                                </button>
                                <button type="button" id="remove-image-btn" onclick="removeImage()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg ml-2 hidden">
                                    <i class="fas fa-trash mr-2"></i>Remove
                                </button>
                                <p class="text-gray-500 text-sm mt-2">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        @error('image')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ingredients</label>
                        <div id="ingredients-container" class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <input type="text" name="ingredients[]" class="flex-1 p-3 border border-gray-300 rounded-lg" placeholder="e.g., Fresh Salmon">
                                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <button type="button" onclick="addIngredient()" class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"><i class="fas fa-plus mr-2"></i>Add Ingredient</button>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Allergens</label>
                        <div id="allergens-container" class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <input type="text" name="allergens[]" class="flex-1 p-3 border border-gray-300 rounded-lg" placeholder="e.g., Fish, Nuts">
                                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <button type="button" onclick="addAllergen()" class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"><i class="fas fa-plus mr-2"></i>Add Allergen</button>
                    </div>

                    <div class="flex flex-wrap gap-6">
                        <label class="flex items-center"><input type="checkbox" name="is_vegetarian" value="1" {{ old('is_vegetarian') ? 'checked' : '' }} class="mr-2">Vegetarian</label>
                        <label class="flex items-center"><input type="checkbox" name="is_vegan" value="1" {{ old('is_vegan') ? 'checked' : '' }} class="mr-2">Vegan</label>
                        <label class="flex items-center"><input type="checkbox" name="is_spicy" value="1" {{ old('is_spicy') ? 'checked' : '' }} class="mr-2">Spicy</label>
                        <label class="flex items-center"><input type="checkbox" name="is_available" value="1" checked class="mr-2">Available</label>
                        <label class="flex items-center"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="mr-2">Featured</label>
                    </div>

                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <a href="{{ route('admin.food-menu.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Create Menu Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function addIngredient() {
            const container = document.getElementById('ingredients-container');
            const div = document.createElement('div');
            div.className = 'flex items-center space-x-2';
            div.innerHTML = `<input type="text" name="ingredients[]" class="flex-1 p-3 border border-gray-300 rounded-lg" placeholder="e.g., Fresh Salmon">
                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"><i class="fas fa-minus"></i></button>`;
            container.appendChild(div);
        }
        function addAllergen() {
            const container = document.getElementById('allergens-container');
            const div = document.createElement('div');
            div.className = 'flex items-center space-x-2';
            div.innerHTML = `<input type="text" name="allergens[]" class="flex-1 p-3 border border-gray-300 rounded-lg" placeholder="e.g., Fish, Nuts">
                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"><i class="fas fa-minus"></i></button>`;
            container.appendChild(div);
        }

        // Image upload handling
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

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
                    document.getElementById('image-value').value = data.path;
                    document.getElementById('image-preview').innerHTML = `<img src="${data.url}" class="w-full h-full object-cover">`;
                    document.getElementById('remove-image-btn').classList.remove('hidden');
                } else {
                    alert('Upload failed: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Upload failed. Please try again.');
            });
        });

        function removeImage() {
            document.getElementById('image-value').value = '';
            document.getElementById('image-preview').innerHTML = '<span class="text-gray-400 text-sm text-center px-2">No image</span>';
            document.getElementById('remove-image-btn').classList.add('hidden');
            document.getElementById('image-upload').value = '';
        }
    </script>
</body>
</html>

