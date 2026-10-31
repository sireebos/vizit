@extends('layouts.app')

@section('content')
@include('admin.partials.sidebar')

<div class="ml-64 min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.bar-menu.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Back to Bar Menu
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mt-4">Edit Drink: {{ $barMenu->name }}</h1>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.bar-menu.update', $barMenu) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $barMenu->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select name="category" id="category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category', $barMenu->category) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $barMenu->price) }}" step="0.01" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description', $barMenu->description) }}</textarea>
                </div>

                <div>
                    <label for="serving_size" class="block text-sm font-medium text-gray-700 mb-2">Serving Size</label>
                    <input type="text" name="serving_size" id="serving_size" value="{{ old('serving_size', $barMenu->serving_size) }}" placeholder="e.g., 330ml, 750ml" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="alcohol_content" class="block text-sm font-medium text-gray-700 mb-2">Alcohol Content (%)</label>
                    <input type="number" name="alcohol_content" id="alcohol_content" value="{{ old('alcohol_content', $barMenu->alcohol_content) }}" step="0.1" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="ingredients" class="block text-sm font-medium text-gray-700 mb-2">Ingredients</label>
                    <textarea name="ingredients" id="ingredients" rows="2" placeholder="List ingredients, separated by commas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('ingredients', $barMenu->ingredients) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="preparation_notes" class="block text-sm font-medium text-gray-700 mb-2">Preparation Notes</label>
                    <textarea name="preparation_notes" id="preparation_notes" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('preparation_notes', $barMenu->preparation_notes) }}</textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    @if($barMenu->image)
                        <div class="mb-2">
                            <img src="{{ \App\Helpers\ImageHelper::url($barMenu->image) }}" alt="{{ $barMenu->name }}" class="h-32 w-auto rounded">
                            <p class="text-xs text-gray-500 mt-1">Current image</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $barMenu->sort_order) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2 flex flex-wrap gap-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_available" value="1" {{ old('is_available', $barMenu->is_available) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Available</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $barMenu->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Featured</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_alcoholic" value="1" {{ old('is_alcoholic', $barMenu->is_alcoholic) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Contains Alcohol (21+)</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.bar-menu.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Update Drink
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
