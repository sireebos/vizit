<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class RestaurantMenu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'image',
        'ingredients',
        'allergens',
        'preparation_time',
        'is_vegetarian',
        'is_vegan',
        'is_spicy',
        'is_available',
        'is_featured',
        'sort_order',
        'cost_price',
        'chef_notes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'ingredients' => 'array',
        'allergens' => 'array',
        'is_vegetarian' => 'boolean',
        'is_vegan' => 'boolean',
        'is_spicy' => 'boolean',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get restaurant order items for this menu item
     */
    public function restaurantOrderItems(): HasMany
    {
        return $this->hasMany(RestaurantOrderItem::class, 'menu_item_id');
    }

    /**
     * Scope for available items
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope for featured items
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope by category
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope for vegetarian items
     */
    public function scopeVegetarian(Builder $query): Builder
    {
        return $query->where('is_vegetarian', true);
    }

    /**
     * Scope for vegan items
     */
    public function scopeVegan(Builder $query): Builder
    {
        return $query->where('is_vegan', true);
    }

    /**
     * Scope for ordered items
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get profit margin
     */
    public function getProfitMargin(): float
    {
        if (!$this->cost_price || $this->cost_price == 0) {
            return 0;
        }

        return (($this->price - $this->cost_price) / $this->cost_price) * 100;
    }

    /**
     * Get categories for dropdown
     */
    public static function getCategories(): array
    {
        return config('hotel.restaurant.categories', [
            'appetizer' => 'Appetizers',
            'main_course' => 'Main Course',
            'dessert' => 'Desserts',
            'beverage' => 'Beverages',
            'breakfast' => 'Breakfast',
            'lunch' => 'Lunch',
            'dinner' => 'Dinner',
        ]);
    }

    /**
     * Get allergen list
     */
    public function getAllergenList(): string
    {
        return $this->allergens ? implode(', ', $this->allergens) : 'None';
    }

    /**
     * Check if item has specific allergen
     */
    public function hasAllergen(string $allergen): bool
    {
        return $this->allergens && in_array($allergen, $this->allergens);
    }

    /**
     * Get dietary info
     */
    public function getDietaryInfo(): array
    {
        $info = [];

        if ($this->is_vegetarian) $info[] = 'Vegetarian';
        if ($this->is_vegan) $info[] = 'Vegan';
        if ($this->is_spicy) $info[] = 'Spicy';

        return $info;
    }

    /**
     * Get preparation time in human readable format
     */
    public function getPreparationTimeFormatted(): string
    {
        if (!$this->preparation_time) {
            return 'N/A';
        }

        return $this->preparation_time . ' min' . ($this->preparation_time > 1 ? 's' : '');
    }
}
