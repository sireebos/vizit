{{--
    Collapsible Section Partial
    
    Usage:
    @include('admin.partials.collapsible-section', [
        'id' => 'section-id',
        'title' => 'Section Title',
        'icon' => 'fas fa-cog',
        'iconColor' => 'text-blue-600',
        'show' => true,          // optional: visibility checkbox
        'showName' => 'sections[hero][visible]',  // optional: name for checkbox
        'showValue' => true,     // optional: current value
        'collapsed' => false,    // optional: start collapsed
    ])
    
    Section content goes in the slot
--}}

@php
    $sectionId = $id ?? 'section-' . Str::random(8);
    $collapsed = $collapsed ?? false;
    $pageKey = $pageKey ?? 'admin_sections';
@endphp

<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
    <button type="button" 
            class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" 
            data-target="{{ $sectionId }}">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            @if(isset($icon))
                <i class="{{ $icon }} mr-2 {{ $iconColor ?? 'text-gray-600' }}"></i>
            @endif
            {{ $title }}
        </h2>
        <div class="flex items-center gap-4">
            @if(isset($show) && $show && isset($showName))
                <label class="inline-flex items-center text-sm" onclick="event.stopPropagation();">
                    <input type="hidden" name="{{ $showName }}" value="0">
                    <input type="checkbox" name="{{ $showName }}" value="1" {{ ($showValue ?? true) ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-gray-600">Show</span>
                </label>
            @endif
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300 {{ $collapsed ? 'rotate-180' : '' }}"></i>
        </div>
    </button>
    <div id="{{ $sectionId }}" class="section-content p-6 {{ $collapsed ? 'collapsed' : '' }}">
        {{ $slot }}
    </div>
</div>
