@extends('layouts.site')

@section('title', $room->name . ' - ' . ($settings->site_name ?? config('app.name')))
@section('meta_description', Str::limit($room->description, 160))

@section('content')
<!-- Hero Section -->
<div class="section big-55-height over-hide">
    <div class="parallax parallax-top" style="background-image: url('{{ $room->main_image ? \App\Helpers\ImageHelper::url($room->main_image) : url('/assets/img/rooms/1.jpg') }}')"></div>
    <div class="dark-over-pages"></div>
    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">{{ $room->name }}</div>
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
                <a href="{{ route('catalog.rooms') }}" class="breadcrumb-link"><i class="fa fa-arrow-left"></i> Back to Rooms</a>
            </div>
        </div>
    </div>
</div>

<!-- Room Detail -->
<div class="section padding-top-bottom">
    <div class="container">
        <div class="row">
            <!-- Gallery -->
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="room-gallery">
                    <div class="main-image" style="background-image: url('{{ $room->main_image ? \App\Helpers\ImageHelper::url($room->main_image) : url('/assets/img/rooms/1.jpg') }}')">
                        @if($room->stars)
                        <div class="room-stars">
                            @for($i = 0; $i < $room->stars; $i++)
                            <i class="fa fa-star"></i>
                            @endfor
                        </div>
                        @endif
                    </div>
                    @if($room->images && count($room->images) > 1)
                    <div class="thumbnail-row">
                        @foreach(array_slice($room->images, 0, 4) as $index => $image)
                        <div class="thumbnail" style="background-image: url('{{ \App\Helpers\ImageHelper::url($image) }}')"></div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Details -->
            <div class="col-lg-5">
                <div class="room-detail-content">
                    <span class="room-type">{{ $room->subtitle ?? 'Room' }}</span>
                    <h1>{{ $room->name }}</h1>
                    <div class="room-price-box">
                        <span class="price">{{ config('hotel.currency_symbol', '₦') }}{{ number_format($room->base_price, 2) }}</span>
                        <span class="per-night">/ night</span>
                    </div>

                    <div class="room-specs">
                        <div class="spec">
                            <i class="fa fa-users"></i>
                            <span>{{ $room->max_occupancy }} Guests</span>
                        </div>
                        @if($room->max_adults)
                        <div class="spec">
                            <i class="fa fa-user"></i>
                            <span>{{ $room->max_adults }} Adults</span>
                        </div>
                        @endif
                        @if($room->max_children)
                        <div class="spec">
                            <i class="fa fa-child"></i>
                            <span>{{ $room->max_children }} Children</span>
                        </div>
                        @endif
                        @if($room->size_sqft)
                        <div class="spec">
                            <i class="fa fa-expand"></i>
                            <span>{{ $room->size_sqft }} sq ft</span>
                        </div>
                        @endif
                    </div>

                    <div class="room-description">
                        <h4>Description</h4>
                        <p>{{ $room->description }}</p>
                    </div>

                    @if($room->amenities && count($room->amenities) > 0)
                    <div class="room-amenities">
                        <h4>Amenities</h4>
                        <div class="amenity-list">
                            @foreach($room->amenities as $amenity)
                            <span class="amenity-item"><i class="fa fa-check"></i> {{ $amenity }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Barcode Section -->
                    <div class="barcode-section">
                        <h4>Room Barcode</h4>
                        <div class="barcode-container">
                            <svg id="barcode"></svg>
                            <p class="barcode-number">{{ $barcode }}</p>
                        </div>
                        <a href="{{ route('catalog.print-barcode', ['type' => 'room', 'id' => $room->id]) }}" target="_blank" class="btn-print">
                            <i class="fa fa-print"></i> Print Barcode
                        </a>
                    </div>

                    <a href="{{ route('search') }}" class="btn-book">
                        <i class="fa fa-calendar"></i> Check Availability
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Rooms -->
        @if($relatedRooms->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="related-title">Other Rooms</h3>
            </div>
            @foreach($relatedRooms as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('catalog.rooms.show', $item->slug) }}" class="room-card">
                    <div class="room-image" style="background-image: url('{{ $item->main_image ? \App\Helpers\ImageHelper::url($item->main_image) : url('/assets/img/rooms/1.jpg') }}')">
                        <div class="room-overlay">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                    <div class="room-info">
                        <h4>{{ $item->name }}</h4>
                        <p class="room-price">{{ config('hotel.currency_symbol', '₦') }}{{ number_format($item->base_price, 2) }}<small>/night</small></p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<!-- JsBarcode Library -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        JsBarcode("#barcode", "{{ $barcode }}", {
            format: "CODE128",
            lineColor: "#333",
            width: 2,
            height: 80,
            displayValue: false
        });
    });
