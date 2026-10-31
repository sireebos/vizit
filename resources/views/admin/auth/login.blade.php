@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Admin Login</h1>
        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-50 text-red-700 text-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border rounded px-3 py-2" />
            </div>
            <div>
                <label class="block text-sm text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full border rounded px-3 py-2" />
            </div>
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center text-sm"><input type="checkbox" name="remember" class="mr-2"> Remember me</label>
                <a href="#" class="text-sm text-blue-600">Forgot password?</a>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Sign in</button>
        </form>
    </div>
</div>
@endsection

