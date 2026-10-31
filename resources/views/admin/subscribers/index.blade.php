<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Subscribers - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @include('admin.partials.sidebar')

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Newsletter Subscribers</h1>
                    <p class="text-gray-600 mt-1">Manage your newsletter subscriber list</p>
                </div>
                <a href="{{ route('admin.subscribers.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-download mr-2"></i>Export CSV
                </a>
            </div>
        </div>

        <!-- Status Messages -->
        @if(session('status'))
            <div class="mb-6 bg-green-50 text-green-800 border border-green-200 px-4 py-3 rounded">{{ session('status') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-50 text-red-800 border border-red-200 px-4 py-3 rounded">{{ session('error') }}</div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Total Subscribers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Active</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['active'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-times-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Unsubscribed</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['unsubscribed'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" action="{{ route('admin.subscribers.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by email..." class="w-full border rounded px-3 py-2">
                </div>
                <div class="w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="unsubscribed" {{ request('status') == 'unsubscribed' ? 'selected' : '' }}>Unsubscribed</option>
                    </select>
                </div>
                <div class="w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Source</label>
                    <select name="source" class="w-full border rounded px-3 py-2">
                        <option value="">All Sources</option>
                        @foreach($sources as $source)
                            <option value="{{ $source }}" {{ request('source') == $source ? 'selected' : '' }}>{{ ucfirst($source) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    <i class="fas fa-search mr-1"></i> Filter
                </button>
                <a href="{{ route('admin.subscribers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                    Clear
                </a>
            </form>
        </div>

        <!-- Subscribers Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <form id="bulk-form" method="POST" action="{{ route('admin.subscribers.bulk-delete') }}">
                @csrf
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all" class="rounded">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subscribed At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($subscribers as $subscriber)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" name="ids[]" value="{{ $subscriber->id }}" class="subscriber-checkbox rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $subscriber->email }}</div>
                                <div class="text-xs text-gray-500">{{ $subscriber->ip_address }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-800">{{ ucfirst($subscriber->source) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($subscriber->status === 'active')
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">Unsubscribed</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $subscriber->subscribed_at?->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" class="inline" onsubmit="return confirm('Delete this subscriber?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3"></i>
                                <p>No subscribers found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </form>

            <!-- Bulk Actions & Pagination -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button type="button" onclick="bulkDelete()" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                        <i class="fas fa-trash mr-1"></i> Delete Selected
                    </button>
                </div>
                <div>
                    {{ $subscribers->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Select all checkbox
        document.getElementById('select-all').addEventListener('change', function() {
            document.querySelectorAll('.subscriber-checkbox').forEach(cb => cb.checked = this.checked);
        });

        // Bulk delete
        function bulkDelete() {
            const checked = document.querySelectorAll('.subscriber-checkbox:checked');
            if (checked.length === 0) {
                alert('Please select at least one subscriber to delete.');
                return;
            }
            if (confirm(`Delete ${checked.length} selected subscriber(s)?`)) {
                document.getElementById('bulk-form').submit();
            }
        }
    </script>
</body>
</html>

