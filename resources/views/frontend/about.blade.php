@extends('layouts.frontbase')

@section('content')

<!-- About Us Hero Section -->
@php
    $heroImage = '';
    $heroCaption = 'About Us';
    $heroDescription = 'Discover our story, values, and commitment to excellence';
    
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
<div class="rts__section page__hero__height page__hero__bg" style="background-image: url({{ $heroImage }}); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 300px; display: flex; align-items: center; position: relative;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(33, 118, 175, 0.3) 0%, rgba(26, 93, 138, 0.342) 100%); z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 text-center">
                    <div class="page__hero__content">
                    <h1 class="wow fadeInUp" style="color: white; font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 15px;">{{ $heroCaption }}</h1>
                    <p class="wow fadeInUp font-sm" style="color: rgba(255,255,255,0.9); font-size: 1.1rem;">{{ $heroDescription }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Us Main Section -->
<div class="rts__section section__padding" style="background: #ffffff;">
        <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft">
                <div class="about__images" style="position: relative;">
                    @php
                        $aboutImage1 = '';
                        if ($about && $about->image1) {
                            // New format from ContentManagementController: 'abouts/filename.jpg'
                            if (strpos($about->image1, '/') !== false || strpos($about->image1, 'abouts') === 0) {
                                $aboutImage1 = asset('storage/' . $about->image1);
                            } 
                            // Old format from SettingsController: just 'filename.jpg'
                            else {
                                $aboutImage1 = asset('storage/images/about/' . $about->image1);
                            }
                        } else {
                            $aboutImage1 = asset('storage/images/about/default.jpg');
                        }
                    @endphp
                    <div class="image__left" style="border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                        <img src="{{ $aboutImage1 }}" alt="About Us" style="width: 100%; height: auto; display: block;" loading="eager">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight">
                    <div class="about__content">
                    <h2 class="font-xl" style="font-size: clamp(2rem, 4vw, 2.5rem); margin-bottom: 25px; color: #1a1a1a; font-family: 'Gilda Display', serif;">
                        Welcome To {{ $setting->company ?? 'Our Hotel' }}
                    </h2>
                    <div class="font-sm mt-30" style="font-size: 1.05rem; line-height: 1.9; color: #4a5568;">
                        {!! $about->founderDescription ?? 'Experience luxury and comfort at our exceptional hotel.' !!}
                    </div>
                    @if($about->mission || $about->vision)
                    <div class="row g-4 mt-40">
                        @if($about->mission)
                        <div class="col-md-6">
                            <div style="background: #f8f9fa; padding: 25px; border-radius: 10px; border-left: 4px solid #2176af;">
                                <h5 style="color: #2176af; margin-bottom: 15px; font-weight: 600;">Our Mission</h5>
                                <p style="color: #666; margin: 0; line-height: 1.7;">{!! Str::words($about->mission, 25, '...') !!}</p>
                            </div>
                        </div>
                        @endif
                        @if($about->vision)
                        <div class="col-md-6">
                            <div style="background: #f8f9fa; padding: 25px; border-radius: 10px; border-left: 4px solid #2176af;">
                                <h5 style="color: #2176af; margin-bottom: 15px; font-weight: 600;">Our Vision</h5>
                                <p style="color: #666; margin: 0; line-height: 1.7;">{!! Str::words($about->vision, 25, '...') !!}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Team Section -->
<div class="rts__section section__padding" style="background: #ffffff;">
    <div class="container">
        <div class="row position-relative justify-content-center text-center mb-60">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <h2 class="section__title">Our Team</h2>
                    <p class="font-sm">Meet the dedicated professionals who make your stay memorable</p>
                </div>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-12 text-center">
                <div style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 60px 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <div style="max-width: 700px; margin: 0 auto;">
                        <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #2176af 0%, #1a5d8a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; box-shadow: 0 8px 20px rgba(33, 118, 175, 0.3);">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26 15 3.41 18.13 3.41 22" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.8rem; margin-bottom: 15px; color: #1a1a1a; font-family: 'Gilda Display', serif;">Our Dedicated Team</h3>
                        <p style="font-size: 1.05rem; line-height: 1.8; color: #666; margin-bottom: 0;">
                            Our team of experienced hospitality professionals is committed to providing you with exceptional service and creating unforgettable experiences during your stay. From our front desk staff to our housekeeping team, every member is dedicated to ensuring your comfort and satisfaction.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Google Map & Booking Form Section -->
<div class="rts__section section__padding" style="background: #f9f9f9;">
        <div class="container">
        <div class="row position-relative justify-content-center text-center mb-60">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <h2 class="section__title">Find Us & Book Your Stay</h2>
                    <p class="font-sm">Visit us or reserve your room directly</p>
                        </div>
                        </div>
                    </div>
        <div class="row g-4">
            <div class="col-lg-6 wow fadeInLeft">
                <div style="height: 600px; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    @if(!empty($setting->google_map_embed))
                        {!! $setting->google_map_embed !!}
                    @else
                        @php
                            $hotelContact = \App\Models\HotelContact::first();
                            $latitude = $hotelContact->latitude ?? '-1.9441';
                            $longitude = $hotelContact->longitude ?? '30.0619';
                        @endphp
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.497311415315!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{{ $latitude }},{{ $longitude }}!5e0!3m2!1sen!2srw!4v1234567890"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight">
                <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%;">
                    <h3 style="margin-bottom: 20px; color: #2176af; font-family: 'Gilda Display', serif;">Book Your Stay</h3>
                    <p class="font-sm" style="margin-bottom: 30px; color: #666;">
                        Reserve your perfect room today and experience luxury hospitality at its finest.
                    </p>
                    @if(session('success'))
                        <div class="alert alert-success" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
                            {{ session('success') }}
                                    </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
                            {{ session('error') }}
                                            </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                                                </div>
                    @endif
                    <form action="{{ route('bookNow') }}" method="POST" class="booking__form">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="room_id" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Select Room <span style="color: red;">*</span></label>
                            <select name="room_id" id="room_id" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                <option value="">-- Select a Room --</option>
                                @foreach($allRooms as $roomOption)
                                    <option value="{{ $roomOption->id }}">{{ $roomOption->title }} - ${{ number_format($roomOption->price, 0) }}/Night</option>
                                @endforeach
                            </select>
                                            </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="checkin" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Check-In Date <span style="color: red;">*</span></label>
                                <input type="date" name="checkin" id="checkin" class="form-control" required min="{{ date('Y-m-d') }}" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                        </div>
                            <div class="col-md-6 mb-3">
                                <label for="checkout" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Check-Out Date <span style="color: red;">*</span></label>
                                <input type="date" name="checkout" id="checkout" class="form-control" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                    </div>
                                </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="adults" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Adults <span style="color: red;">*</span></label>
                                <input type="number" name="adults" id="adults" class="form-control" required min="1" value="1" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="children" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Children</label>
                                <input type="number" name="children" id="children" class="form-control" min="0" value="0" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                                </div>
                                            </div>
                        <div class="form-group mb-3">
                            <label for="names" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Full Name <span style="color: red;">*</span></label>
                            <input type="text" name="names" id="names" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                    </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Phone <span style="color: red;">*</span></label>
                            <input type="tel" name="phone" id="phone" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                </div>
                        <div class="form-group mb-4">
                            <label for="message" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Special Requests</label>
                            <textarea name="message" id="message" class="form-control" rows="3" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;"></textarea>
                        </div>
                        <button type="submit" class="theme-btn btn-style fill w-100" style="padding: 15px; font-size: 16px; font-weight: 600;">
                            <span>Submit Booking Request</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
