<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class RoomType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subtitle',
        'stars',
        'description',
        'max_occupancy',
        'max_adults',
        'max_children',
        'base_price',
        'amenities',
        'images',
        'size_sqft',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'amenities' => 'array',
        'images' => 'array',
        'base_price' => 'decimal:2',
        'size_sqft' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($roomType) {
            if (empty($roomType->slug)) {
                $roomType->slug = Str::slug($roomType->name);
            }
        });

        static::updating(function ($roomType) {
            if ($roomType->isDirty('name') && !$roomType->isDirty('slug')) {
                $roomType->slug = Str::slug($roomType->name);
            }
        });
    }

    public function getMainImageAttribute()
    {
        $images = $this->images;
        if (!empty($images) && is_array($images)) {
            $firstImage = $images[0];
            if (str_starts_with($firstImage, 'http')) {
                return $firstImage;
            }
            return url('/storage/' . $firstImage);
        }
        return url('/assets/img/room3.jpg');
    }

    public function getStarsArrayAttribute()
    {
        $stars = $this->stars ?? 5;
        return array_fill(0, $stars, true);
    }

    // Accessor to ensure images is always an array
    public function getImagesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?: [];
    }

    // Accessor to ensure amenities is always an array
    public function getAmenitiesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?: [];
    }

    /**
     * Get rooms of this type
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Get room prices for this type
     */
    public function roomPrices(): HasMany
    {
        return $this->hasMany(RoomPrice::class);
    }

    /**
     * Get available rooms of this type
     */
    public function availableRooms(): HasMany
    {
        return $this->rooms()->where('status', 'available')->where('is_active', true);
    }

    /**
     * Scope for active room types
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering by sort order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get current price for a date range
     */
    public function getCurrentPrice($startDate, $endDate, $bookingType = 'daily')
    {
        $price = $this->roomPrices()
            ->where('is_active', true)
            ->where('start_date', '<=', $startDate)
            ->where('end_date', '>=', $endDate)
            ->orderBy('priority', 'desc')
            ->first();

        if ($price) {
            return match($bookingType) {
                'weekly' => $price->weekly_rate ?? $price->daily_rate * 7,
                'monthly' => $price->monthly_rate ?? $price->daily_rate * 30,
                default => $price->daily_rate,
            };
        }

        return $this->base_price;
    }

    /**
     * Check if room type has available rooms for date range
     */
    public function hasAvailability($startDate, $endDate, $excludeBookingId = null)
    {
        $totalRooms = $this->availableRooms()->count();

        $bookedRooms = Booking::whereHas('room', function ($query) {
                $query->where('room_type_id', $this->id);
            })
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
            ->count();

        return $totalRooms > $bookedRooms;
    }
}
