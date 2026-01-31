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

<!-- Contact Section -->
<div class="rts__section section__padding">
    <div class="container">
        <div class="row g-30">
            <!-- Hotel Contact Information -->
            <div class="col-lg-4">
                <div style="background: #f9f9f9; padding: 40px; border-radius: 10px; height: 100%;">
                    <h3 class="mb-30">Hotel Contact Information</h3>
                    
                    @php
                        $hotelContact = \App\Models\HotelContact::first();
                    @endphp
                    
                    <div style="margin-bottom: 30px;">
                        <div style="display: flex; align-items: start; margin-bottom: 20px;">
                            <i class="flaticon-phone-flip" style="font-size: 24px; color: #2176af; margin-right: 15px; margin-top: 5px;"></i>
                            <div>
                                <h5 style="margin-bottom: 5px;">Phone</h5>
                                <p class="mb-0">
                                    <a href="tel:{{ $hotelContact->phone ?? $setting->phone ?? '' }}" style="color: #666; text-decoration: none;">
                                        {{ $hotelContact->phone ?? $setting->phone ?? 'N/A' }}
                                    </a>
                                </p>
                                @if($hotelContact && $hotelContact->whatsapp)
                                <p class="mb-0 mt-2">
                                    <a href="https://wa.me/{{ $hotelContact->whatsapp }}" target="_blank" style="color: #25D366; text-decoration: none;">
                                        <i class="fab fa-whatsapp"></i> WhatsApp: {{ $hotelContact->whatsapp }}
                                    </a>
                                </p>
                                @endif
                            </div>
                        </div>

                        <div style="display: flex; align-items: start; margin-bottom: 20px;">
                            <i class="flaticon-envelope" style="font-size: 24px; color: #2176af; margin-right: 15px; margin-top: 5px;"></i>
                            <div>
                                <h5 style="margin-bottom: 5px;">Email</h5>
                                <p class="mb-0">
                                    <a href="mailto:{{ $hotelContact->email ?? $setting->email ?? '' }}" style="color: #666; text-decoration: none;">
                                        {{ $hotelContact->email ?? $setting->email ?? 'N/A' }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: start; margin-bottom: 20px;">
                            <i class="flaticon-marker" style="font-size: 24px; color: #2176af; margin-right: 15px; margin-top: 5px;"></i>
                            <div>
                                <h5 style="margin-bottom: 5px;">Address</h5>
                                <p class="mb-0" style="color: #666; line-height: 1.6;">
                                    @if($hotelContact)
                                        {{ $hotelContact->address ?? '' }}<br>
                                        @if($hotelContact->city){{ $hotelContact->city }}, @endif
                                        @if($hotelContact->country){{ $hotelContact->country }}@endif
                                        @if($hotelContact->postal_code) - {{ $hotelContact->postal_code }}@endif
                                    @else
                                        {{ $setting->address ?? 'N/A' }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if($hotelContact && $hotelContact->website)
                        <div style="display: flex; align-items: start;">
                            <i class="fas fa-globe" style="font-size: 24px; color: #2176af; margin-right: 15px; margin-top: 5px;"></i>
                            <div>
                                <h5 style="margin-bottom: 5px;">Website</h5>
                                <p class="mb-0">
                                    <a href="{{ $hotelContact->website }}" target="_blank" style="color: #666; text-decoration: none;">
                                        {{ $hotelContact->website }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Social Media -->
                    <div class="mt-40">
                        <h5 class="mb-20">Follow Us</h5>
                        <div style="display: flex; gap: 10px;">
                            @if($hotelContact && $hotelContact->facebook)
                            <a href="{{ $hotelContact->facebook }}" target="_blank" 
                               style="display: inline-flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: #1877F2; color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if($hotelContact && $hotelContact->instagram)
                            <a href="{{ $hotelContact->instagram }}" target="_blank" 
                               style="display: inline-flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                            @if($hotelContact && $hotelContact->twitter)
                            <a href="{{ $hotelContact->twitter }}" target="_blank" 
                               style="display: inline-flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: #1DA1F2; color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            @endif
                            @if($hotelContact && $hotelContact->linkedin)
                            <a href="{{ $hotelContact->linkedin }}" target="_blank" 
                               style="display: inline-flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: #0077B5; color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Enquiry Form -->
            <div class="col-lg-8">
                <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                    <h3 class="mb-30">General Enquiry Form</h3>
                    <p class="font-sm mb-30" style="color: #666;">
                        If it's easier for you, feel free to use the form below to give us an idea of what you're looking for.
                    </p>
                    <form action="{{ route('bookNow') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row g-20">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="names" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="What is this regarding?">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Your Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="6" required placeholder="Tell us how we can help you..."></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="g-recaptcha" data-sitekey="6Lc-PHYrAAAAAGgl1VaQ32ICNEhtBag3vQtchlFJ"></div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="theme-btn btn-style fill" style="width: 100%; padding: 15px; font-size: 18px;">
                                    <span>Send Message</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Google Map -->
        <div class="row mt-60">
            <div class="col-12">
                <h3 class="mb-30">Find Us on Map</h3>
                <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); min-height: 460px;">
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
                            height="460" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
