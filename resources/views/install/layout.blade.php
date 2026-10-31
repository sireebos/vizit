<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Installation Wizard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .step-item.active { color: #2563eb; border-color: #2563eb; }
        .step-item.completed { color: #16a34a; border-color: #16a34a; }
        .step-item.completed .step-icon { background: #16a34a; color: white; }
        .step-item.active .step-icon { background: #2563eb; color: white; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-hotel text-blue-600 mr-2"></i>
                Hotel Management System
            </h1>
            <p class="text-gray-600">Installation Wizard</p>
        </div>

        <!-- Steps Progress -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="flex justify-between items-center">
                @php
                    $steps = [
                        ['name' => 'Requirements', 'icon' => 'fa-check-circle', 'route' => 'install.welcome'],
                        ['name' => 'Database', 'icon' => 'fa-database', 'route' => 'install.database'],
                        ['name' => 'Migration', 'icon' => 'fa-cogs', 'route' => 'install.migration'],
                        ['name' => 'Admin', 'icon' => 'fa-user-shield', 'route' => 'install.admin'],
                        ['name' => 'Site', 'icon' => 'fa-globe', 'route' => 'install.site'],
                        ['name' => 'Finish', 'icon' => 'fa-flag-checkered', 'route' => 'install.finish'],
                    ];
                    $currentStep = View::getSection('step', 1);
                @endphp
                
                @foreach($steps as $index => $step)
                    <div class="step-item flex flex-col items-center {{ $index + 1 < $currentStep ? 'completed' : ($index + 1 == $currentStep ? 'active' : 'text-gray-400') }}">
                        <div class="step-icon w-10 h-10 rounded-full border-2 flex items-center justify-center mb-2 {{ $index + 1 < $currentStep ? 'bg-green-500 border-green-500' : ($index + 1 == $currentStep ? 'bg-blue-600 border-blue-600' : 'border-gray-300') }}">
                            @if($index + 1 < $currentStep)
                                <i class="fas fa-check text-white"></i>
                            @else
                                <i class="fas {{ $step['icon'] }} {{ $index + 1 == $currentStep ? 'text-white' : '' }}"></i>
                            @endif
                        </div>
                        <span class="text-xs font-medium hidden sm:block">{{ $step['name'] }}</span>
                    </div>
                    @if($index < count($steps) - 1)
                        <div class="flex-1 h-1 mx-2 {{ $index + 1 < $currentStep ? 'bg-green-500' : 'bg-gray-300' }} rounded"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Content Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas @yield('icon', 'fa-cog') mr-2"></i>
                        @yield('heading')
                    </h2>
                </div>
                
                <div class="p-6">
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <span class="font-medium">Error:</span>
                            </div>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500 text-sm">
            &copy; {{ date('Y') }} Hotel Management System. All rights reserved.
        </div>
    </div>
</body>
</html>

