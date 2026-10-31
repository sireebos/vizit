@extends('install.layout')

@section('title', 'Create Admin Account')
@section('step', 4)
@section('icon', 'fa-user-shield')
@section('heading', 'Step 4: Create Admin Account')

@section('content')
<form method="POST" action="{{ route('install.admin.store') }}" class="space-y-6">
    @csrf

    <p class="text-gray-600">
        Create your administrator account. This account will have full access to the admin panel.
    </p>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-shield-alt text-blue-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-blue-800">Admin Privileges</h4>
                <p class="text-sm text-blue-600 mt-1">
                    This account will be able to manage rooms, bookings, site settings, and all other aspects of the system.
                </p>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user mr-1 text-gray-400"></i> First Name
                </label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" required
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="John">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user mr-1 text-gray-400"></i> Last Name
                </label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" required
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Doe">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-envelope mr-1 text-gray-400"></i> Email Address
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="admin@yourhotel.com">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-lock mr-1 text-gray-400"></i> Password
            </label>
            <input type="password" name="password" required minlength="8"
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Minimum 8 characters">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-lock mr-1 text-gray-400"></i> Confirm Password
            </label>
            <input type="password" name="password_confirmation" required
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Re-enter password">
        </div>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('install.migration') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center transition">
            Create Admin
            <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </div>
</form>
@endsection

