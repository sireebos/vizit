<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Types - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @include('admin.partials.sidebar')

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Room Types</h1>
                    <p class="text-gray-600 mt-1">Manage your hotel room types and configurations</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('rooms') }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-eye mr-2"></i>View Rooms Page
                    </a>
                    <a href="{{ route('admin.room-types.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i>Add Room Type
                    </a>
                </div>
            </div>
        </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Room Types Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($roomTypes as $roomType)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Room Type Image -->
                        <div class="h-48 bg-gray-200 relative">
                            @if(!empty($roomType->images) && count($roomType->images) > 0)
                                @php
                                    $firstImage = $roomType->images[0];
                                    $imageUrl = str_starts_with($firstImage, 'http') || str_starts_with($firstImage, '/assets') ? $firstImage : url('/storage/' . $firstImage);
                                @endphp
                                <img src="{{ $imageUrl }}"
                                     alt="{{ $roomType->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-bed text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-2 right-2">
                                @if($roomType->is_active)
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">Active</span>
                                @else
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">Inactive</span>
                                @endif
                            </div>
                        </div>

                        <!-- Room Type Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $roomType->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $roomType->description }}</p>
                            
                            <!-- Details -->
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Base Price:</span>
                                    <span class="font-medium">{{ $siteSettings ? $siteSettings->formatPrice($roomType->base_price, 0) : '₦' . number_format($roomType->base_price, 0) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Max Occupancy:</span>
                                    <span class="font-medium">{{ $roomType->max_occupancy }} guests</span>
                                </div>
                                @if($roomType->size_sqft)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Size:</span>
                                        <span class="font-medium">{{ $roomType->size_sqft }} sq ft</span>
                                    </div>
                                @endif
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Rooms:</span>
                                    <span class="font-medium">{{ $roomType->rooms->count() }} rooms</span>
                                </div>
                            </div>

                            <!-- Amenities -->
                            @if(!empty($roomType->amenities) && count($roomType->amenities) > 0)
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 mb-1">Amenities:</p>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($roomType->amenities, 0, 3) as $amenity)
                                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ $amenity }}</span>
                                        @endforeach
                                        @if(count($roomType->amenities) > 3)
                                            <span class="text-gray-500 text-xs">+{{ count($roomType->amenities) - 3 }} more</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.room-types.show', $roomType) }}" 
                                   class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded text-sm text-center">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                                <a href="{{ route('admin.room-types.edit', $roomType) }}" 
                                   class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded text-sm text-center">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.room-types.destroy', $roomType) }}" 
                                      method="POST" class="flex-1" 
                                      onsubmit="return confirm('Are you sure you want to delete this room type?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded text-sm">
                                        <i class="fas fa-trash mr-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-bed text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Room Types</h3>
                        <p class="text-gray-600 mb-4">Get started by creating your first room type.</p>
                        <a href="{{ route('admin.room-types.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i>Add Room Type
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
</body>
</html>
