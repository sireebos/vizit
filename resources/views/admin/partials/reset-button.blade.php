{{-- Reset to Default Button --}}
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">
                <i class="fas fa-undo mr-2 text-red-500"></i>Reset to Defaults
            </h2>
            <p class="text-sm text-gray-500 mt-1">Reset section order, page styles, and visibility to default settings</p>
        </div>
        <button type="button" onclick="resetToDefaults()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
            <i class="fas fa-undo mr-2"></i>Reset to Defaults
        </button>
    </div>
</div>

{{-- Hidden form for reset (outside main form) --}}
<form id="reset-form" method="POST" action="{{ $resetRoute }}" style="display: none;">
    @csrf
</form>

<script>
function resetToDefaults() {
    if (confirm('Are you sure you want to reset this page to defaults? This will reset section order, page styles, and visibility settings.')) {
        document.getElementById('reset-form').submit();
    }
}
</script>
