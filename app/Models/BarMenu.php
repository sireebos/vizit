<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BarMenu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'image',
        'ingredients',
        'alcohol_content',
        'serving_size',
        'is_alcoholic',
        'is_available',
        'is_featured',
        'sort_order',
        'cost_price',
        'preparation_notes',
        'preparation_time',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'alcohol_content' => 'decimal:2',
        'ingredients' => 'array',
        'is_alcoholic' => 'boolean',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
    ];

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
     * Scope for alcoholic drinks
     */
    public function scopeAlcoholic(Builder $query): Builder
    {
        return $query->where('is_alcoholic', true);
    }

    /**
     * Scope for non-alcoholic drinks
     */
    public function scopeNonAlcoholic(Builder $query): Builder
    {
        return $query->where('is_alcoholic', false);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        $currency = \App\Models\SiteSettings::instance()->currency_symbol ?? '₦';
        return $currency . number_format($this->price, 2);
    }

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute(): string
    {
        $labels = [
            'beer' => 'Beer',
            'wine' => 'Wine',
            'spirits' => 'Spirits',
            'cocktail' => 'Cocktail',
            'mocktail' => 'Mocktail',
            'soft_drink' => 'Soft Drink',
            'coffee' => 'Coffee',
            'tea' => 'Tea',
        ];

        return $labels[$this->category] ?? ucfirst($this->category);
    }

    /**
     * Generate unique barcode code
     */
    public function getBarcodeAttribute(): string
    {
        return 'DRK' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