</script>

<style>
.breadcrumb-link {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 14px;
}
.breadcrumb-link:hover {
    color: #fff;
}
.room-gallery .main-image {
    height: 400px;
    background-size: cover;
    background-position: center;
    border-radius: 12px;
    position: relative;
}
.room-stars {
    position: absolute;
    bottom: 20px;
    left: 20px;
    padding: 8px 15px;
    background: rgba(0,0,0,0.6);
    border-radius: 4px;
    color: #f1c40f;
}
.thumbnail-row {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}
.thumbnail {
    flex: 1;
    height: 80px;
    background-size: cover;
    background-position: center;
    border-radius: 6px;
    cursor: pointer;
    transition: opacity 0.3s ease;
}
.thumbnail:hover {
    opacity: 0.8;
}
.room-detail-content {
    padding-left: 20px;
}
.room-type {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--secondary-color, #c9a962);
}
.room-detail-content h1 {
    font-size: 32px;
    margin: 10px 0 20px;
}
.room-price-box {
    display: flex;
    align-items: baseline;
    margin-bottom: 25px;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}
.room-price-box .price {
    font-size: 32px;
    font-weight: 600;
    color: var(--secondary-color, #c9a962);
}
.room-price-box .per-night {
    font-size: 16px;
    color: #666;
    margin-left: 5px;
}
.room-specs {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 25px;
}
.spec {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #555;
}
.spec i {
    color: var(--secondary-color, #c9a962);
    width: 20px;
}
.room-description, .room-amenities {
    margin-bottom: 25px;
}
.room-description h4, .room-amenities h4 {
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
}
.room-description p {
    color: #555;
    line-height: 1.8;
}
.amenity-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.amenity-item {
    padding: 6px 12px;
    background: #f0f0f0;
    border-radius: 4px;
    font-size: 13px;
    color: #555;
}
.amenity-item i {
    color: #27ae60;
    margin-right: 5px;
}
.barcode-section {
    margin: 25px 0;
    padding: 25px;
    background: #f9f9f9;
    border-radius: 12px;
    text-align: center;
}
.barcode-section h4 {
    margin-bottom: 15px;
}
.barcode-container {
    display: inline-block;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    margin-bottom: 15px;
}
.barcode-number {
    margin-top: 10px;
    font-family: monospace;
    font-size: 16px;
    letter-spacing: 2px;
    color: #333;
}
.btn-print {
    display: inline-block;
    padding: 10px 20px;
    background: #666;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
.btn-print:hover {
    background: #333;
    color: #fff;
    text-decoration: none;
}
.btn-book {
    display: block;
    width: 100%;
    padding: 18px;
    background: var(--secondary-color, #c9a962);
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
.btn-book:hover {
    background: #333;
    color: #fff;
    text-decoration: none;
}
.related-title {
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}
.room-card {
    display: block;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
}
.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    text-decoration: none;
}
.room-image {
    height: 180px;
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
    padding: 8px 16px;
    border: 1px solid #fff;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.room-info {
    padding: 15px;
}
.room-info h4 {
    margin: 0 0 8px;
    font-size: 16px;
    color: #333;
}
.room-info .room-price {
    color: var(--secondary-color, #c9a962);
    font-weight: 600;
    margin: 0;
}
.room-info .room-price small {
    font-weight: normal;
    color: #999;
}
</style>
@endsection
