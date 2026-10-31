{{--
    Collapsible Sections CSS & JavaScript
    Include this partial at the bottom of admin pages that use collapsible-section
    
    Usage: @include('admin.partials.collapsible-scripts', ['pageKey' => 'home_page'])
--}}

@php $pageKey = $pageKey ?? 'admin_sections'; @endphp

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
    
    // Initialize section heights
    document.querySelectorAll('.section-content').forEach(section => {
        if (!section.classList.contains('collapsed')) {
            section.style.maxHeight = section.scrollHeight + 'px';
        }
    });
    
    // Toggle section collapse/expand
    document.querySelectorAll('.section-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            // Don't toggle if clicking on checkbox
            if (e.target.type === 'checkbox') return;
            
            const targetId = this.getAttribute('data-target');
            const content = document.getElementById(targetId);
            const icon = this.querySelector('.toggle-icon');
            
            if (!content) return;
            
            if (content.classList.contains('collapsed')) {
                content.classList.remove('collapsed');
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.classList.remove('rotate-180');
                localStorage.setItem(pageKey + '_' + targetId, 'open');
            } else {
                content.classList.add('collapsed');
                content.style.maxHeight = '0px';
                icon.classList.add('rotate-180');
                localStorage.setItem(pageKey + '_' + targetId, 'closed');
            }
        });
    });
    
    // Restore section states from localStorage
    document.querySelectorAll('.section-content').forEach(section => {
        const state = localStorage.getItem(pageKey + '_' + section.id);
        const toggle = document.querySelector(`[data-target="${section.id}"]`);
        
        if (state === 'closed') {
            section.classList.add('collapsed');
            section.style.maxHeight = '0px';
            if (toggle) {
                toggle.querySelector('.toggle-icon')?.classList.add('rotate-180');
            }
        } else if (state === 'open') {
            section.classList.remove('collapsed');
            section.style.maxHeight = section.scrollHeight + 'px';
            if (toggle) {
                toggle.querySelector('.toggle-icon')?.classList.remove('rotate-180');
            }
        }
    });
    
    // Recalculate heights when content changes (e.g., image uploads)
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            const section = mutation.target.closest('.section-content');
            if (section && !section.classList.contains('collapsed')) {
                section.style.maxHeight = section.scrollHeight + 'px';
            }
        });
    });
    
    document.querySelectorAll('.section-content').forEach(section => {
        observer.observe(section, { childList: true, subtree: true, attributes: true });
    });
});

// Expand All / Collapse All functions (optional)
function expandAllSections() {
    document.querySelectorAll('.section-content').forEach(section => {
        section.classList.remove('collapsed');
        section.style.maxHeight = section.scrollHeight + 'px';
        const toggle = document.querySelector(`[data-target="${section.id}"]`);
        if (toggle) {
            toggle.querySelector('.toggle-icon')?.classList.remove('rotate-180');
        }
    });
}

function collapseAllSections() {
    document.querySelectorAll('.section-content').forEach(section => {
        section.classList.add('collapsed');
        section.style.maxHeight = '0px';
        const toggle = document.querySelector(`[data-target="${section.id}"]`);
        if (toggle) {
            toggle.querySelector('.toggle-icon')?.classList.add('rotate-180');
        }
    });
}
</script>
