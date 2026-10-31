<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'room_type_id',
        'floor',
        'status',
        'description',
        'features',
        'images',
        'last_cleaned_at',
        'last_maintenance_at',
        'maintenance_notes',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
        'last_cleaned_at' => 'datetime',
        'last_maintenance_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the room type
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Get bookings for this room
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get current booking
     */
    public function currentBooking()
    {
        return $this->bookings()
            ->where('status', 'checked_in')
            ->where('check_in_date', '<=', now())
            ->where('check_out_date', '>=', now())
            ->first();
    }

    /**
     * Scope for available rooms
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'available')->where('is_active', true);
    }

    /**
     * Scope for occupied rooms
     */
    public function scopeOccupied(Builder $query): Builder
    {
        return $query->where('status', 'occupied');
    }

    /**
     * Scope for rooms by floor
     */
    public function scopeByFloor(Builder $query, string $floor): Builder
    {
        return $query->where('floor', $floor);
    }

    /**
     * Scope for rooms by type
     */
    public function scopeByType(Builder $query, int $roomTypeId): Builder
    {
        return $query->where('room_type_id', $roomTypeId);
    }

    /**
     * Check if room is available for date range
     */
    public function isAvailableForDates($startDate, $endDate, $excludeBookingId = null)
    {
        if ($this->status !== 'available' || !$this->is_active) {
            return false;
        }

        $conflictingBookings = $this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('check_in_date', [$startDate, $endDate])
                    ->orWhereBetween('check_out_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('check_in_date', '<=', $startDate)
                          ->where('check_out_date', '>=', $endDate);
                    });
            })
            ->when($excludeBookingId, function ($query, $excludeBookingId) {
                $query->where('id', '!=', $excludeBookingId);
            })
            ->exists();

        return !$conflictingBookings;
    }

    /**
     * Mark room as cleaned
     */
    public function markAsCleaned()
    {
        $this->update([
            'last_cleaned_at' => now(),
            'status' => 'available'
        ]);
    }

    /**
     * Mark room for maintenance
     */
    public function markForMaintenance($notes = null)
    {
        $this->update([
            'status' => 'maintenance',
            'maintenance_notes' => $notes,
            'last_maintenance_at' => now()
        ]);
    }

    /**
     * Get room display name
     */
    public function getDisplayNameAttribute()
    {
        return $this->room_number . ' (' . $this->roomType->name . ')';
    }

    /**
     * Check if room needs cleaning
     */
    public function needsCleaning()
    {
        return $this->status === 'cleaning' ||
               ($this->last_cleaned_at && $this->last_cleaned_at->diffInHours(now()) > 24);
    }

    /**
     * Check if room needs maintenance
     */
    public function needsMaintenance()
    {
        $maintenanceInterval = config('hotel.rooms.maintenance_reminder_days', 30);
        return !$this->last_maintenance_at ||
               $this->last_maintenance_at->diffInDays(now()) >= $maintenanceInterval;
    }
}
