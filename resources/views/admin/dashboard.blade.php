@extends('layouts.app')

@section('content')
<div x-data="dashboard()" x-init="init()" class="space-y-6">
    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Rooms -->
        <div class="metric-card blue text-white p-6 rounded-xl card-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Rooms</p>
                    <p class="text-3xl font-bold" x-text="metrics.total_rooms">0</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <i class="fas fa-bed text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-green-200 text-sm font-medium" x-text="`${metrics.occupancy_rate}% Occupied`">0% Occupied</span>
            </div>
        </div>

        <!-- Today's Bookings -->
        <div class="metric-card green text-white p-6 rounded-xl card-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Today's Bookings</p>
                    <p class="text-3xl font-bold" x-text="metrics.total_bookings_today">0</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <i class="fas fa-calendar-plus text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-green-200 text-sm font-medium" x-text="`${metrics.checked_in_today} Check-ins`">0 Check-ins</span>
            </div>
        </div>

        <!-- Today's Revenue -->
        <div class="metric-card orange text-white p-6 rounded-xl card-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Today's Revenue</p>
                    <p class="text-3xl font-bold" x-text="formatCurrency(metrics.total_revenue_today)">₦0</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-orange-200 text-sm font-medium" x-text="`${metrics.revenue_growth > 0 ? '+' : ''}${metrics.revenue_growth}% vs last month`">0% vs last month</span>
            </div>
        </div>

        <!-- Active Guests -->
        <div class="metric-card purple text-white p-6 rounded-xl card-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Active Guests</p>
                    <p class="text-3xl font-bold" x-text="metrics.occupied_rooms">0</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-purple-200 text-sm font-medium" x-text="`${metrics.vip_guests} VIP Guests`">0 VIP Guests</span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Room Status Chart -->
        <div class="bg-white p-6 rounded-xl card-shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Room Status Distribution</h3>
            <div class="relative h-64">
                <canvas id="roomStatusChart"></canvas>
            </div>
        </div>

        <!-- Revenue Trend Chart -->
        <div class="bg-white p-6 rounded-xl card-shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Revenue Trend (Last 7 Days)</h3>
            <div class="relative h-64">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Alerts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activities -->
        <div class="bg-white p-6 rounded-xl card-shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h3>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                <template x-for="activity in recentActivities" :key="activity.id">
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i :class="getActivityIcon(activity.type)" class="text-blue-600 text-sm"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900" x-text="activity.title"></p>
                            <p class="text-sm text-gray-500" x-text="activity.description"></p>
                            <p class="text-xs text-gray-400 mt-1" x-text="formatTime(activity.timestamp)"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Alerts -->
        <div class="bg-white p-6 rounded-xl card-shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Alerts & Notifications</h3>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                <template x-for="alert in alerts" :key="alert.id">
                    <div class="flex items-start space-x-3 p-3 rounded-lg" 
                         :class="getAlertClass(alert.type)">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center"
                                 :class="getAlertIconClass(alert.type)">
                                <i :class="getAlertIcon(alert.type)" class="text-sm"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium" x-text="alert.title"></p>
                            <p class="text-sm" x-text="alert.message"></p>
                            <button class="text-xs text-blue-600 hover:text-blue-800 mt-1">View Details</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white p-6 rounded-xl card-shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <button class="flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                <i class="fas fa-plus-circle text-2xl text-blue-600 mb-2"></i>
                <span class="text-sm font-medium text-blue-800">New Booking</span>
            </button>
            <button class="flex flex-col items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                <i class="fas fa-sign-in-alt text-2xl text-green-600 mb-2"></i>
                <span class="text-sm font-medium text-green-800">Check In</span>
            </button>
            <button class="flex flex-col items-center p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors">
                <i class="fas fa-sign-out-alt text-2xl text-orange-600 mb-2"></i>
                <span class="text-sm font-medium text-orange-800">Check Out</span>
            </button>
            <button class="flex flex-col items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                <i class="fas fa-user-plus text-2xl text-purple-600 mb-2"></i>
                <span class="text-sm font-medium text-purple-800">Add Guest</span>
            </button>
            <button class="flex flex-col items-center p-4 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                <i class="fas fa-tools text-2xl text-red-600 mb-2"></i>
                <span class="text-sm font-medium text-red-800">Maintenance</span>
            </button>
            <button class="flex flex-col items-center p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                <i class="fas fa-chart-line text-2xl text-indigo-600 mb-2"></i>
                <span class="text-sm font-medium text-indigo-800">Reports</span>
            </button>
            <a href="{{ route('admin.home-page.edit') }}" class="flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                <i class="fas fa-home text-2xl text-blue-600 mb-2"></i>
                <span class="text-sm font-medium text-blue-800">Home Page Editor</span>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function dashboard() {
    return {
        metrics: {
            total_rooms: 0,
            occupied_rooms: 0,
            available_rooms: 0,
            total_bookings_today: 0,
            total_revenue_today: 0,
            revenue_growth: 0,
            occupancy_rate: 0,
            checked_in_today: 0,
            vip_guests: 0
        },
        roomStatus: {},
        recentActivities: [],
        alerts: [],
        roomStatusChart: null,
        revenueTrendChart: null,

        async init() {
            await this.loadDashboardData();
            this.initCharts();
            // Refresh data every 30 seconds
            setInterval(() => this.loadDashboardData(), 30000);
        },

        async loadDashboardData() {
            try {
                // Load overview metrics
                const overviewResponse = await fetch('/demo/api/dashboard/overview', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (overviewResponse.ok) {
                    const overviewData = await overviewResponse.json();
                    this.metrics = overviewData.data.metrics;
                }

                // Load room status
                const roomStatusResponse = await fetch('/demo/api/dashboard/room-status', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (roomStatusResponse.ok) {
                    const roomStatusData = await roomStatusResponse.json();
                    this.roomStatus = roomStatusData.data.status_distribution;
                    this.updateRoomStatusChart();
                }

                // Load recent activities
                const activitiesResponse = await fetch('/demo/api/dashboard/recent-activities', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (activitiesResponse.ok) {
                    const activitiesData = await activitiesResponse.json();
                    this.recentActivities = activitiesData.data.activities;
                }

                // Load alerts
                const alertsResponse = await fetch('/demo/api/dashboard/alerts', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (alertsResponse.ok) {
                    const alertsData = await alertsResponse.json();
                    this.alerts = alertsData.data.alerts;
                }

                // Load revenue trend
                const revenueResponse = await fetch('/demo/api/dashboard/revenue-analytics?days=7', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (revenueResponse.ok) {
                    const revenueData = await revenueResponse.json();
                    this.updateRevenueTrendChart(revenueData.data.daily_revenue);
                }

            } catch (error) {
                console.error('Error loading dashboard data:', error);
            }
        },

        initCharts() {
            // Room Status Chart
            const roomStatusCtx = document.getElementById('roomStatusChart').getContext('2d');
            this.roomStatusChart = new Chart(roomStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Available', 'Occupied', 'Maintenance', 'Cleaning'],
                    datasets: [{
                        data: [0, 0, 0, 0],
                        backgroundColor: [
                            '#10B981',
                            '#3B82F6',
                            '#F59E0B',
                            '#EF4444'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Revenue Trend Chart
            const revenueTrendCtx = document.getElementById('revenueTrendChart').getContext('2d');
            this.revenueTrendChart = new Chart(revenueTrendCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Revenue',
                        data: [],
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '{{ \App\Models\SiteSettings::first()?->currency_symbol ?? "₦" }}' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        },

        updateRoomStatusChart() {
            if (this.roomStatusChart) {
                this.roomStatusChart.data.datasets[0].data = [
                    this.roomStatus.available || 0,
                    this.roomStatus.occupied || 0,
                    this.roomStatus.maintenance || 0,
                    this.roomStatus.cleaning || 0
                ];
                this.roomStatusChart.update();
            }
        },

        updateRevenueTrendChart(dailyRevenue) {
            if (this.revenueTrendChart && dailyRevenue) {
                this.revenueTrendChart.data.labels = dailyRevenue.map(item =>
                    new Date(item.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
                );
                this.revenueTrendChart.data.datasets[0].data = dailyRevenue.map(item => item.total);
                this.revenueTrendChart.update();
            }
        },

        formatCurrency(amount) {
            return new Intl.NumberFormat('en-NG', {
                style: 'currency',
                currency: 'NGN'
            }).format(amount || 0);
        },

        formatTime(timestamp) {
            return new Date(timestamp).toLocaleString();
        },

        getActivityIcon(type) {
            const icons = {
                booking: 'fas fa-calendar-plus',
                payment: 'fas fa-dollar-sign',
                checkin: 'fas fa-sign-in-alt',
                checkout: 'fas fa-sign-out-alt'
            };
            return icons[type] || 'fas fa-info-circle';
        },

        getAlertClass(type) {
            const classes = {
                warning: 'bg-yellow-50 border border-yellow-200',
                error: 'bg-red-50 border border-red-200',
                info: 'bg-blue-50 border border-blue-200',
                success: 'bg-green-50 border border-green-200'
            };
            return classes[type] || 'bg-gray-50 border border-gray-200';
        },

        getAlertIconClass(type) {
            const classes = {
                warning: 'bg-yellow-100 text-yellow-600',
                error: 'bg-red-100 text-red-600',
                info: 'bg-blue-100 text-blue-600',
                success: 'bg-green-100 text-green-600'
            };
            return classes[type] || 'bg-gray-100 text-gray-600';
        },

        getAlertIcon(type) {
            const icons = {
                warning: 'fas fa-exclamation-triangle',
                error: 'fas fa-times-circle',
                info: 'fas fa-info-circle',
                success: 'fas fa-check-circle'
            };
            return icons[type] || 'fas fa-info-circle';
        }
    }
}
</script>
@endpush
