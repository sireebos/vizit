@extends('install.layout')

@section('title', 'Installation Complete')
@section('step', 6)
@section('icon', 'fa-flag-checkered')
@section('heading', 'Step 6: Finish Installation')

@section('content')
<div class="space-y-6">
    <div class="text-center py-6">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-4xl text-green-500"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Almost Done!</h3>
        <p class="text-gray-600">Your hotel management system is ready to be activated.</p>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-800 mb-3">
            <i class="fas fa-clipboard-check mr-2 text-green-600"></i>Installation Summary
        </h4>
        
        <ul class="space-y-2">
            <li class="flex items-center text-gray-600">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Server requirements verified
            </li>
            <li class="flex items-center text-gray-600">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Database configured and connected
            </li>
            <li class="flex items-center text-gray-600">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Database tables created
            </li>
            <li class="flex items-center text-gray-600">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Storage link created
            </li>
            <li class="flex items-center text-gray-600">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Admin account created
            </li>
            <li class="flex items-center text-gray-600">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Site configuration saved
            </li>
        </ul>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-blue-800">What happens next?</h4>
                <ul class="text-sm text-blue-600 mt-2 space-y-1">
                    <li>• Application key will be generated</li>
                    <li>• All caches will be cleared</li>
                    <li>• Installation will be marked as complete</li>
                    <li>• You'll be redirected to the homepage</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-yellow-800">Important Security Note</h4>
                <p class="text-sm text-yellow-600 mt-1">
                    After installation, consider removing or protecting the <code class="bg-yellow-100 px-1 rounded">/install</code> routes for security.
                </p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('install.complete') }}" id="complete-form">
        @csrf
        
        <div class="flex justify-between pt-4">
            <a href="{{ route('install.site') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <button type="submit" id="complete-btn" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg flex items-center transition text-lg font-semibold">
                <i class="fas fa-rocket mr-2"></i>
                <span id="btn-text">Complete Installation</span>
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('complete-form').addEventListener('submit', function() {
    const btn = document.getElementById('complete-btn');
    const btnText = document.getElementById('btn-text');
    
    btn.disabled = true;
    btn.classList.remove('bg-green-600', 'hover:bg-green-700');
    btn.classList.add('bg-gray-400', 'cursor-not-allowed');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Finalizing...';
});
</script>
@endsection

