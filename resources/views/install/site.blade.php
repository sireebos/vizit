@extends('install.layout')

@section('title', 'Site Configuration')
@section('step', 5)
@section('icon', 'fa-globe')
@section('heading', 'Step 5: Site Configuration')

@section('content')
<form method="POST" action="{{ route('install.site.store') }}" class="space-y-6">
    @csrf

    <p class="text-gray-600">
        Configure your website's basic information and URL settings.
    </p>

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-hotel mr-1 text-gray-400"></i> Site Name
            </label>
            <input type="text" name="site_name" value="{{ old('site_name', 'My Hotel') }}" required
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Vizit Hotel & Suites">
            <p class="text-xs text-gray-500 mt-1">This will be displayed in the browser title and header.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-link mr-1 text-gray-400"></i> Site URL
            </label>
            <input type="url" name="app_url" value="{{ old('app_url', url('/')) }}" required
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="https://yourhotel.com">
            <p class="text-xs text-gray-500 mt-1">The full URL where your site is hosted (without trailing slash).</p>
        </div>
    </div>

    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-lightbulb text-green-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-green-800">Tip</h4>
                <p class="text-sm text-green-600 mt-1">
                    You can change these settings later from the admin panel under "Site Settings".
                </p>
            </div>
        </div>
    </div>

    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-yellow-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-yellow-800">Production Mode</h4>
                <p class="text-sm text-yellow-600 mt-1">
                    The application will be set to production mode with debugging disabled. This is recommended for live sites.
                </p>
            </div>
        </div>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('install.admin') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center transition">
            Save & Continue
            <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </div>
</form>
@endsection

