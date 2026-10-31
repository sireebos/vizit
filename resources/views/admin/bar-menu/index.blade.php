@extends('layouts.app')

@section('content')
@include('admin.partials.sidebar')

<div class="ml-64 min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Bar Menu (Drinks)</h1>
                <p class="text-gray-600 mt-1">Manage your bar and beverage items</p>
            </div>
            <a href="{{ route('admin.bar-menu.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Drink
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        @foreach($categories as $categoryKey => $categoryName)
            @php $categoryItems = $menuItems->where('category', $categoryKey); @endphp
            @if($categoryItems->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">{{ $categoryName }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoryItems as $item)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="h-40 bg-gray-200 relative">
                                @if($item->image)
                                    <img src="{{ \App\Helpers\ImageHelper::url($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"><i class="fas fa-glass-martini-alt text-4xl text-gray-400"></i></div>
                                @endif
                                <div class="absolute top-2 right-2 flex space-x-1">
                                    @if($item->is_available)
                                        <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">Available</span>
                                    @else
                                        <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">Unavailable</span>
                                    @endif
                                </div>
                                <div class="absolute top-2 left-2 flex space-x-1">
                                    @if($item->is_featured)
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs"><i class="fas fa-star"></i></span>
                                    @endif
                                    @if($item->is_alcoholic)
                                        <span class="bg-red-600 text-white px-2 py-1 rounded-full text-xs">21+</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $item->description }}</p>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-lg font-bold text-green-600">{{ $item->formatted_price }}</span>
                                    @if($item->serving_size)
                                    <span class="text-gray-500 text-sm">{{ $item->serving_size }}</span>
                                    @endif
                                </div>
                                @if($item->alcohol_content)
                                <p class="text-xs text-gray-500 mb-2">Alcohol: {{ $item->alcohol_content }}%</p>
                                @endif
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.bar-menu.edit', $item) }}" class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded text-sm text-center"><i class="fas fa-edit mr-1"></i>Edit</a>
                                    <form action="{{ route('admin.bar-menu.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded text-sm"><i class="fas fa-trash mr-1"></i>Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach

        @if($menuItems->count() == 0)
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-glass-martini-alt text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Drink Items</h3>
                <p class="text-gray-600 mb-4">Get started by adding your first drink item.</p>
                <a href="{{ route('admin.bar-menu.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Drink
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
