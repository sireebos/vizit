<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $roomType->name }} - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @include('admin.partials.sidebar')

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.room-types.index') }}" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $roomType->name }}</h1>
                        <p class="text-gray-600 mt-1">{{ $roomType->subtitle ?? 'Room Type Details' }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.room-types.edit', $roomType) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Room Type Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Images -->
                @if(!empty($roomType->images) && count($roomType->images) > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Images</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($roomType->images as $image)
                            <img src="@imgUrl($image)" alt="{{ $roomType->name }}" 
                                 class="w-full h-32 object-cover rounded-lg">
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Description -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Description</h2>
                    <p class="text-gray-700">{{ $roomType->description ?? 'No description available.' }}</p>
                </div>

                <!-- Amenities -->
                @if(!empty($roomType->amenities) && count($roomType->amenities) > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Amenities</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($roomType->amenities as $amenity)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                {{ $amenity }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <!-- Quick Stats -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Details</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Base Price:</span>
                            <span class="font-semibold text-green-600">{{ $siteSettings ? $siteSettings->formatPrice($roomType->base_price, 0) : '₦' . number_format($roomType->base_price, 0) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Max Occupancy:</span>
                            <span class="font-medium">{{ $roomType->max_occupancy }} guests</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Max Adults:</span>
                            <span class="font-medium">{{ $roomType->max_adults }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Max Children:</span>
                            <span class="font-medium">{{ $roomType->max_children }}</span>
                        </div>
                        @if($roomType->size_sqft)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Size:</span>
                            <span class="font-medium">{{ $roomType->size_sqft }} sq ft</span>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-500">Star Rating:</span>
                            <span class="font-medium text-yellow-500">
                                @for($i = 0; $i < ($roomType->stars ?? 5); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status:</span>
                            <span class="px-2 py-1 rounded text-xs {{ $roomType->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $roomType->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Rooms Count -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Rooms</h2>
                    <div class="text-center">
                        <span class="text-4xl font-bold text-blue-600">{{ $roomType->rooms->count() }}</span>
                        <p class="text-gray-500 mt-1">rooms of this type</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

