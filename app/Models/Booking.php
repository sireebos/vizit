<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'booking_number',
        'guest_id',
        'room_id',
        'created_by',
        'check_in_date',
        'check_out_date',
        'check_in_time',
        'check_out_time',
        'adults',
        'children',
        'nights',
        'booking_type',
        'status',
        'room_rate',
        'total_amount',
        'tax_amount',
        'service_charge',
        'discount_amount',
        'paid_amount',
        'balance_amount',
        'payment_status',
        'special_requests',
        'notes',
        'checked_in_at',
        'checked_out_at',
        'checked_in_by',
        'checked_out_by',
        'cancelled_at',
        'cancelled_by',
        'cancellation_reason',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'room_rate' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'service_charge' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_amount' => 'decimal:2',
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (!$booking->booking_number) {
                $booking->booking_number = 'BK' . date('Ymd') . strtoupper(Str::random(4));
            }
        });
    }

    /**
     * Get the guest
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Get the room
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the user who created the booking
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who checked in the guest
     */
    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    /**
     * Get the user who checked out the guest
     */
    public function checkedOutBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_out_by');
    }

    /**
     * Get the user who cancelled the booking
     */
    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    /**
     * Get the invoice for this booking
     */
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Get payments for this booking
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'payable_id')
            ->where('payable_type', self::class);
    }

    /**
     * Get restaurant orders for this booking
     */
    public function restaurantOrders(): HasMany
    {
        return $this->hasMany(RestaurantOrder::class);
    }

    /**
     * Get bar orders for this booking
     */
    public function barOrders(): HasMany
    {
        return $this->hasMany(BarOrder::class);
    }

    /**
     * Scope for active bookings
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNotIn('status', ['cancelled']);
    }

    /**
     * Scope for current bookings
     */
    public function scopeCurrent(Builder $query): Builder
    {
        return $query->where('status', 'checked_in')
            ->where('check_in_date', '<=', now())
            ->where('check_out_date', '>=', now());
    }

    /**
     * Scope for upcoming bookings
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('status', 'confirmed')
            ->where('check_in_date', '>', now());
    }

    /**
     * Scope for overdue checkouts
     */
    public function scopeOverdueCheckout(Builder $query): Builder
    {
        return $query->where('status', 'checked_in')
            ->where('check_out_date', '<', now()->toDateString());
    }

    /**
     * Calculate total nights
     */
    public function calculateNights(): int
    {
        return $this->check_in_date->diffInDays($this->check_out_date);
    }

    /**
     * Calculate total amount
     */
    public function calculateTotalAmount(): float
    {
        $subtotal = $this->room_rate * $this->nights;
        $taxAmount = $subtotal * (config('hotel.tax_rate', 10) / 100);
        $serviceCharge = $subtotal * (config('hotel.service_charge', 5) / 100);

        return $subtotal + $taxAmount + $serviceCharge - $this->discount_amount;
    }

    /**
     * Check if booking can be cancelled
     */
    public function canBeCancelled(): bool
    {
        if (in_array($this->status, ['cancelled', 'checked_out'])) {
            return false;
        }

        $cancellationHours = config('hotel.booking.cancellation_hours', 24);
        $cancellationDeadline = $this->check_in_date->subHours($cancellationHours);

        return now() <= $cancellationDeadline;
    }

    /**
     * Check if guest can check in
     */
    public function canCheckIn(): bool
    {
        return $this->status === 'confirmed' &&
               $this->check_in_date->isToday() &&
               $this->room->status === 'available';
    }

    /**
     * Check if guest can check out
     */
    public function canCheckOut(): bool
    {
        return $this->status === 'checked_in';
    }

    /**
     * Get booking duration in human readable format
     */
    public function getDurationAttribute(): string
    {
        return $this->nights . ' night' . ($this->nights > 1 ? 's' : '');
    }

    /**
     * Get remaining balance
     */
    public function getRemainingBalance(): float
    {
        return $this->total_amount - $this->paid_amount;
    }

    /**
     * Check if booking is fully paid
     */
    public function isFullyPaid(): bool
    {
        return $this->paid_amount >= $this->total_amount;
    }
}
