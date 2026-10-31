@extends('install.layout')

@section('title', 'Database Configuration')
@section('step', 2)
@section('icon', 'fa-database')
@section('heading', 'Step 2: Database Configuration')

@section('content')
<form method="POST" action="{{ route('install.database.store') }}" class="space-y-6">
    @csrf

    <p class="text-gray-600">
        Choose your database type and configure the connection settings.
    </p>

    <!-- Database Type Selection -->
    <div class="space-y-4">
        <label class="block text-sm font-medium text-gray-700">Database Type</label>
        
        <div class="grid grid-cols-2 gap-4">
            <label class="relative cursor-pointer">
                <input type="radio" name="db_type" value="sqlite" class="peer sr-only" checked onchange="toggleDbFields()">
                <div class="border-2 rounded-lg p-4 text-center peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:bg-gray-50 transition">
                    <i class="fas fa-file-alt text-3xl mb-2 text-blue-600"></i>
                    <h4 class="font-semibold text-gray-800">SQLite</h4>
                    <p class="text-xs text-gray-500 mt-1">Simple file-based database. Best for small sites.</p>
                </div>
            </label>
            
            <label class="relative cursor-pointer">
                <input type="radio" name="db_type" value="mysql" class="peer sr-only" onchange="toggleDbFields()">
                <div class="border-2 rounded-lg p-4 text-center peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:bg-gray-50 transition">
                    <i class="fas fa-database text-3xl mb-2 text-green-600"></i>
                    <h4 class="font-semibold text-gray-800">MySQL</h4>
                    <p class="text-xs text-gray-500 mt-1">Powerful database. Best for production.</p>
                </div>
            </label>
        </div>
    </div>

    <!-- MySQL Configuration -->
    <div id="mysql-fields" class="space-y-4 hidden">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-sm text-yellow-800">
            <i class="fas fa-info-circle mr-2"></i>
            Make sure you have already created the database in phpMyAdmin before proceeding.
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Host</label>
                <input type="text" name="db_host" value="localhost" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Port</label>
                <input type="text" name="db_port" value="3306" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Database Name</label>
            <input type="text" name="db_database" placeholder="hotel_db" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="db_username" placeholder="root" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="db_password" placeholder="(leave blank if none)" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
    </div>

    <!-- SQLite Info -->
    <div id="sqlite-info" class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-blue-800">SQLite Database</h4>
                <p class="text-sm text-blue-600 mt-1">
                    A SQLite database file will be created automatically at:<br>
                    <code class="bg-blue-100 px-2 py-1 rounded text-xs">database/database.sqlite</code>
                </p>
            </div>
        </div>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('install.welcome') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center transition">
            Test & Continue
            <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </div>
</form>

<script>
function toggleDbFields() {
    const dbType = document.querySelector('input[name="db_type"]:checked').value;
    document.getElementById('mysql-fields').classList.toggle('hidden', dbType !== 'mysql');
    document.getElementById('sqlite-info').classList.toggle('hidden', dbType !== 'sqlite');
}
</script>
@endsection

