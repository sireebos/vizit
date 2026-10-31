@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Website Settings</h1>
                    <p class="mt-2 text-gray-600">Customize your hotel website appearance and content</p>
                </div>
                <a href="/admin/dashboard" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.website-settings.update') }}" method="POST" class="space-y-8">
            @csrf
            
            <!-- Site Information -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Site Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                        <input type="text" name="site_name" value="{{ $settings->site_name }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ $settings->email }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ $settings->phone }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hero Image URL</label>
                        <input type="url" name="hero_image" value="{{ $settings->hero_image }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                        <textarea name="site_description" rows="3" 
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings->site_description }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="address" rows="2" 
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings->address }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Hero Section -->

            <!-- Homepage Sections -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Homepage Sections</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">About Title</label>
                        <input type="text" name="home_about_title" value="{{ $settings->home_about_title }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stay Title</label>
                        <input type="text" name="home_stay_title" value="{{ $settings->home_stay_title }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">About Text</label>
                        <textarea name="home_about_text" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings->home_about_text }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Eat & Drink Title</label>
                        <input type="text" name="home_eat_title" value="{{ $settings->home_eat_title }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gallery Title</label>
                        <input type="text" name="home_gallery_title" value="{{ $settings->home_gallery_title }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Hero Section</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hero Title</label>
                        <input type="text" name="hero_title" value="{{ $settings->hero_title }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hero Subtitle</label>
                        <input type="text" name="hero_subtitle" value="{{ $settings->hero_subtitle }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hero Description</label>
                        <textarea name="hero_description" rows="3" 
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings->hero_description }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Color Theme -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Color Theme</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="primary_color" value="{{ $settings->primary_color }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->primary_color }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="secondary_color" value="{{ $settings->secondary_color }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->secondary_color }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Accent Color</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="accent_color" value="{{ $settings->accent_color }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->accent_color }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Primary Text</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="text_primary" value="{{ $settings->text_primary }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->text_primary }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Text</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="text_secondary" value="{{ $settings->text_secondary }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->text_secondary }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Border Color</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="border_color" value="{{ $settings->border_color }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->border_color }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                </div>
                
                <h3 class="text-lg font-semibold text-gray-900 mt-8 mb-4">Background Colors</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Primary Background</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="background_primary" value="{{ $settings->background_primary }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->background_primary }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Background</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="background_secondary" value="{{ $settings->background_secondary }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->background_secondary }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tertiary Background</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="background_tertiary" value="{{ $settings->background_tertiary }}" 
                                   class="w-12 h-12 border border-gray-300 rounded cursor-pointer">
                            <input type="text" value="{{ $settings->background_tertiary }}" 
                                   class="flex-1 p-2 border border-gray-300 rounded text-sm" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Typography -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Typography</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Primary Font</label>
                        <select name="font_primary" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Arial, sans-serif" {{ $settings->font_primary == 'Arial, sans-serif' ? 'selected' : '' }}>Arial</option>
                            <option value="Helvetica, sans-serif" {{ $settings->font_primary == 'Helvetica, sans-serif' ? 'selected' : '' }}>Helvetica</option>
                            <option value="'Roboto', sans-serif" {{ $settings->font_primary == "'Roboto', sans-serif" ? 'selected' : '' }}>Roboto</option>
                            <option value="'Open Sans', sans-serif" {{ $settings->font_primary == "'Open Sans', sans-serif" ? 'selected' : '' }}>Open Sans</option>
                            <option value="'Lato', sans-serif" {{ $settings->font_primary == "'Lato', sans-serif" ? 'selected' : '' }}>Lato</option>
                            <option value="'Montserrat', sans-serif" {{ $settings->font_primary == "'Montserrat', sans-serif" ? 'selected' : '' }}>Montserrat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Font (Headings)</label>
                        <select name="font_secondary" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Georgia, serif" {{ $settings->font_secondary == 'Georgia, serif' ? 'selected' : '' }}>Georgia</option>
                            <option value="'Times New Roman', serif" {{ $settings->font_secondary == "'Times New Roman', serif" ? 'selected' : '' }}>Times New Roman</option>
                            <option value="'Playfair Display', serif" {{ $settings->font_secondary == "'Playfair Display', serif" ? 'selected' : '' }}>Playfair Display</option>
                            <option value="'Merriweather', serif" {{ $settings->font_secondary == "'Merriweather', serif" ? 'selected' : '' }}>Merriweather</option>
                            <option value="'Lora', serif" {{ $settings->font_secondary == "'Lora', serif" ? 'selected' : '' }}>Lora</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Social Media</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                        <input type="url" name="facebook_url" value="{{ $settings->facebook_url }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                        <input type="url" name="instagram_url" value="{{ $settings->instagram_url }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                        <input type="url" name="twitter_url" value="{{ $settings->twitter_url }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" value="{{ $settings->linkedin_url }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">SEO Settings</h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" 
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings->meta_description }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ $settings->meta_keywords }}" 
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end space-x-4">
                <a href="/admin/dashboard" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Update text input when color picker changes
document.querySelectorAll('input[type="color"]').forEach(colorInput => {
    colorInput.addEventListener('change', function() {
        const textInput = this.nextElementSibling;
        textInput.value = this.value;
    });
});
</script>

@include('admin.partials.collapsible-scripts', ['pageKey' => 'website_settings'])
@endsection
