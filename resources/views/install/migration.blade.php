@extends('install.layout')

@section('title', 'Database Migration')
@section('step', 3)
@section('icon', 'fa-cogs')
@section('heading', 'Step 3: Database Migration')

@section('content')
<div class="space-y-6">
    <p class="text-gray-600">
        Now we'll create all the necessary database tables and set up the storage link for file uploads.
    </p>

    <div class="bg-gray-50 rounded-lg p-4">
        <h3 class="font-semibold text-gray-800 mb-3">
            <i class="fas fa-tasks mr-2 text-blue-600"></i>What will happen:
        </h3>
        
        <ul class="space-y-3">
            <li class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                <div>
                    <span class="font-medium text-gray-700">Create Database Tables</span>
                    <p class="text-sm text-gray-500">All necessary tables for users, rooms, bookings, settings, etc.</p>
                </div>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                <div>
                    <span class="font-medium text-gray-700">Create Storage Link</span>
                    <p class="text-sm text-gray-500">Link public/storage to storage/app/public for file uploads.</p>
                </div>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                <div>
                    <span class="font-medium text-gray-700">Initialize Default Data</span>
                    <p class="text-sm text-gray-500">Set up initial site configuration and settings.</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-yellow-800">Important</h4>
                <p class="text-sm text-yellow-600 mt-1">
                    This process may take a few moments. Please do not close or refresh this page.
                </p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('install.migration.run') }}" id="migration-form">
        @csrf
        
        <div class="flex justify-between pt-4">
            <a href="{{ route('install.database') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <button type="submit" id="migrate-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center transition">
                <span id="btn-text">Run Migrations</span>
                <i class="fas fa-arrow-right ml-2" id="btn-icon"></i>
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('migration-form').addEventListener('submit', function() {
    const btn = document.getElementById('migrate-btn');
    const btnText = document.getElementById('btn-text');
    const btnIcon = document.getElementById('btn-icon');
    
    btn.disabled = true;
    btn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
    btn.classList.add('bg-gray-400', 'cursor-not-allowed');
    btnText.textContent = 'Running...';
    btnIcon.className = 'fas fa-spinner fa-spin ml-2';
});
</script>
@endsection

