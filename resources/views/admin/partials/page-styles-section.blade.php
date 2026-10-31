{{-- Page Styles Section --}}
<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
    <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="page-styles-content">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-palette mr-2 text-purple-500"></i>Page Styles
        </h2>
        <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
    </button>
    
    <div id="page-styles-content" class="section-content p-6 space-y-4">
        <p class="text-sm text-gray-500 mb-4">Override the global theme colors for this page only. Leave empty to use global theme settings.</p>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
                <div class="flex items-center space-x-2">
                    <input type="color" name="page_styles[background_color]" 
                           value="{{ $pageSettings->pageStyle('background_color', '#ffffff') }}" 
                           class="h-10 w-14 border rounded cursor-pointer">
                    <input type="text" name="page_styles[background_color]" 
                           value="{{ $pageSettings->pageStyle('background_color', '') }}" 
                           class="flex-1 border rounded px-2 py-1 text-sm" placeholder="#ffffff">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Text Color</label>
                <div class="flex items-center space-x-2">
                    <input type="color" name="page_styles[text_color]" 
                           value="{{ $pageSettings->pageStyle('text_color', '#666666') }}" 
                           class="h-10 w-14 border rounded cursor-pointer">
                    <input type="text" name="page_styles[text_color]" 
                           value="{{ $pageSettings->pageStyle('text_color', '') }}" 
                           class="flex-1 border rounded px-2 py-1 text-sm" placeholder="#666666">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Heading Color</label>
                <div class="flex items-center space-x-2">
                    <input type="color" name="page_styles[heading_color]" 
                           value="{{ $pageSettings->pageStyle('heading_color', '#1b1b1b') }}" 
                           class="h-10 w-14 border rounded cursor-pointer">
                    <input type="text" name="page_styles[heading_color]" 
                           value="{{ $pageSettings->pageStyle('heading_color', '') }}" 
                           class="flex-1 border rounded px-2 py-1 text-sm" placeholder="#1b1b1b">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Accent Color</label>
                <div class="flex items-center space-x-2">
                    <input type="color" name="page_styles[accent_color]" 
                           value="{{ $pageSettings->pageStyle('accent_color', '#aa8453') }}" 
                           class="h-10 w-14 border rounded cursor-pointer">
                    <input type="text" name="page_styles[accent_color]" 
                           value="{{ $pageSettings->pageStyle('accent_color', '') }}" 
                           class="flex-1 border rounded px-2 py-1 text-sm" placeholder="#aa8453">
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Background Image URL</label>
            <input type="text" name="page_styles[background_image]" 
                   value="{{ $pageSettings->pageStyle('background_image', '') }}" 
                   class="w-full border rounded px-3 py-2" placeholder="https://... or /uploads/...">
        </div>
        
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Page Custom CSS</label>
            <textarea name="page_styles[custom_css]" rows="3" 
                      class="w-full border rounded px-3 py-2 font-mono text-sm" 
                      placeholder=".section { padding: 50px 0; }">{{ $pageSettings->pageStyle('custom_css', '') }}</textarea>
        </div>
    </div>
</div>

<script>
// Sync color picker with text input for page styles
document.querySelectorAll('#page-styles-content input[type="color"]').forEach(colorInput => {
    const textInput = colorInput.parentElement.querySelector('input[type="text"]');
    if (textInput) {
        colorInput.addEventListener('input', function() {
            textInput.value = this.value;
        });
        textInput.addEventListener('input', function() {
            if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                colorInput.value = this.value;
            }
        });
    }
});
</script>
