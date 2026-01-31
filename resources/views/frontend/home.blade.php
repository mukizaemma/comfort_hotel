@extends('layouts.frontbase')

@section('content')

<!-- Animated Slideshow Section -->
@include('frontend.includes.slides')
<!-- Slideshow End -->

<!-- About Us Section -->
<div class="rts__section about__area is__home__main section__padding" id="background" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f0f4f8 100%); position: relative; overflow: hidden;">
    <!-- Decorative Background Elements -->
    <div class="about__decorative-bg" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.03; pointer-events: none;">
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, #2176af 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -100px; left: -100px; width: 400px; height: 400px; background: radial-gradient(circle, #2176af 0%, transparent 70%); border-radius: 50%;"></div>
    </div>
    

    
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="about__content-wrapper" style="background: white; border-radius: 20px; padding: 20px 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.08), 0 2px 10px rgba(0,0,0,0.05); position: relative; overflow: hidden;">
                    <!-- Decorative Accent Line -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #2176af 0%, #1a5d8a 50%, #2176af 100%);"></div>
                    
                    <!-- Content -->
                    <div class="text-center" style="max-width: 900px; margin: 0 auto;">
                        
                        <!-- Title -->
                        <h2 class="wow fadeInUp" data-wow-delay=".2s" style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 600; color: #1a1a1a; margin-bottom: 20px; line-height: 1.3; font-family: 'Gilda Display', serif;">
                            Welcome To <span style="color: #2176af; position: relative;">
                                {{ $setting->company ?? 'Our Hotel' }}
                                <span style="position: absolute; bottom: -5px; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent 0%, #2176af 20%, #2176af 80%, transparent 100%); opacity: 0.3;"></span>
                            </span>
                        </h2>
                        
                        <!-- Decorative Divider -->
                        <div class="wow fadeInUp" data-wow-delay=".3s" style="margin: 30px auto; width: 80px; height: 4px; background: linear-gradient(90deg, transparent 0%, #2176af 50%, transparent 100%); border-radius: 2px;"></div>
                        
                        <!-- Description -->
                        <div class="wow fadeInUp" data-wow-delay=".4s" style="margin-bottom: 40px;">
                            <p style="font-size: clamp(1rem, 1.5vw, 1.15rem); line-height: 1.9; color: #4a5568; text-align: center; margin: 0; font-weight: 400;">
                                {!! $about->founderDescription ?? $about->founderDescription ?? 'Experience luxury and comfort at our exceptional hotel.' !!}
                            </p>
                        </div>
                        
                        <!-- CTA Button -->
                        <div class="wow fadeInUp" data-wow-delay=".5s">
                            <a href="{{ route('about') }}" class="theme-btn btn-style fill no-border" style="display: inline-block; padding: 16px 45px; font-size: 16px; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; box-shadow: 0 6px 20px rgba(33, 118, 175, 0.3); transition: all 0.3s ease; border-radius: 8px;">
                                <span>Learn More About Us</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Decorative Corner Elements -->
                    <div style="position: absolute; top: 20px; right: 20px; width: 100px; height: 100px; border-top: 2px solid rgba(33, 118, 175, 0.1); border-right: 2px solid rgba(33, 118, 175, 0.1); border-radius: 0 20px 0 0;"></div>
                    <div style="position: absolute; bottom: 20px; left: 20px; width: 100px; height: 100px; border-bottom: 2px solid rgba(33, 118, 175, 0.1); border-left: 2px solid rgba(33, 118, 175, 0.1); border-radius: 0 0 0 20px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us End -->

