@extends('layouts.app')

@section('content')
@include('admin.partials.sidebar')

<div class="ml-64 min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Catalog Settings</h1>
                <p class="text-gray-600 mt-1">Customize the appearance of your public catalog page</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/catalog') }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-external-link-alt mr-2"></i>View Catalog
                </a>
                <form action="{{ route('admin.catalog-settings.reset') }}" method="POST" onsubmit="return confirm('Reset all catalog settings to defaults?')">
                    @csrf
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-undo mr-2"></i>Reset to Defaults
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.catalog-settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Display Settings -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="display-section">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-th-large mr-2 text-blue-600"></i>Display Settings
                    </h2>
                    <i class="fas fa-chevron-down toggle-icon transition-transform"></i>
                </button>
                <div id="display-section" class="section-content p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="display_mode" class="block text-sm font-medium text-gray-700 mb-2">Display Mode</label>
                            <select name="display_mode" id="display_mode" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @foreach($displayModes as $value => $label)
                                    <option value="{{ $value }}" {{ $catalog->display_mode == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="items_per_row" class="block text-sm font-medium text-gray-700 mb-2">Items Per Row</label>
                            <select name="items_per_row" id="items_per_row" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @foreach($itemsPerRowOptions as $value => $label)
                                    <option value="{{ $value }}" {{ $catalog->items_per_row == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="default_tab" class="block text-sm font-medium text-gray-700 mb-2">Default Tab</label>
                            <select name="default_tab" id="default_tab" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @foreach($defaultTabOptions as $value => $label)
                                    <option value="{{ $value }}" {{ $catalog->default_tab == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="show_images" value="1" {{ $catalog->show_images ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Show Images</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_descriptions" value="1" {{ $catalog->show_descriptions ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Show Descriptions</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_prices" value="1" {{ $catalog->show_prices ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Show Prices</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_featured_badge" value="1" {{ $catalog->show_featured_badge ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Featured Badge</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_item_count" value="1" {{ $catalog->show_item_count ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Item Count</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Section Visibility -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="visibility-section">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-eye mr-2 text-green-600"></i>Section Visibility
                    </h2>
                    <i class="fas fa-chevron-down toggle-icon transition-transform"></i>
                </button>
                <div id="visibility-section" class="section-content p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <input type="checkbox" name="show_drinks_section" value="1" {{ $catalog->show_drinks_section ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700"><i class="fas fa-glass-martini-alt mr-1"></i>Drinks</span>
                        </label>
                        <label class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <input type="checkbox" name="show_food_section" value="1" {{ $catalog->show_food_section ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700"><i class="fas fa-utensils mr-1"></i>Food</span>
                        </label>
                        <label class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <input type="checkbox" name="show_rooms_section" value="1" {{ $catalog->show_rooms_section ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700"><i class="fas fa-bed mr-1"></i>Rooms</span>
                        </label>
                        <label class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <input type="checkbox" name="show_qrcode_tab" value="1" {{ $catalog->show_qrcode_tab ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700"><i class="fas fa-qrcode mr-1"></i>QR Code</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Header Settings -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="header-section">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-heading mr-2 text-purple-600"></i>Header Settings
                    </h2>
                    <i class="fas fa-chevron-down toggle-icon transition-transform"></i>
                </button>
                <div id="header-section" class="section-content p-6">
                    <div class="mb-4">
                        <label for="tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline / Description</label>
                        <textarea name="tagline" id="tagline" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ $catalog->tagline }}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="show_contact_bar" value="1" {{ $catalog->show_contact_bar ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Contact Bar</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_phone" value="1" {{ $catalog->show_phone ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Phone</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_email" value="1" {{ $catalog->show_email ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Email</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_address" value="1" {{ $catalog->show_address ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Address</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_website" value="1" {{ $catalog->show_website ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Website</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Color Settings -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="color-section">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-palette mr-2 text-pink-600"></i>Color Settings
                    </h2>
                    <i class="fas fa-chevron-down toggle-icon transition-transform"></i>
                </button>
                <div id="color-section" class="section-content p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div>
                            <label for="primary_color" class="block text-sm font-medium text-gray-700 mb-2">Primary / Accent Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="primary_color" id="primary_color" value="{{ $catalog->primary_color }}" class="h-10 w-16 rounded cursor-pointer">
                                <input type="text" value="{{ $catalog->primary_color }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" id="primary_color_text" onchange="document.getElementById('primary_color').value = this.value">
                            </div>
                        </div>
                        
                        <div>
                            <label for="background_color" class="block text-sm font-medium text-gray-700 mb-2">Background Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="background_color" id="background_color" value="{{ $catalog->background_color }}" class="h-10 w-16 rounded cursor-pointer">
                                <input type="text" value="{{ $catalog->background_color }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" id="background_color_text" onchange="document.getElementById('background_color').value = this.value">
                            </div>
                        </div>
                        
                        <div>
                            <label for="card_bg_color" class="block text-sm font-medium text-gray-700 mb-2">Card Background</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="card_bg_color" id="card_bg_color" value="{{ $catalog->card_bg_color }}" class="h-10 w-16 rounded cursor-pointer">
                                <input type="text" value="{{ $catalog->card_bg_color }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" id="card_bg_color_text" onchange="document.getElementById('card_bg_color').value = this.value">
                            </div>
                        </div>
                        
                        <div>
                            <label for="text_color" class="block text-sm font-medium text-gray-700 mb-2">Text Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="text_color" id="text_color" value="{{ $catalog->text_color }}" class="h-10 w-16 rounded cursor-pointer">
                                <input type="text" value="{{ $catalog->text_color }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" id="text_color_text" onchange="document.getElementById('text_color').value = this.value">
                            </div>
                        </div>
                        
                        <div>
                            <label for="muted_text_color" class="block text-sm font-medium text-gray-700 mb-2">Muted Text Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="muted_text_color" id="muted_text_color" value="{{ $catalog->muted_text_color }}" class="h-10 w-16 rounded cursor-pointer">
                                <input type="text" value="{{ $catalog->muted_text_color }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" id="muted_text_color_text" onchange="document.getElementById('muted_text_color').value = this.value">
                            </div>
                        </div>
                        
                        <div>
                            <label for="price_color" class="block text-sm font-medium text-gray-700 mb-2">Price Color <small class="text-gray-500">(leave empty for primary)</small></label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="price_color" id="price_color" value="{{ $catalog->price_color ?? $catalog->primary_color }}" class="h-10 w-16 rounded cursor-pointer">
                                <input type="text" value="{{ $catalog->price_color }}" placeholder="Use primary" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" id="price_color_text" onchange="document.getElementById('price_color').value = this.value">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Color Preview -->
                    <div class="mt-6 p-4 rounded-lg" id="color-preview" style="background: {{ $catalog->background_color }};">
                        <div class="p-4 rounded-lg" style="background: {{ $catalog->card_bg_color }};">
                            <h3 style="color: {{ $catalog->text_color }}; margin-bottom: 5px;">Preview Card Title</h3>
                            <p style="color: {{ $catalog->muted_text_color }}; font-size: 0.875rem;">This is how your muted text will look</p>
                            <p style="color: {{ $catalog->price_color ?? $catalog->primary_color }}; font-weight: bold; margin-top: 10px;">₦5,000.00</p>
                            <span style="background: {{ $catalog->primary_color }}; color: #000; padding: 2px 10px; border-radius: 15px; font-size: 0.75rem;">Featured</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Settings -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="footer-section">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-shoe-prints mr-2 text-gray-600"></i>Footer Settings
                    </h2>
                    <i class="fas fa-chevron-down toggle-icon transition-transform"></i>
                </button>
                <div id="footer-section" class="section-content p-6">
                    <div class="flex gap-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="show_footer" value="1" {{ $catalog->show_footer ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Show Footer</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="show_back_button" value="1" {{ $catalog->show_back_button ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Show Back to Site Button</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Custom CSS -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="css-section">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-code mr-2 text-yellow-600"></i>Custom CSS
                    </h2>
                    <i class="fas fa-chevron-down toggle-icon transition-transform"></i>
                </button>
                <div id="css-section" class="section-content p-6">
                    <div>
                        <label for="custom_css" class="block text-sm font-medium text-gray-700 mb-2">Additional CSS Styles</label>
                        <textarea name="custom_css" id="custom_css" rows="6" placeholder="/* Add your custom CSS here */" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">{{ $catalog->custom_css }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Add custom CSS to further customize the catalog appearance</p>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                    <i class="fas fa-save mr-2"></i>Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .section-content {
        transition: max-height 0.3s ease-out, opacity 0.3s ease-out, padding 0.3s ease-out;
        overflow: hidden;
    }
    
    .section-content.collapsed {
        max-height: 0 !important;
        opacity: 0;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }
    
    .toggle-icon.rotated {
        transform: rotate(180deg);
    }
</style>

<script>
// Toggle section collapse/expand
document.querySelectorAll('.section-toggle').forEach(toggle => {
    toggle.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const content = document.getElementById(targetId);
        const icon = this.querySelector('.toggle-icon');
        
        if (content.classList.contains('collapsed')) {
            content.classList.remove('collapsed');
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.classList.remove('rotated');
            localStorage.setItem('catalog_section_' + targetId, 'open');
        } else {
            content.classList.add('collapsed');
            content.style.maxHeight = '0px';
            icon.classList.add('rotated');
            localStorage.setItem('catalog_section_' + targetId, 'closed');
        }
    });
});

// Restore section states from localStorage
document.querySelectorAll('.section-content').forEach(section => {
    const state = localStorage.getItem('catalog_section_' + section.id);
    if (state === 'closed') {
        section.classList.add('collapsed');
        section.style.maxHeight = '0px';
        const toggle = document.querySelector(`[data-target="${section.id}"]`);
        if (toggle) {
            toggle.querySelector('.toggle-icon').classList.add('rotated');
        }
    } else {
        section.style.maxHeight = section.scrollHeight + 'px';
    }
});

// Sync color inputs with text inputs
document.querySelectorAll('input[type="color"]').forEach(colorInput => {
    const textInput = document.getElementById(colorInput.id + '_text');
    if (textInput) {
        colorInput.addEventListener('input', function() {
            textInput.value = this.value;
            updatePreview();
        });
    }
});

function updatePreview() {
    const preview = document.getElementById('color-preview');
    const card = preview.querySelector('div');
    const title = card.querySelector('h3');
    const muted = card.querySelector('p:first-of-type');
    const price = card.querySelector('p:last-of-type');
    const badge = card.querySelector('span');
    
    preview.style.background = document.getElementById('background_color').value;
    card.style.background = document.getElementById('card_bg_color').value;
    title.style.color = document.getElementById('text_color').value;
    muted.style.color = document.getElementById('muted_text_color').value;
    
    const priceColor = document.getElementById('price_color').value || document.getElementById('primary_color').value;
    price.style.color = priceColor;
    badge.style.background = document.getElementById('primary_color').value;
}
</script>
@endsection
