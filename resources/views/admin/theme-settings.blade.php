<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Theme Settings - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    .color-preview {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      border: 2px solid #e5e7eb;
      cursor: pointer;
    }
    .color-input-wrapper {
      position: relative;
    }
    .color-input-wrapper input[type="color"] {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;
    }
  </style>
</head>
<body class="bg-gray-100">
  @include('admin.partials.sidebar')

  <div class="ml-64 p-8">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800"><i class="fas fa-palette mr-3"></i>Theme Settings</h1>
        <p class="text-gray-600 mt-1">Customize colors, fonts, and styling for your website</p>
      </div>
      <form action="{{ route('admin.theme-settings.reset') }}" method="POST" onsubmit="return confirm('Reset all theme settings to default?')">
        @csrf
        <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-undo mr-2"></i>Reset to Default
        </button>
      </form>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.theme-settings.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Colors Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-eye-dropper mr-2 text-blue-500"></i>Colors
          </h2>
          
          <div class="grid grid-cols-2 gap-4">
            <!-- Primary Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->primary_color }}"></div>
                  <input type="color" name="primary_color" value="{{ $theme->primary_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.nextElementSibling.value = this.value">
                  <input type="text" value="{{ $theme->primary_color }}" class="hidden">
                </div>
                <input type="text" name="primary_color" value="{{ $theme->primary_color }}" 
                       class="flex-1 p-2 border rounded text-sm" 
                       onchange="this.parentElement.querySelector('.color-preview').style.backgroundColor = this.value">
              </div>
            </div>

            <!-- Secondary Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->secondary_color }}"></div>
                  <input type="color" value="{{ $theme->secondary_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="secondary_color" value="{{ $theme->secondary_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>

            <!-- Accent Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Accent Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->accent_color }}"></div>
                  <input type="color" value="{{ $theme->accent_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="accent_color" value="{{ $theme->accent_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>

            <!-- Text Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Text Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->text_color }}"></div>
                  <input type="color" value="{{ $theme->text_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="text_color" value="{{ $theme->text_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>

            <!-- Heading Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Heading Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->heading_color }}"></div>
                  <input type="color" value="{{ $theme->heading_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="heading_color" value="{{ $theme->heading_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>

            <!-- Link Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Link Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->link_color }}"></div>
                  <input type="color" value="{{ $theme->link_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="link_color" value="{{ $theme->link_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>
          </div>
        </div>

        <!-- Button Colors -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-square mr-2 text-green-500"></i>Button & Footer Colors
          </h2>
          
          <div class="grid grid-cols-2 gap-4">
            <!-- Button Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Button Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->button_color }}"></div>
                  <input type="color" value="{{ $theme->button_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="button_color" value="{{ $theme->button_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>

            <!-- Button Hover Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Button Hover Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->button_hover_color }}"></div>
                  <input type="color" value="{{ $theme->button_hover_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="button_hover_color" value="{{ $theme->button_hover_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>

            <!-- Footer Background -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Footer Background</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->footer_bg_color }}"></div>
                  <input type="color" value="{{ $theme->footer_bg_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="footer_bg_color" value="{{ $theme->footer_bg_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>

            <!-- Footer Text Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Footer Text Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->footer_text_color }}"></div>
                  <input type="color" value="{{ $theme->footer_text_color }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="footer_text_color" value="{{ $theme->footer_text_color }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
            </div>
          </div>
        </div>

        <!-- Loader & Effects Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-spinner mr-2 text-indigo-500"></i>Loader & Effects
          </h2>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Reveal Effect Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Reveal Effect Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->reveal_color ?? '#1a2a3a' }}"></div>
                  <input type="color" value="{{ $theme->reveal_color ?? '#1a2a3a' }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="reveal_color" value="{{ $theme->reveal_color ?? '#1a2a3a' }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
              <p class="text-xs text-gray-500 mt-1">Color shown during image reveal animations</p>
            </div>

            <!-- Loader Background Color -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Loader Background Color</label>
              <div class="flex items-center space-x-2">
                <div class="color-input-wrapper">
                  <div class="color-preview" style="background-color: {{ $theme->loader_bg_color ?? '#ffffff' }}"></div>
                  <input type="color" value="{{ $theme->loader_bg_color ?? '#ffffff' }}" 
                         onchange="this.previousElementSibling.style.backgroundColor = this.value; this.parentElement.nextElementSibling.value = this.value">
                </div>
                <input type="text" name="loader_bg_color" value="{{ $theme->loader_bg_color ?? '#ffffff' }}" 
                       class="flex-1 p-2 border rounded text-sm">
              </div>
              <p class="text-xs text-gray-500 mt-1">Background color of the page loader</p>
            </div>

            <!-- Loader Image -->
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-2">Loader Image (Optional)</label>
              <div class="flex items-start space-x-4">
                <div class="w-24 h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                  @if($theme->loader_image)
                    <img src="@imgUrl($theme->loader_image)" alt="Loader" class="max-w-full max-h-full object-contain">
                  @else
                    <i class="fas fa-image text-3xl text-gray-400"></i>
                  @endif
                </div>
                <div class="flex-1">
                  <input type="file" name="loader_image" accept="image/*" class="w-full p-2 border rounded text-sm">
                  <p class="text-xs text-gray-500 mt-1">Upload a custom loader image (GIF recommended). Leave empty to use animated spinner.</p>
                  @if($theme->loader_image)
                    <div class="mt-2">
                      <label class="inline-flex items-center text-sm text-red-600 cursor-pointer">
                        <input type="checkbox" name="remove_loader_image" value="1" class="mr-2">
                        Remove current loader image
                      </label>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <!-- Effect Preview -->
          <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <p class="text-sm text-gray-600 mb-2">Reveal Effect Preview:</p>
            <div class="flex items-center space-x-4">
              <div class="w-32 h-20 rounded relative overflow-hidden" style="background-color: {{ $theme->reveal_color ?? '#1a2a3a' }}">
                <div class="absolute inset-0 flex items-center justify-center text-white text-xs">Reveal Color</div>
              </div>
              <div class="w-20 h-20 rounded flex items-center justify-center" style="background-color: {{ $theme->loader_bg_color ?? '#ffffff' }}; border: 1px solid #ddd;">
                @if($theme->loader_image)
                  <img src="@imgUrl($theme->loader_image)" alt="Loader" class="max-w-full max-h-full object-contain">
                @else
                  <div class="w-8 h-8 rounded-full animate-pulse" style="background-color: {{ $theme->reveal_color ?? '#1a2a3a' }}"></div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Typography Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-font mr-2 text-purple-500"></i>Typography
          </h2>
          
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Heading Font</label>
              <select name="heading_font" class="w-full p-3 border rounded-lg">
                @foreach($fonts as $value => $label)
                  <option value="{{ $value }}" {{ $theme->heading_font == $value ? 'selected' : '' }} style="font-family: '{{ $value }}'">
                    {{ $label }}
                  </option>
                @endforeach
              </select>
              <p class="text-xs text-gray-500 mt-1">Used for h1, h2, h3, etc.</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Body Font</label>
              <select name="body_font" class="w-full p-3 border rounded-lg">
                @foreach($fonts as $value => $label)
                  <option value="{{ $value }}" {{ $theme->body_font == $value ? 'selected' : '' }} style="font-family: '{{ $value }}'">
                    {{ $label }}
                  </option>
                @endforeach
              </select>
              <p class="text-xs text-gray-500 mt-1">Used for paragraphs and general text</p>
            </div>
          </div>
        </div>

        <!-- Layout Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-columns mr-2 text-orange-500"></i>Layout & Style
          </h2>
          
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Header Style</label>
              <select name="header_style" class="w-full p-3 border rounded-lg">
                <option value="dark" {{ $theme->header_style == 'dark' ? 'selected' : '' }}>Dark</option>
                <option value="light" {{ $theme->header_style == 'light' ? 'selected' : '' }}>Light</option>
                <option value="transparent" {{ $theme->header_style == 'transparent' ? 'selected' : '' }}>Transparent</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Button Style</label>
              <select name="button_style" class="w-full p-3 border rounded-lg">
                <option value="rounded" {{ $theme->button_style == 'rounded' ? 'selected' : '' }}>Rounded</option>
                <option value="square" {{ $theme->button_style == 'square' ? 'selected' : '' }}>Square</option>
                <option value="pill" {{ $theme->button_style == 'pill' ? 'selected' : '' }}>Pill</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Layout Style</label>
              <select name="layout_style" class="w-full p-3 border rounded-lg">
                <option value="wide" {{ $theme->layout_style == 'wide' ? 'selected' : '' }}>Wide (Full Width)</option>
                <option value="boxed" {{ $theme->layout_style == 'boxed' ? 'selected' : '' }}>Boxed</option>
              </select>
            </div>

            <div class="flex items-center pt-2">
              <label class="inline-flex items-center">
                <input type="hidden" name="sticky_header" value="0">
                <input type="checkbox" name="sticky_header" value="1" class="mr-2 h-5 w-5" {{ $theme->sticky_header ? 'checked' : '' }}>
                <span class="text-sm text-gray-700">Enable Sticky Header</span>
              </label>
            </div>

            <div class="flex items-center pt-2">
              <label class="inline-flex items-center">
                <input type="hidden" name="show_top_bar" value="0">
                <input type="checkbox" name="show_top_bar" value="1" class="mr-2 h-5 w-5" {{ $theme->show_top_bar ? 'checked' : '' }}>
                <span class="text-sm text-gray-700">Show Top Bar (phone & social links)</span>
              </label>
            </div>
          </div>
        </div>

      </div>

      <!-- Custom CSS Section -->
      <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
          <i class="fas fa-code mr-2 text-red-500"></i>Custom CSS
        </h2>
        <p class="text-sm text-gray-600 mb-3">Add custom CSS to further customize your theme. This will be injected into the site header.</p>
        <textarea name="custom_css" rows="8" class="w-full p-3 border rounded-lg font-mono text-sm" 
                  placeholder="/* Add your custom CSS here */&#10;.my-class {&#10;    color: red;&#10;}">{{ $theme->custom_css }}</textarea>
      </div>

      <!-- Save Button -->
      <div class="flex justify-end mt-6 space-x-4">
        <a href="{{ url('/') }}" target="_blank" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg">
          <i class="fas fa-eye mr-2"></i>Preview Site
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">
          <i class="fas fa-save mr-2"></i>Save Theme Settings
        </button>
      </div>
    </form>
  </div>

  <script>
    // Sync color picker with text input
    document.querySelectorAll('input[type="color"]').forEach(function(colorInput) {
      colorInput.addEventListener('input', function() {
        const wrapper = this.closest('.flex');
        const textInput = wrapper.querySelector('input[type="text"]');
        const preview = wrapper.querySelector('.color-preview');
        if (textInput) textInput.value = this.value;
        if (preview) preview.style.backgroundColor = this.value;
      });
    });

    // Sync text input with color preview
    document.querySelectorAll('.color-input-wrapper + input[type="text"]').forEach(function(textInput) {
      textInput.addEventListener('input', function() {
        const wrapper = this.closest('.flex');
        const preview = wrapper.querySelector('.color-preview');
        if (preview && /^#[0-9A-Fa-f]{6}$/.test(this.value)) {
          preview.style.backgroundColor = this.value;
        }
      });
    });
  </script>
  @include('admin.partials.admin-collapsible', ['pageKey' => 'theme_settings'])
</body>
</html>
