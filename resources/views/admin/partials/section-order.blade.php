{{-- Section Ordering (Drag & Drop) --}}
<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden collapsible-wrapper">
    <button type="button" class="section-toggle w-full px-6 py-4 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition" data-target="sortable-sections-wrapper">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-sort mr-2 text-blue-500"></i>Section Order
        </h2>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-500">Drag and drop to reorder</span>
            <i class="fas fa-chevron-down toggle-icon transition-transform duration-300"></i>
        </div>
    </button>
    
    <div id="sortable-sections-wrapper" class="section-content p-6">
        <div id="sortable-sections" class="space-y-2">
        @php
            $orderedSections = $pageSettings->getOrderedSections();
            $sectionLabels = $pageSettings::sectionLabels();
            $sectionsData = $pageSettings->sections ?? [];
            $defaultSections = $pageSettings::defaultSections();
        @endphp
        
        @foreach($orderedSections as $index => $sectionKey)
            <div class="sortable-item flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200 cursor-move hover:bg-gray-100 transition-colors" 
                 data-section="{{ $sectionKey }}">
                <input type="hidden" name="section_order[]" value="{{ $sectionKey }}">
                <div class="flex-shrink-0 mr-3 text-gray-400">
                    <i class="fas fa-grip-vertical text-lg"></i>
                </div>
                <div class="flex-grow">
                    <span class="font-medium text-gray-700">{{ $sectionLabels[$sectionKey] ?? ucwords(str_replace('_', ' ', $sectionKey)) }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="order-number text-xs text-gray-400 mr-2">#{{ $index + 1 }}</span>
                    @php 
                        // Check visibility: use actual data if exists, otherwise use default (true)
                        $isVisible = isset($sectionsData[$sectionKey]['visible']) 
                            ? (bool)$sectionsData[$sectionKey]['visible'] 
                            : ($defaultSections[$sectionKey]['visible'] ?? true);
                    @endphp
                    <span class="px-2 py-1 text-xs rounded {{ $isVisible ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $isVisible ? 'Visible' : 'Hidden' }}
                    </span>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

<!-- SortableJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableList = document.getElementById('sortable-sections');
    if (sortableList && typeof Sortable !== 'undefined') {
        Sortable.create(sortableList, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                // Update order numbers after drag
                const items = sortableList.querySelectorAll('.sortable-item');
                items.forEach((item, index) => {
                    const orderSpan = item.querySelector('.order-number');
                    if (orderSpan) {
                        orderSpan.textContent = '#' + (index + 1);
                    }
                });
            }
        });
    }
});
</script>

<style>
.sortable-item {
    user-select: none;
}
.sortable-ghost {
    opacity: 0.4;
    background: #dbeafe !important;
}
.sortable-chosen {
    background: #eff6ff !important;
}
.sortable-drag {
    background: white !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}
}
</style>
