@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
@php
    $heroImage = '';
    $heroCaption = 'Contact Us';
    $heroDescription = "We'd love to help you get a comfortable stay";
    
    if ($pageHero && !empty($pageHero->background_image)) {
        $heroImage = asset('storage/' . $pageHero->background_image);
        $heroCaption = $pageHero->caption ?? $heroCaption;
        $heroDescription = $pageHero->description ?? $heroDescription;
    } elseif ($about && $about->image2) {
        if (strpos($about->image2, '/') !== false || strpos($about->image2, 'abouts') === 0) {
            $heroImage = asset('storage/' . $about->image2);
        } else {
            $heroImage = asset('storage/images/about/' . $about->image2);
        }
    } else {
        $heroImage = asset('storage/images/about/default.jpg');
    }
@endphp
<div class="rts__section page__hero__height page__hero__bg" style="background-image: url({{ $heroImage }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="page__hero__content">
                    <h1 class="wow fadeInUp">{{ $heroCaption }}</h1>
                    <p class="wow fadeInUp font-sm">{{ $heroDescription }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

@php
    $hotelContact = $hotelContact ?? \App\Models\HotelContact::first();
    $googleReviewsUrl = trim((string) ($setting->google_reviews_url ?? ''));
    $tripadvisorReviewsUrl = trim((string) ($setting->tripadvisor_reviews_url ?? ''));
@endphp

<style>
    .contact-action-card { background: #fff; border: 1px solid #e9edf3; border-radius: 14px; box-shadow: 0 8px 24px rgba(16,24,40,.06); padding: 24px; }
    .contact-action-chip { display: inline-flex; align-items: center; gap: 8px; background: #eef4ff; color: #1e5fbf; border: 1px solid #d7e5ff; border-radius: 999px; padding: 6px 12px; font-size: 14px; font-weight: 600; }
    .contact-action-btn { display: inline-flex; align-items: center; justify-content: center; width: 100%; min-height: 46px; border-radius: 8px; font-weight: 600; border: 1px solid transparent; transition: .2s ease; text-decoration: none; }
    .contact-action-btn.primary { background: #165fc2; color: #fff; }
    .contact-action-btn.whatsapp { background: #22c55e; color: #fff; }
    .contact-action-btn.secondary { background: #fff; color: #165fc2; border-color: #9db7e5; }
    .contact-action-btn:hover { transform: translateY(-1px); color: inherit; }
</style>

<!-- Contact/Booking Section -->
<div class="rts__section section__padding" style="background:#f6f8fb;">
    <div class="container">
        <div class="row g-30">
            <div class="col-lg-7">
                @include('frontend.includes.booking-contact-cta', [
                    'ctaTitle' => 'We are here to help',
                    'ctaDescription' => 'For reservations we use Booking.com. For events, facilities, and special requests, contact us directly.'
                ])
            </div>
            <div class="col-lg-5">
                <div class="contact-action-card" style="padding:0; overflow:hidden;">
                    @if(!empty($setting->google_map_embed))
                        {!! $setting->google_map_embed !!}
                    @else
                        @php
                            $latitude = $hotelContact->latitude ?? '-1.9436';
                            $longitude = $hotelContact->longitude ?? '30.0641';
                        @endphp
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.497311415315!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{{ $latitude }},{{ $longitude }}!5e0!3m2!1sen!2srw!4v1234567890"
                            width="100%"
                            height="340"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    @endif
                </div>
            </div>
        </div>

        @if(!empty($googleReviewsUrl) || !empty($tripadvisorReviewsUrl))
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="mb-2" style="color:#4b5563;">Check our public guest feedback:</p>
                    @if(!empty($googleReviewsUrl))
                        <a href="{{ $googleReviewsUrl }}" target="_blank" rel="noopener noreferrer" class="theme-btn btn-style sm-btn border me-2 mb-2">
                            <span>Google Reviews</span>
                        </a>
                    @endif
                    @if(!empty($tripadvisorReviewsUrl))
                        <a href="{{ $tripadvisorReviewsUrl }}" target="_blank" rel="noopener noreferrer" class="theme-btn btn-style sm-btn border mb-2">
                            <span>Tripadvisor Reviews</span>
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Contact/Booking End -->

@endsection
