@extends('layouts.site')

@section('title', $page->seo_title ?? ($siteSettings->site_name ?? 'Terms & Conditions'))

@section('content')
@if($page->visible('hero'))
<div class="section big-55-height over-hide z-bigger">

	<div class="parallax parallax-top" style="background-image: url('@imgUrl($page->content('hero_image'), '/assets/img/3.jpg')')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">{{ $page->content('hero_title', 'Terms & Conditions') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@if($page->visible('faq'))
@php
	$faqCount = (int) $page->content('faq_count', 5);
	if ($faqCount < 1) $faqCount = 5;
	$defaultQuestions = [
		1 => 'Can I cancel booking?',
		2 => 'When do I check out?',
		3 => 'What is your refund policy?',
		4 => 'Should I print a receipt to show the hotel?',
		5 => 'How to become a VIP customer in our resort?'
	];
	$defaultAnswer = 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.';
@endphp
<div class="section padding-top-bottom z-bigger">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 align-self-center">
				<div class="subtitle with-line text-center mb-4">{{ $page->content('faq_subtitle', 'frequently asked questions') }}</div>
				<h3 class="text-center padding-bottom-small">{{ $page->content('faq_title', 'General queries') }}</h3>
			</div>
			<div class="section clearfix"></div>
			<div class="col-lg-8">
				<div id="accordion">
					@for ($i = 1; $i <= $faqCount; $i++)
						@php
							$question = $page->content("faq_{$i}_question", $defaultQuestions[$i] ?? '');
							$answer = $page->content("faq_{$i}_answer", '');
							$collapseId = 'collapse' . $i;
							$headingId = 'heading' . $i;
							$isFirst = ($i === 1);
							$isLast = ($i === $faqCount);
						@endphp
						@if (!empty($question))
						<div class="card">
							<div class="card-header" id="{{ $headingId }}">
								<h5 class="m-0">
									<button class="btn btn-link {{ $isLast ? 'last' : '' }} {{ !$isFirst ? 'collapsed' : '' }}" data-toggle="collapse" data-target="#{{ $collapseId }}" aria-expanded="{{ $isFirst ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
									{{ $question }}
									</button>
								</h5>
							</div>
							<div id="{{ $collapseId }}" class="collapse {{ $isFirst ? 'show' : '' }}" aria-labelledby="{{ $headingId }}" data-parent="#accordion">
								<div class="card-body {{ $isLast ? 'last' : '' }}">
									{{ $answer ?: $defaultAnswer }}
								</div>
							</div>
						</div>
						@endif
					@endfor
				</div>
			</div>
		</div>
	</div>
</div>
@endif

<div class="section background-dark over-hide">
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-1.jpg') }}" alt="">
						<div class="services-text-over">spa salon</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 pt-4 pt-sm-0">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-2.jpg') }}" alt="">
						<div class="services-text-over">restaurant</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 pt-4 pt-lg-0">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-3.jpg') }}" alt="">
						<div class="services-text-over">pool</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 pt-4 pt-lg-0">
				<a href="{{ route('services') }}">
					<div class="img-wrap services-wrap">
						<img src="{{ url('/assets/img/ser-4.jpg') }}" alt="">
						<div class="services-text-over">activities</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection