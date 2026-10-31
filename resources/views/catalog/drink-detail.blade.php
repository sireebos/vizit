@extends('layouts.site')

@section('title', $drink->name . ' - ' . ($settings->site_name ?? config('app.name')))
@section('meta_description', Str::limit($drink->description, 160))

@section('content')
<!-- Hero Section -->
<div class="section big-55-height over-hide">
    <div class="parallax parallax-top" style="background-image: url('{{ $drink->image ? \App\Helpers\ImageHelper::url($drink->image) : url('/assets/img/gallery/6.jpg') }}')"></div>
    <div class="dark-over-pages"></div>
    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">{{ $drink->name }}</div>
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
                <a href="{{ route('catalog.drinks') }}" class="breadcrumb-link"><i class="fa fa-arrow-left"></i> Back to Drinks Menu</a>
            </div>
        </div>
    </div>
</div>

<!-- Drink Detail -->
<div class="section padding-top-bottom">
    <div class="container">
        <div class="row">
            <!-- Image -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="detail-image" style="background-image: url('{{ $drink->image ? \App\Helpers\ImageHelper::url($drink->image) : url('/assets/img/gallery/2.jpg') }}')">
                    @if($drink->is_alcoholic)
                    <span class="detail-badge alcoholic"><i class="fa fa-exclamation-triangle"></i> 21+ Only</span>
                    @endif
                </div>
            </div>

            <!-- Details -->
            <div class="col-lg-6">
                <div class="detail-content">
                    <span class="detail-category">{{ $drink->category_label }}</span>
                    <h1>{{ $drink->name }}</h1>
                    <p class="detail-price">{{ $drink->formatted_price }}</p>
                    
                    <div class="detail-description">
                        <p>{{ $drink->description }}</p>
                    </div>

                    <div class="detail-specs">
                        @if($drink->serving_size)
                        <div class="spec-item">
                            <span class="spec-label">Serving Size</span>
                            <span class="spec-value">{{ $drink->serving_size }}</span>
                        </div>
                        @endif
                        @if($drink->alcohol_content)
                        <div class="spec-item">
                            <span class="spec-label">Alcohol Content</span>
                            <span class="spec-value">{{ $drink->alcohol_content }}%</span>
                        </div>
                        @endif
                        @if($drink->preparation_time)
                        <div class="spec-item">
                            <span class="spec-label">Preparation Time</span>
                            <span class="spec-value">{{ $drink->preparation_time }} min</span>
                        </div>
                        @endif
                    </div>

                    @if($drink->ingredients && count($drink->ingredients) > 0)
                    <div class="detail-section">
                        <h4>Ingredients</h4>
                        <div class="ingredient-tags">
                            @foreach($drink->ingredients as $ingredient)
                            <span class="ingredient-tag">{{ $ingredient }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($drink->preparation_notes)
                    <div class="detail-section">
                        <h4>Bartender's Notes</h4>
                        <p class="bartender-notes">{{ $drink->preparation_notes }}</p>
                    </div>
                    @endif

                    <!-- Barcode Section -->
                    <div class="barcode-section">
                        <h4>Item Barcode</h4>
                        <div class="barcode-container">
                            <svg id="barcode"></svg>
                            <p class="barcode-number">{{ $barcode }}</p>
                        </div>
                        <a href="{{ route('catalog.print-barcode', ['type' => 'drink', 'id' => $drink->id]) }}" target="_blank" class="btn-print">
                            <i class="fa fa-print"></i> Print Barcode
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Items -->
        @if($relatedItems->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="related-title">More {{ $drink->category_label }}s</h3>
            </div>
            @foreach($relatedItems as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="{{ route('catalog.drinks.show', $item->id) }}" class="catalog-item-card">
                    <div class="catalog-item-image" style="background-image: url('{{ $item->image ? \App\Helpers\ImageHelper::url($item->image) : url('/assets/img/gallery/2.jpg') }}')">
                        <div class="catalog-item-overlay">
                            <span class="view-details">View Details</span>
                        </div>
                        @if($item->is_alcoholic)
                        <span class="catalog-badge alcoholic">21+</span>
                        @endif
                    </div>
                    <div class="catalog-item-info">
                        <h4>{{ $item->name }}</h4>
                        <p class="catalog-item-price">{{ $item->formatted_price }}</p>
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
.detail-image {
    height: 450px;
    background-size: cover;
    background-position: center;
    border-radius: 12px;
    position: relative;
}
.detail-badge {
    position: absolute;
    bottom: 15px;
    left: 15px;
    padding: 8px 15px;
    border-radius: 4px;
    font-size: 12px;
    color: #fff;
}
.detail-badge.alcoholic {
    background: #e74c3c;
}
.detail-content {
    padding-left: 30px;
}
.detail-category {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--secondary-color, #c9a962);
}
.detail-content h1 {
    font-size: 36px;
    margin: 10px 0 15px;
}
.detail-price {
    font-size: 28px;
    font-weight: 600;
    color: var(--secondary-color, #c9a962);
    margin-bottom: 20px;
}
.detail-description {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 25px;
}
.detail-specs {
    display: flex;
    gap: 30px;
    margin-bottom: 25px;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}
.spec-item {
    text-align: center;
}
.spec-label {
    display: block;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #999;
    margin-bottom: 5px;
}
.spec-value {
    font-size: 18px;
    font-weight: 600;
    color: #333;
}
.detail-section {
    margin-bottom: 25px;
}
.detail-section h4 {
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
    color: #333;
}
.ingredient-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.ingredient-tag {
    padding: 6px 12px;
    background: #f0f0f0;
    border-radius: 20px;
    font-size: 13px;
    color: #555;
}
.bartender-notes {
    font-style: italic;
    color: #666;
    padding-left: 15px;
    border-left: 3px solid var(--secondary-color, #c9a962);
}
.barcode-section {
    margin-top: 30px;
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
    padding: 12px 25px;
    background: var(--secondary-color, #c9a962);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
.btn-print:hover {
    background: #333;
    color: #fff;
    text-decoration: none;
}
.related-title {
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}
.catalog-item-card {
    display: block;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
}
.catalog-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    text-decoration: none;
}
.catalog-item-image {
    height: 150px;
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
    font-size: 10px;
    border-radius: 4px;
    background: #e74c3c;
    color: #fff;
}
.catalog-item-info {
    padding: 15px;
}
.catalog-item-info h4 {
    margin: 0 0 8px;
    font-size: 15px;
    color: #333;
}
.catalog-item-price {
    color: var(--secondary-color, #c9a962);
    font-weight: 600;
    margin: 0;
}
</style>
@endsection
