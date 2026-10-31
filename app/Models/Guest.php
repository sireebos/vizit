<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Guest extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'nationality',
        'id_type',
        'id_number',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'emergency_contact_name',
        'emergency_contact_phone',
        'special_requests',
        'preferences',
        'is_vip',
        'is_blacklisted',
        'notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'preferences' => 'array',
        'is_vip' => 'boolean',
        'is_blacklisted' => 'boolean',
    ];

    /**
     * Get bookings for this guest
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get restaurant orders for this guest
     */
    public function restaurantOrders(): HasMany
    {
        return $this->hasMany(RestaurantOrder::class);
    }

    /**
     * Get bar orders for this guest
     */
    public function barOrders(): HasMany
    {
        return $this->hasMany(BarOrder::class);
    }

    /**
     * Get payments made by this guest
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get invoices for this guest
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get full name attribute
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get full address attribute
     */
    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country
        ]);

        return implode(', ', $parts);
    }

    /**
     * Scope for VIP guests
     */
    public function scopeVip(Builder $query): Builder
    {
        return $query->where('is_vip', true);
    }

    /**
     * Scope for blacklisted guests
     */
    public function scopeBlacklisted(Builder $query): Builder
    {
        return $query->where('is_blacklisted', true);
    }

    /**
     * Scope for active guests (not blacklisted)
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_blacklisted', false);
    }

    /**
     * Search guests by name, email, or phone
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    /**
     * Get current booking
     */
    public function getCurrentBooking()
    {
        return $this->bookings()
            ->where('status', 'checked_in')
            ->where('check_in_date', '<=', now())
            ->where('check_out_date', '>=', now())
            ->first();
    }

    /**
     * Get total spent by guest
     */
    public function getTotalSpent()
    {
        return $this->payments()
            ->where('status', 'completed')
            ->sum('amount');
    }

    /**
     * Get guest loyalty level based on bookings
     */
    public function getLoyaltyLevel()
    {
        $bookingCount = $this->bookings()->where('status', 'checked_out')->count();

        return match (true) {
            $bookingCount >= 20 => 'Platinum',
            $bookingCount >= 10 => 'Gold',
            $bookingCount >= 5 => 'Silver',
            default => 'Bronze'
        };
    }

    /**
     * Check if guest has any active bookings
     */
    public function hasActiveBookings(): bool
    {
        return $this->bookings()
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->exists();
    }
}
