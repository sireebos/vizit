{{--
    Admin Collapsible Sections - Auto-conversion Script
    This script automatically converts all .bg-white.rounded-lg.shadow-md sections to collapsible
    Include at the bottom of admin pages: @include('admin.partials.admin-collapsible')
--}}

@php $pageKey = $pageKey ?? 'admin_page'; @endphp

<style>
    .admin-section-content {
        transition: max-height 0.3s ease-out, opacity 0.3s ease-out, padding 0.3s ease-out;
        overflow: hidden;
    }
    
    .admin-section-content.collapsed {
        max-height: 0 !important;
        opacity: 0;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }
    
    .section-toggle-btn {
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .section-toggle-btn:hover {
        background-color: #f3f4f6;
    }
    
    .toggle-chevron {
        transition: transform 0.3s ease;
    }
    
    .toggle-chevron.rotated {
        transform: rotate(180deg);
    }
    
    /* Collapsible wrapper styles */
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
    
    .toggle-icon {
        transition: transform 0.3s ease;
    }
    
    .toggle-icon.rotate-180 {
        transform: rotate(180deg);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pageKey = '{{ $pageKey }}';
    
    // Convert existing section headers to collapsible
    document.querySelectorAll('.bg-white.rounded-lg.shadow-md').forEach((section, index) => {
        // Skip if already has collapsible-wrapper class
        if (section.classList.contains('collapsible-wrapper')) return;
        
        // Find the header element (h2 with border-b or first h2)
        let headerContainer = section.querySelector('.flex.justify-between.items-center.border-b, .flex.items-center.justify-between.mb-4');
        if (!headerContainer) {
            const h2 = section.querySelector('h2');
            if (h2 && h2.parentElement) {
                headerContainer = h2.parentElement.classList.contains('flex') ? h2.parentElement : null;
            }
        }
        
        if (!headerContainer) return;
        
        const sectionId = 'auto-section-' + index;
        
        // Create wrapper for content (everything after header)
        const contentWrapper = document.createElement('div');
        contentWrapper.id = sectionId;
        contentWrapper.className = 'admin-section-content';
        
        // Move all siblings after headerContainer into contentWrapper
        let sibling = headerContainer.nextElementSibling;
        const siblings = [];
        while (sibling) {
            siblings.push(sibling);
            sibling = sibling.nextElementSibling;
        }
        siblings.forEach(s => contentWrapper.appendChild(s));
        headerContainer.after(contentWrapper);
        
        // Style the header as a toggle button
        headerContainer.classList.add('section-toggle-btn', 'px-6', 'py-4', '-mx-6', '-mt-6', 'mb-4', 'bg-gray-50', 'rounded-t-lg');
        headerContainer.setAttribute('data-target', sectionId);
        
        // Add chevron icon if not present
        if (!headerContainer.querySelector('.toggle-chevron')) {
            const chevron = document.createElement('i');
            chevron.className = 'fas fa-chevron-down toggle-chevron ml-2';
            
            // Find where to add the chevron
            const rightSide = headerContainer.querySelector('label, .flex.items-center') || headerContainer;
            if (rightSide !== headerContainer) {
                rightSide.after(chevron);
            } else {
                headerContainer.appendChild(chevron);
            }
        }
        
        // Add click handler
        headerContainer.addEventListener('click', function(e) {
            // Don't toggle if clicking on checkbox
            if (e.target.type === 'checkbox' || e.target.tagName === 'LABEL') return;
            
            const content = document.getElementById(sectionId);
            const chevron = this.querySelector('.toggle-chevron');
            
            if (content.classList.contains('collapsed')) {
                content.classList.remove('collapsed');
                content.style.maxHeight = content.scrollHeight + 'px';
                if (chevron) chevron.classList.remove('rotated');
                localStorage.setItem(pageKey + '_' + sectionId, 'open');
            } else {
                content.classList.add('collapsed');
                content.style.maxHeight = '0px';
                if (chevron) chevron.classList.add('rotated');
                localStorage.setItem(pageKey + '_' + sectionId, 'closed');
            }
        });
        
        // Set initial height
        contentWrapper.style.maxHeight = contentWrapper.scrollHeight + 'px';
        
        // Restore state from localStorage
        const state = localStorage.getItem(pageKey + '_' + sectionId);
        if (state === 'closed') {
            contentWrapper.classList.add('collapsed');
            contentWrapper.style.maxHeight = '0px';
            const chevron = headerContainer.querySelector('.toggle-chevron');
            if (chevron) chevron.classList.add('rotated');
        }
    });
    
    // Also handle .section-toggle buttons (new style sections)
    document.querySelectorAll('.section-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            if (e.target.type === 'checkbox') return;
            
            const targetId = this.getAttribute('data-target');
            const content = document.getElementById(targetId);
            const icon = this.querySelector('.toggle-icon');
            
            if (!content) return;
            
            if (content.classList.contains('collapsed')) {
                content.classList.remove('collapsed');
                content.style.maxHeight = content.scrollHeight + 'px';
                if (icon) icon.classList.remove('rotate-180');
                localStorage.setItem(pageKey + '_' + targetId, 'open');
            } else {
                content.classList.add('collapsed');
                content.style.maxHeight = '0px';
                if (icon) icon.classList.add('rotate-180');
                localStorage.setItem(pageKey + '_' + targetId, 'closed');
            }
        });
    });
    
    // Initialize new-style collapsible sections
    document.querySelectorAll('.section-content').forEach(section => {
        if (!section.style.maxHeight) {
            section.style.maxHeight = section.scrollHeight + 'px';
        }
        
        const state = localStorage.getItem(pageKey + '_' + section.id);
        const toggle = document.querySelector(`[data-target="${section.id}"]`);
        
        if (state === 'closed') {
            section.classList.add('collapsed');
            section.style.maxHeight = '0px';
            if (toggle) {
                const icon = toggle.querySelector('.toggle-icon');
                if (icon) icon.classList.add('rotate-180');
            }
        } else if (state === 'open') {
            section.classList.remove('collapsed');
            section.style.maxHeight = section.scrollHeight + 'px';
        }
    });
});

// Expand All / Collapse All functions
function expandAllSections() {
    document.querySelectorAll('.admin-section-content, .section-content').forEach(section => {
        section.classList.remove('collapsed');
        section.style.maxHeight = section.scrollHeight + 'px';
    });
    document.querySelectorAll('.toggle-chevron').forEach(c => c.classList.remove('rotated'));
    document.querySelectorAll('.toggle-icon').forEach(i => i.classList.remove('rotate-180'));
}

function collapseAllSections() {
    document.querySelectorAll('.admin-section-content, .section-content').forEach(section => {
        section.classList.add('collapsed');
        section.style.maxHeight = '0px';
    });
    document.querySelectorAll('.toggle-chevron').forEach(c => c.classList.add('rotated'));
    document.querySelectorAll('.toggle-icon').forEach(i => i.classList.add('rotate-180'));
}
</script>
