<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu - Admin Panel</title>
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
                        <a href="/admin/home-page" class="text-gray-600 hover:text-gray-800"><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Food Menu</h1>
                    <p class="text-gray-600 mt-1">Manage your restaurant menu items</p>
                </div>
                <a href="{{ route('admin.food-menu.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Menu Item
                </a>
            </div>

            <!-- Search Box -->
            <div class="mb-6">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search menu items..." class="w-full md:w-96 px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onkeyup="searchMenu()">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <button type="button" onclick="clearSearch()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden" id="clearBtn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-sm text-gray-500 mt-2" id="searchResults"></p>
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
                                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : url('/storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center"><i class="fas fa-utensils text-4xl text-gray-400"></i></div>
                                    @endif
                                    <div class="absolute top-2 right-2">
                                        @if($item->is_available)
                                            <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">Available</span>
                                        @else
                                            <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">Unavailable</span>
                                        @endif
                                    </div>
                                    @if($item->is_featured)
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs"><i class="fas fa-star"></i> Featured</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $item->description }}</p>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-lg font-bold text-green-600">{{ $siteSettings ? $siteSettings->formatPrice($item->price, 2) : '₦' . number_format($item->price, 2) }}</span>
                                        <div class="flex space-x-1">
                                            @if($item->is_vegetarian)<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">V</span>@endif
                                            @if($item->is_vegan)<span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs">VG</span>@endif
                                            @if($item->is_spicy)<span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">🌶️</span>@endif
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.food-menu.edit', $item) }}" class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded text-sm text-center"><i class="fas fa-edit mr-1"></i>Edit</a>
                                        <form action="{{ route('admin.food-menu.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this item?')">
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
                <div class="text-center py-12">
                    <i class="fas fa-utensils text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Menu Items</h3>
                    <p class="text-gray-600 mb-4">Get started by adding your first menu item.</p>
                    <a href="{{ route('admin.food-menu.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>Add Menu Item
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function searchMenu() {
            const searchInput = document.getElementById('searchInput');
            const filter = searchInput.value.toLowerCase();
            const clearBtn = document.getElementById('clearBtn');
            const searchResults = document.getElementById('searchResults');
            
            // Show/hide clear button
            clearBtn.classList.toggle('hidden', filter === '');
            
            // Get all menu item cards
            const cards = document.querySelectorAll('.bg-white.rounded-lg.shadow-md');
            const categories = document.querySelectorAll('.mb-8');
            let visibleCount = 0;
            let totalCount = cards.length;
            
            cards.forEach(card => {
                const name = card.querySelector('h3')?.textContent.toLowerCase() || '';
                const description = card.querySelector('p.text-gray-600')?.textContent.toLowerCase() || '';
                
                if (name.includes(filter) || description.includes(filter)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show/hide empty categories
            categories.forEach(category => {
                const visibleItems = category.querySelectorAll('.bg-white.rounded-lg.shadow-md:not([style*="display: none"])');
                category.style.display = visibleItems.length === 0 ? 'none' : '';
            });
            
            // Update search results text
            if (filter === '') {
                searchResults.textContent = '';
            } else {
                searchResults.textContent = `Showing ${visibleCount} of ${totalCount} items`;
            }
        }
        
        function clearSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.value = '';
            searchMenu();
            searchInput.focus();
        }
    </script>
</body>
</html>

