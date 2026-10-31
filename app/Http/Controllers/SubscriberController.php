<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Store a new subscriber
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'source' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid email address.',
            ], 422);
        }

        // Check if email already exists
        $existing = Subscriber::where('email', $request->email)->first();
        
        if ($existing) {
            if ($existing->status === 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already subscribed.',
                ], 422);
            } else {
                // Resubscribe
                $existing->update([
                    'status' => 'active',
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                    'ip_address' => $request->ip(),
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Welcome back! You have been resubscribed.',
                ]);
            }
        }

        // Create new subscriber
        $subscriber = Subscriber::create([
            'email' => $request->email,
            'source' => $request->source ?? 'footer',
            'status' => 'active',
            'subscribed_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        // Send notification email to admin
        $this->sendNotificationEmail($subscriber);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing!',
        ]);
    }

    /**
     * Send notification email to admin
     */
    protected function sendNotificationEmail(Subscriber $subscriber)
    {
        $settings = SiteSettings::instance();
        $notificationEmail = $settings->notification_email;

        if (!$notificationEmail) {
            return;
        }

        try {
            Mail::raw(
                "New Newsletter Subscriber!\n\n" .
                "Email: {$subscriber->email}\n" .
                "Source: {$subscriber->source}\n" .
                "Subscribed at: {$subscriber->subscribed_at->format('Y-m-d H:i:s')}\n" .
                "IP Address: {$subscriber->ip_address}\n\n" .
                "View all subscribers at: " . url('/admin/subscribers'),
                function ($message) use ($notificationEmail, $settings) {
                    $message->to($notificationEmail)
                        ->subject('New Newsletter Subscriber - ' . ($settings->site_name ?? 'Your Website'));
                }
            );
        } catch (\Exception $e) {
            // Log error but don't fail the subscription
            \Log::error('Failed to send subscriber notification: ' . $e->getMessage());
        }
    }
}

