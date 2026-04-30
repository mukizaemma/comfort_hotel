@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
@php
    $heroImage2 = '';
    if ($about && $about->image2) {
        if (strpos($about->image2, '/') !== false || strpos($about->image2, 'abouts') === 0) {
            $heroImage2 = asset('storage/' . $about->image2);
        } else {
            $heroImage2 = asset('storage/images/about/' . $about->image2);
        }
    } else {
        $heroImage2 = asset('storage/images/about/default.jpg');
    }
@endphp
<div class="rts__section page__hero__height page__hero__bg" style="background-image: url({{ $heroImage2 }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="page__hero__content">
                    <h1 class="wow fadeInUp">Guest Reviews</h1>
                    <p class="wow fadeInUp font-sm">Read what our guests have to say about their stay</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

@php
    $bookingUrl = trim((string) ($setting->linktree ?? ''));
    $tripadvisorUrl = trim((string) ($setting->tripadvisor_reviews_url ?? ''));
    $googleReviewsUrl = trim((string) ($setting->google_reviews_url ?? ''));
@endphp

<style>
    .trust-card { background:#fff; border:1px solid #e9edf3; border-radius:12px; box-shadow:0 8px 24px rgba(16,24,40,.05); height:100%; }
    .trust-card-head { padding:18px 18px 12px; border-bottom:1px solid #eef2f7; display:flex; align-items:center; gap:10px; }
    .trust-card-body { padding:16px 18px; }
    .trust-score { font-size:34px; line-height:1; color:#1f7a54; font-weight:700; }
    .trust-muted { color:#6b7280; font-size:14px; }
    .trust-action { display:block; width:100%; text-align:center; border-radius:8px; min-height:44px; line-height:44px; text-decoration:none; font-weight:600; border:1px solid #c9d8ef; }
    .trust-action.primary { background:#165fc2; color:#fff; border-color:#165fc2; }
    .trust-action.secondary { background:#fff; color:#165fc2; }
</style>

<!-- Reviews Section -->
<div class="rts__section section__padding" style="background:#f8fafc;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2>Reviews you can trust</h2>
                <p class="trust-muted mt-2 mb-0">
                    We do not collect reviews on this website. Open each platform below to read or write a review.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="trust-card">
                    <div class="trust-card-head">
                        <i class="fas fa-bed" style="color:#1e5fbf;"></i>
                        <div>
                            <h5 class="mb-0">Booking.com</h5>
                            <small class="trust-muted">Official listing</small>
                        </div>
                    </div>
                    <div class="trust-card-body">
                        <p class="trust-muted mb-3">Check property score and guest feedback directly on Booking.com.</p>
                        @if(!empty($bookingUrl))
                            <a href="{{ $bookingUrl }}" target="_blank" rel="noopener noreferrer" class="trust-action primary mb-2">Open Booking.com listing</a>
                            <a href="{{ $bookingUrl }}" target="_blank" rel="noopener noreferrer" class="trust-action secondary">Write a review on Booking.com</a>
                        @else
                            <p class="mb-0 text-danger">Booking.com URL not configured in settings.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="trust-card">
                    <div class="trust-card-head">
                        <i class="fab fa-tripadvisor" style="color:#34b28a;"></i>
                        <div>
                            <h5 class="mb-0">TripAdvisor</h5>
                            <small class="trust-muted">Traveler ranking & reviews</small>
                        </div>
                    </div>
                    <div class="trust-card-body">
                        <p class="trust-muted mb-3">View guest experiences and rankings on TripAdvisor.</p>
                        @if(!empty($tripadvisorUrl))
                            <a href="{{ $tripadvisorUrl }}" target="_blank" rel="noopener noreferrer" class="trust-action primary mb-2">Open TripAdvisor listing</a>
                            <a href="{{ $tripadvisorUrl }}" target="_blank" rel="noopener noreferrer" class="trust-action secondary">Write a review on TripAdvisor</a>
                        @else
                            <p class="mb-0 text-danger">TripAdvisor URL not configured in settings.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="trust-card">
                    <div class="trust-card-head">
                        <i class="fab fa-google" style="color:#2563eb;"></i>
                        <div>
                            <h5 class="mb-0">Google</h5>
                            <small class="trust-muted">Maps & Business profile</small>
                        </div>
                    </div>
                    <div class="trust-card-body">
                        <p class="trust-muted mb-3">Read ratings and leave your feedback on Google Maps.</p>
                        @if(!empty($googleReviewsUrl))
                            <a href="{{ $googleReviewsUrl }}" target="_blank" rel="noopener noreferrer" class="trust-action primary mb-2">Open Google Maps listing</a>
                            <a href="{{ $googleReviewsUrl }}" target="_blank" rel="noopener noreferrer" class="trust-action secondary">Write a review on Google</a>
                        @else
                            <p class="mb-0 text-danger">Google reviews URL not configured in settings.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reviews End -->

@endsection
