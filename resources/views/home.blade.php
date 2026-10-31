@extends('layouts.site')

@section('title', $home->seo_title ?? ($settings->site_name ?? config('app.name', 'Laravel')))
@section('meta_description', $home->seo_description ?? ($settings->meta_description ?? ''))

@push('styles')
@php
    $pageStyles = $home->page_styles ?? [];
@endphp
@if(!empty($pageStyles))
<style>
    /* Page-specific styles */
    @if(!empty($pageStyles['background_color']))
    .page-content {
        background-color: {{ $pageStyles['background_color'] }};
    }
    @endif
    @if(!empty($pageStyles['text_color']))
    .page-content, .page-content p {
        color: {{ $pageStyles['text_color'] }};
    }
    @endif
    @if(!empty($pageStyles['heading_color']))
    .page-content h1, .page-content h2, .page-content h3, 
    .page-content h4, .page-content h5, .page-content h6 {
        color: {{ $pageStyles['heading_color'] }};
    }
    @endif
    @if(!empty($pageStyles['accent_color']))
    .page-content .subtitle, .page-content .color-1 {
        color: {{ $pageStyles['accent_color'] }} !important;
    }
    .page-content .btn-primary, .page-content .booking-button, .page-content .booking-button-big {
        background-color: {{ $pageStyles['accent_color'] }} !important;
        border-color: {{ $pageStyles['accent_color'] }} !important;
    }
    @endif
    @if(!empty($pageStyles['background_image']))
    .page-content {
        background-image: url('{{ $pageStyles['background_image'] }}');
        background-size: cover;
        background-position: center;
    }
    @endif
    
    /* Custom page CSS */
    {!! $pageStyles['custom_css'] ?? '' !!}
</style>
@endif
@endpush

@section('content')
<div class="page-content">
@php
    $orderedSections = $home->getOrderedSections();
@endphp

@foreach($orderedSections as $sectionKey)
    @includeIf('home.sections.' . $sectionKey, ['home' => $home])
@endforeach
</div>
@endsection

