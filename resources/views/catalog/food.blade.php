@extends('layouts.site')

@section('title', 'Food Menu - ' . ($settings->site_name ?? config('app.name')))
@section('meta_description', 'Browse our delicious food menu')

@section('content')
<!-- Hero Section -->
<div class="section big-55-height over-hide">
    <div class="parallax parallax-top" style="background-image: url('{{ url('/assets/img/gallery/3.jpg') }}')"></div>
    <div class="dark-over-pages"></div>
    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">Food Menu</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<div class="section padding-top-bottom-small background-dark-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('catalog.index') }}" class="breadcrumb-link"><i class="fa fa-arrow-left"></i> Back to Catalog</a>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="section padding-top-bottom-small background-grey">
    <div class="container">
        <form method="GET" action="{{ route('catalog.food') }}" class="filter-form">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <select name="category" class="form-control" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="vegetarian" value="1" {{ request('vegetarian') ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>Vegetarian Only</span>
                    </label>
                    <label class="filter-checkbox ml-3">
                        <input type="checkbox" name="vegan" value="1" {{ request('vegan') ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>Vegan Only</span>
                    </label>
                </div>
                <div class="col-md-4 text-md-right">
                    <span class="result-count">{{ $foods->count() }} items found</span>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Food Items -->
<div class="section padding-top-bottom">
    <div class="container">
        @if($foods->count() > 0)
        <div class="row">
            @foreach($foods as $food)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="{{ route('catalog.food.show', $food->id) }}" class="catalog-item-card">
                    <div class="catalog-item-image" style="background-image: url('{{ $food->image ? \App\Helpers\ImageHelper::url($food->image) : url('/assets/img/gallery/1.jpg') }}')">
                        <div class="catalog-item-overlay">
                            <span class="view-details">View Details</span>
                        </div>
                        @if($food->is_vegetarian)
                        <span class="catalog-badge vegetarian"><i class="fa fa-leaf"></i></span>
                        @endif
                        @if($food->is_spicy)
                        <span class="catalog-badge spicy" style="right: auto; left: 10px;"><i class="fa fa-fire"></i></span>
                        @endif
                    </div>
                    <div class="catalog-item-info">
                        <span class="catalog-item-category">{{ ucfirst($food->category) }}</span>
                        <h4>{{ $food->name }}</h4>
                        <p class="catalog-item-desc">{{ Str::limit($food->description, 60) }}</p>
                        <p class="catalog-item-price">{{ config('hotel.currency_symbol', '₦') }}{{ number_format($food->price, 2) }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="fa fa-cutlery fa-3x text-muted mb-3"></i>
                <h4>No food items found</h4>
                <p class="text-muted">Try adjusting your filters</p>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.breadcrumb-link {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 14px;
}
.breadcrumb-link:hover {
    color: #fff;
}
.filter-form .form-control {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px 15px;
}
.filter-checkbox {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    margin-right: 20px;
}
.filter-checkbox input {
    margin-right: 8px;
}
.result-count {
    color: #666;
    font-size: 14px;
}
.catalog-item-card {
    display: block;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
    height: 100%;
}
.catalog-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    text-decoration: none;
}
.catalog-item-image {
    height: 180px;
    background-size: cover;
    background-position: center;
    position: relative;
}
.catalog-item-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.catalog-item-card:hover .catalog-item-overlay {
    opacity: 1;
}
.view-details {
    color: #fff;
    padding: 8px 16px;
    border: 1px solid #fff;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.catalog-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 10px;
    font-size: 11px;
    border-radius: 4px;
    background: rgba(0,0,0,0.6);
    color: #fff;
}
.catalog-badge.vegetarian {
    background: #27ae60;
}
.catalog-badge.spicy {
    background: #e74c3c;
}
.catalog-item-info {
    padding: 15px;
}
.catalog-item-category {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--secondary-color, #c9a962);
}
.catalog-item-info h4 {
    margin: 6px 0;
    font-size: 16px;
    color: #333;
}
.catalog-item-desc {
    font-size: 13px;
    color: #666;
    margin-bottom: 10px;
}
.catalog-item-price {
    color: #333;
    font-weight: 600;
    margin: 0;
    font-size: 15px;
}
</style>
@endsection