<!-- Hotel Rooms Section -->
<div class="rts__section section__padding" style="background: #f9f9f9;">
    <div class="container">
        <div class="row position-relative justify-content-center text-center mb-60">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <h2 class="section__title">Our Hotel Rooms</h2>
                    <p class="font-sm">Experience comfort and luxury in our beautifully designed rooms</p>
                </div>
            </div>
        </div>
        <div class="row g-30">
            @foreach($rooms as $room)
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".{{ $loop->index * 2 }}s">
                <div class="room__card" style="height: 100%; display: flex; flex-direction: column; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <div class="room__card__top" style="height: 280px; overflow: hidden;">
                        <div class="room__card__image" style="height: 100%;">
                            <a href="{{ route('room', ['slug' => $room->slug]) }}">
                                <img src="{{ asset('storage/' . ($room->cover_image ?? 'rooms/default.jpg')) }}" 
                                     alt="{{ $room->title }}" 
                                     loading="lazy"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        </div>
                    </div>
                    <div class="room__card__meta" style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                            <a href="{{ route('room', ['slug' => $room->slug]) }}" class="room__card__title h5" style="flex: 1; margin-right: 10px;">
                                {{ $room->title }}
                            </a>
                            <span class="h6" style="color: #2176af; font-weight: 600; white-space: nowrap;">
                                ${{ number_format($room->price, 0) }}/Night
                            </span>
                        </div>
                        <div class="room__card__meta__info" style="flex: 1; margin-bottom: 15px;">
                            <p class="font-sm" style="color: #666; line-height: 1.6;">
                                {!! Str::words(strip_tags($room->description ?? ''), 20, '...') !!}
                            </p>
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: auto;">
                            <a href="{{ route('room', ['slug' => $room->slug]) }}" class="theme-btn btn-style sm-btn border" style="flex: 1; text-align: center;">
                                <span>View Details</span>
                            </a>
                            <a href="{{ route('room', ['slug' => $room->slug]) }}#booking" class="theme-btn btn-style sm-btn fill" style="flex: 1; text-align: center;">
                                <span>Book Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($rooms->count() > 6)
        <div class="row mt-40">
            <div class="col-12 text-center">
                <a href="{{ route('rooms') }}" class="theme-btn btn-style fill">
                    <span>View All Rooms</span>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Hotel Rooms End -->

    <!-- quote section (formerly video section) -->
    <div class="rts__section pb-120 video video__full" style="margin: 0; padding: 0; width: 100%; overflow: hidden; position: relative;">
        <div style="width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; padding: 0;">
            <div class="video__area position-relative wow fadeInUp" style="width: 100%; margin: 0; padding: 0;">
                <div class="video__area__image jara-mask-2 jarallax rounded-0" style="width: 100%; padding: 0; border-radius: 0; margin: 0;"> 
                    @php
                        $image2Path = '';
                        if ($about && $about->image2) {
                            if (strpos($about->image2, '/') !== false || strpos($about->image2, 'abouts') === 0) {
                                $image2Path = asset('storage/' . $about->image2);
                            } else {
                                $image2Path = asset('storage/images/about/' . $about->image2);
                            }
                        } else {
                            $image2Path = asset('storage/images/about/default.jpg');
                        }
                    @endphp
                    <img class="radius-none jarallax-img" src="{{ $image2Path }}" alt="Hotel Quote" loading="lazy" onerror="this.src='{{ asset('storage/images/about/default.jpg') }}'" style="width: 100%; height: 100%; object-fit: cover; display: block; margin: 0; padding: 0;">
                </div>
                <div class="video--spinner__wrapper" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2; width: 80%; max-width: 80%; text-align: center;">
                    <blockquote class="home-quote-block" style="margin: 0; padding: 0; width: 100%; max-width: 100%; border: none; background: transparent;">
                        <p class="home-quote-text" style="margin: 0; font-size: clamp(1.5rem, 3.5vw, 2.5rem); font-weight: 500; line-height: 1.4; color: #fff; text-shadow: 0 2px 10px rgba(0,0,0,0.5); font-style: italic; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            &ldquo;{{ $about->vision ?? 'Where luxury meets comfort, and every stay becomes a cherished memory.' }}&rdquo;
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <!-- quote section end -->

