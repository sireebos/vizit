<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Styles -->

    <style>
        [x-cloak] { display: none !important; }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .card-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .metric-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .metric-card.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .metric-card.green {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .metric-card.orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .metric-card.purple {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-right: 4px solid #fff;
        }
        
        /* Admin Scroll buttons */
        .admin-scroll-buttons {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .admin-scroll-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #1f2937;
            color: #ffffff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            opacity: 0.7;
        }
        
        .admin-scroll-btn:hover {
            opacity: 1;
            transform: scale(1.1);
            background-color: #374151;
        }
        
        /* Admin section content padding */
        .section-content {
            padding: 1.5rem !important; /* p-6 equivalent, 24px */
        }
        
        @media (min-width: 768px) {
            .section-content {
                padding: 2rem !important; /* p-8 equivalent, 32px */
            }
        }
        
        /* Collapsible section wrapper spacing */
        .collapsible-wrapper {
            margin-bottom: 1.5rem;
        }
        
        /* Form elements inside sections */
        .section-content .grid {
            gap: 1.5rem;
        }
        
        .section-content input[type="text"],
        .section-content input[type="email"],
        .section-content input[type="number"],
        .section-content textarea,
        .section-content select {
            padding: 0.75rem 1rem;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div id="app" x-data="{ sidebarOpen: false }" class="min-h-screen">


        <!-- Main Content -->

        <div>
            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @auth
    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden" x-cloak></div>
    @endauth

    <!-- Scroll to Top/Bottom Buttons -->
    <div class="admin-scroll-buttons">
        <button class="admin-scroll-btn" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" title="Scroll to Top">
            <i class="fas fa-arrow-up"></i>
        </button>
        <button class="admin-scroll-btn" onclick="window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' })" title="Scroll to Bottom">
            <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    @stack('scripts')
</body>
</html>
