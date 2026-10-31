<div class="fixed left-0 top-0 h-full w-64 bg-gray-800 text-white shadow-lg z-50">
  <div class="p-4 border-b border-gray-700">
    <h2 class="text-xl font-bold">Admin Panel</h2>
    <p class="text-sm text-gray-400 mt-1">Vizit Hotel & Suites</p>
  </div>
  
  <nav class="mt-4">
    <p class="px-4 py-2 text-xs text-gray-500 uppercase tracking-wider">Settings</p>
    <a href="{{ route('admin.site-settings.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.site-settings.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-cog w-6"></i>
      <span>Site Settings</span>
    </a>
    <a href="{{ route('admin.theme-settings.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.theme-settings.edit') ? 'bg-purple-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-palette w-6"></i>
      <span>Theme Settings</span>
    </a>
    <a href="{{ route('admin.catalog-settings.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.catalog-settings.edit') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-book-open w-6"></i>
      <span>Catalog Settings</span>
    </a>

    <p class="px-4 py-2 text-xs text-gray-500 uppercase tracking-wider mt-4">Pages</p>
    <a href="{{ route('admin.home-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.home-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-home w-6"></i>
      <span>Home Page</span>
    </a>
    <a href="{{ route('admin.about-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.about-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-info-circle w-6"></i>
      <span>About Page</span>
    </a>
    <a href="{{ route('admin.contact-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.contact-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-envelope w-6"></i>
      <span>Contact Page</span>
    </a>
    <a href="{{ route('admin.explore-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.explore-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-compass w-6"></i>
      <span>Explore Page</span>
    </a>
    <a href="{{ route('admin.restaurant-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.restaurant-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-utensils w-6"></i>
      <span>Restaurant Page</span>
    </a>
    <a href="{{ route('admin.rooms-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.rooms-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-bed w-6"></i>
      <span>Rooms Page</span>
    </a>
    <a href="{{ route('admin.rooms-gallery-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.rooms-gallery-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-images w-6"></i>
      <span>Rooms Gallery Page</span>
    </a>
    <a href="{{ route('admin.search-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.search-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-search w-6"></i>
      <span>Search Page</span>
    </a>
    <a href="{{ route('admin.services-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.services-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-concierge-bell w-6"></i>
      <span>Services Page</span>
    </a>
    <a href="{{ route('admin.tandc-page.edit') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.tandc-page.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-file-contract w-6"></i>
      <span>Terms & Conditions</span>
    </a>

    <p class="px-4 py-2 text-xs text-gray-500 uppercase tracking-wider mt-4">Content Management</p>
    <a href="{{ route('admin.room-types.index') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.room-types.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-door-open w-6"></i>
      <span>Room Types</span>
    </a>
    <a href="{{ route('admin.food-menu.index') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.food-menu.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-hamburger w-6"></i>
      <span>Food Menu</span>
    </a>
    <a href="{{ route('admin.bar-menu.index') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.bar-menu.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-glass-martini-alt w-6"></i>
      <span>Bar Menu (Drinks)</span>
    </a>
    <a href="{{ route('admin.gallery-images.index') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.gallery-images.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-photo-video w-6"></i>
      <span>Gallery Images</span>
    </a>
    <a href="{{ route('admin.subscribers.index') }}"
       class="flex items-center px-4 py-3 {{ request()->routeIs('admin.subscribers.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
      <i class="fas fa-users w-6"></i>
      <span>Subscribers</span>
    </a>
  </nav>
  
  <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
    <a href="{{ url('/') }}" target="_blank" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded mb-2">
      <i class="fas fa-external-link-alt w-6"></i>
      <span>View Website</span>
    </a>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="flex items-center w-full px-4 py-2 text-red-400 hover:bg-gray-700 rounded">
        <i class="fas fa-sign-out-alt w-6"></i>
        <span>Logout</span>
      </button>
    </form>
  </div>
</div>

