@extends('install.layout')

@section('title', 'Requirements Check')
@section('step', 1)
@section('icon', 'fa-check-circle')
@section('heading', 'Step 1: Requirements Check')

@section('content')
<div class="space-y-4">
    <p class="text-gray-600 mb-4">
        Before we begin, let's make sure your server meets all the requirements to run this application.
    </p>

    <div class="bg-gray-50 rounded-lg p-4">
        <h3 class="font-semibold text-gray-800 mb-3">
            <i class="fas fa-server mr-2 text-blue-600"></i>Server Requirements
        </h3>
        
        <div class="space-y-2">
            @foreach($requirements as $requirement)
                <div class="flex items-center justify-between py-2 border-b border-gray-200 last:border-0">
                    <div class="flex items-center">
                        @if($requirement['status'])
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        @else
                            <i class="fas fa-times-circle text-red-500 mr-3"></i>
                        @endif
                        <span class="text-gray-700">{{ $requirement['name'] }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-sm {{ $requirement['status'] ? 'text-green-600' : 'text-red-600' }}">
                            {{ $requirement['current'] }}
                        </span>
                        <span class="text-xs text-gray-400 ml-2">(Required: {{ $requirement['required'] }})</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($allPassed)
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
                <span class="font-medium text-green-800">All requirements passed!</span>
                <p class="text-sm text-green-600">Your server is ready to run this application.</p>
            </div>
        </div>
    @else
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
            <div>
                <span class="font-medium text-red-800">Some requirements are not met!</span>
                <p class="text-sm text-red-600">Please fix the issues above before continuing.</p>
            </div>
        </div>
    @endif

    <div class="flex justify-end pt-4">
        @if($allPassed)
            <a href="{{ route('install.database') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center transition">
                Next: Database Setup
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        @else
            <button disabled class="bg-gray-400 text-white px-6 py-2 rounded-lg cursor-not-allowed flex items-center">
                Next: Database Setup
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        @endif
    </div>
</div>
@endsection

