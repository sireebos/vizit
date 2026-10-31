@extends('layouts.site')

@section('title', 'Rooms - ' . ($settings->site_name ?? config('app.name')))
@section('meta_description', 'Browse our luxury rooms and suites')

@section('content')
<!-- Hero Section -->
<div class="section big-55-height over-hide">
    <div class="parallax parallax-top" style="background-image: url('{{ url('/assets/img/rooms/1.jpg') }}')"></div>
    <div class="dark-over-pages"></div>
    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">Our Rooms</div>
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
        <form method="GET" action="{{ route('catalog.rooms') }}" class="filter-form">
            <div class="row align-items-center">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Min Price</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control" placeholder="Min Price">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Max Price</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="Max Price">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Guests</label>
                    <select name="guests" class="form-control">
                        <option value="">Any</option>
                        @for($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>{{ $i }}+ Guests</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="filter-label">&nbsp;</label>
                    <button type="submit" class="btn-filter">Apply Filters</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Rooms List -->
<div class="section padding-top-bottom">
    <div class="container">
        @if($rooms->count() > 0)
        <div class="row">
            @foreach($rooms as $room)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('catalog.rooms.show', $room->slug) }}" class="room-card">
                    <div class="room-image" style="background-image: url('{{ $room->main_image ? \App\Helpers\ImageHelper::url($room->main_image) : url('/assets/img/rooms/1.jpg') }}')">
                        <div class="room-overlay">
                            <span class="view-details">View Details</span>
                        </div>
                        @if($room->stars)
                        <div class="room-stars">
                            @for($i = 0; $i < $room->stars; $i++)
                            <i class="fa fa-star"></i>
                            @endfor
                        </div>
                        @endif
                    </div>
                    <div class="room-info">
                        <span class="room-type">{{ $room->subtitle ?? 'Room' }}</span>
                        <h3>{{ $room->name }}</h3>
                        <p class="room-desc">{{ Str::limit($room->description, 100) }}</p>
                        <div class="room-features">
                            <span><i class="fa fa-users"></i> {{ $room->max_occupancy }} Guests</span>
                            @if($room->size_sqft)
                            <span><i class="fa fa-expand"></i> {{ $room->size_sqft }} sq ft</span>
                            @endif
                        </div>
                        <div class="room-price">
                            <span class="price">{{ config('hotel.currency_symbol', '₦') }}{{ number_format($room->base_price, 2) }}</span>
                            <span class="per-night">/ night</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="fa fa-bed fa-3x text-muted mb-3"></i>
                <h4>No rooms found</h4>
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
.filter-label {
    display: block;
    font-size: 12px;
    color: #666;
    margin-bottom: 5px;
}
.btn-filter {
    display: block;
    width: 100%;
    padding: 12px;
    background: var(--secondary-color, #c9a962);
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
}
.btn-filter:hover {
    background: #333;
}
.room-card {
    display: block;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
    height: 100%;
}
.room-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    text-decoration: none;
}
.room-image {
    height: 220px;
    background-size: cover;
    background-position: center;
    position: relative;
}
.room-overlay {
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
.room-card:hover .room-overlay {
    opacity: 1;
}
.view-details {
    color: #fff;
    padding: 10px 20px;
    border: 1px solid #fff;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.room-stars {
    position: absolute;
    top: 15px;
    right: 15px;
    color: #f1c40f;
    font-size: 12px;
}
.room-info {
    padding: 25px;
}
.room-type {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--secondary-color, #c9a962);
}
.room-info h3 {
    margin: 8px 0 12px;
    font-size: 22px;
    color: #333;
}
.room-desc {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
}
.room-features {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}
.room-features span {
    font-size: 13px;
    color: #666;
}
.room-features i {
    margin-right: 5px;
    color: var(--secondary-color, #c9a962);
}
.room-price {
    display: flex;
    align-items: baseline;
}
.room-price .price {
    font-size: 24px;
    font-weight: 600;
    color: #333;
}
.room-price .per-night {
    font-size: 14px;
    color: #999;
    margin-left: 5px;
}
</style>
@endsection