<!-- Facilities Section -->
<div class="rts__section section__padding">
    <div class="container">
        <div class="row position-relative justify-content-center text-center mb-60">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <h2 class="section__title">Our Facilities</h2>
                    <p class="font-sm">World-class amenities for your comfort and convenience</p>
                </div>
            </div>
        </div>
        <div class="row g-30">
            @foreach($homeFacilities as $facility)
            <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".{{ $loop->index * 2 }}s">
                <div class="facility__card" style="text-align: center; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <div style="margin-bottom: 20px;">
                        <img src="{{ asset('storage/' . ($facility->cover_image ?? 'facilities/default.jpg')) }}" 
                             alt="{{ $facility->title }}" 
                             loading="lazy"
                             style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                    </div>
                    <h5 style="margin-bottom: 10px;">{{ $facility->title }}</h5>
                    <p class="font-sm" style="color: #666;">
                        {!! Str::words(strip_tags($facility->description ?? ''), 15, '...') !!}
                    </p>
                    <a href="{{ route('facility', ['slug' => $facility->slug]) }}" class="theme-btn btn-style sm-btn border mt-3">
                        <span>Learn More</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-40">
            <div class="col-12 text-center">
                <a href="{{ route('facilities') }}" class="theme-btn btn-style fill">
                    <span>View All Facilities</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Facilities End -->

<!-- Updates/Blogs Section -->
@if($blogs && $blogs->count() > 0)
<div class="rts__section section__padding" style="background: #f9f9f9;">
    <div class="container">
        <div class="row position-relative justify-content-center text-center mb-60">
            <div class="col-lg-6 wow fadeInUp">
                <div class="section__topbar">
                    <h2 class="section__title">Latest Updates</h2>
                    <p class="font-sm">Stay informed with our latest news and updates</p>
                </div>
            </div>
        </div>
        <div class="row g-30">
            @foreach($blogs as $blog)
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".{{ $loop->index * 2 }}s">
                <div class="blog__card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="height: 250px; overflow: hidden;">
                        <a href="{{ route('update', ['slug' => $blog->slug]) }}">
                            <img src="{{ asset('storage/images/blogs/' . ($blog->image ?? 'default.jpg')) }}" 
                                 alt="{{ $blog->title }}" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>
                    <div style="padding: 25px;">
                        <a href="{{ route('update', ['slug' => $blog->slug]) }}" class="h5" style="display: block; margin-bottom: 15px; color: #222;">
                            {{ $blog->title }}
                        </a>
                        <p class="font-sm" style="color: #666; margin-bottom: 15px;">
                            {!! Str::words(strip_tags($blog->body ?? ''), 25, '...') !!}
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="font-sm" style="color: #999;">
                                {{ $blog->created_at->format('M d, Y') }}
                            </span>
                            <a href="{{ route('update', ['slug' => $blog->slug]) }}" class="theme-btn btn-style sm-btn border">
                                <span>Read More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-40">
            <div class="col-12 text-center">
                <a href="{{ route('updates') }}" class="theme-btn btn-style fill">
                    <span>View All Updates</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Updates End -->

<!-- Call to Action with Booking Form and Google Map -->
<div class="rts__section section__padding" style="background: #f9f9f9;">
    <div class="container">
        <div class="row g-30">
            <div class="col-lg-6 wow fadeInLeft">
                <div style="height: 500px; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
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
                <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    {{-- <h3 style="margin-bottom: 20px; color: #2176af;">Book Your Stay</h3> --}}
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

                        <div class="row">
                            <div class="col-md-8 mb-3">
                            <label for="room_id" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Select Room <span style="color: red;">*</span></label>
                            <select name="room_id" id="room_id" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                                <option value="">-- Select a Room --</option>
                                @foreach($rooms as $roomOption)
                                    <option value="{{ $roomOption->id }}">{{ $roomOption->title }} - ${{ number_format($roomOption->price, 0) }}/Night</option>
                                @endforeach
                            </select>

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="adults" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Adults <span style="color: red;">*</span></label>
                                <input type="number" name="adults" id="adults" class="form-control" required min="1" value="1" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>
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

                        <div class="form-group mb-3">
                            <label for="names" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Full Name <span style="color: red;">*</span></label>
                            <input type="text" name="names" id="names" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Phone <span style="color: red;">*</span></label>
                            <input type="tel" name="phone" id="phone" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>
                            <div class="col-md-6 mb-3">
                            <label for="email" class="form-label" style="font-weight: 600; margin-bottom: 8px;">Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required style="padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>
                        </div>


                        <div class="form-group mb-3">
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
<!-- Call to Action End -->

@endsection
