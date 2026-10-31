<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of subscribers
     */
    public function index(Request $request)
    {
        $query = Subscriber::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Source filter
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        $subscribers = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get stats
        $stats = [
            'total' => Subscriber::count(),
            'active' => Subscriber::active()->count(),
            'unsubscribed' => Subscriber::unsubscribed()->count(),
        ];

        // Get unique sources for filter dropdown
        $sources = Subscriber::distinct()->pluck('source')->filter();

        return view('admin.subscribers.index', compact('subscribers', 'stats', 'sources'));
    }

    /**
     * Delete a subscriber
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')
            ->with('status', 'Subscriber deleted successfully.');
    }

    /**
     * Bulk delete subscribers
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return redirect()->route('admin.subscribers.index')
                ->with('error', 'No subscribers selected.');
        }

        Subscriber::whereIn('id', $ids)->delete();

        return redirect()->route('admin.subscribers.index')
            ->with('status', count($ids) . ' subscriber(s) deleted successfully.');
    }

    /**
     * Export subscribers as CSV
     */
    public function export(Request $request)
    {
        $query = Subscriber::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $subscribers = $query->orderBy('created_at', 'desc')->get();

        $filename = 'subscribers_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['Email', 'Source', 'Status', 'Subscribed At', 'IP Address']);
            
            // Data rows
            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->email,
                    $subscriber->source,
                    $subscriber->status,
                    $subscriber->subscribed_at?->format('Y-m-d H:i:s'),
                    $subscriber->ip_address,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

