@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
@php
    $roomHeroImage = '';
    if ($room && $room->cover_image) {
        $roomHeroImage = asset('storage/' . $room->cover_image);
    } elseif ($about && $about->image2) {
        if (strpos($about->image2, '/') !== false || strpos($about->image2, 'abouts') === 0) {
            $roomHeroImage = asset('storage/' . $about->image2);
        } else {
            $roomHeroImage = asset('storage/images/about/' . $about->image2);
        }
    } else {
        $roomHeroImage = asset('storage/images/about/default.jpg');
    }
@endphp
<div class="rts__section page__hero__height page__hero__bg" style="background-image: url({{ $roomHeroImage }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="page__hero__content">
                    <h1 class="wow fadeInUp">{{ $room->title }}</h1>
                    <p class="wow fadeInUp font-sm">Experience luxury and comfort in our beautifully designed room</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Room Details Area -->
<div class="rts__section section__padding">
    <div class="container">
        <div class="row g-5 sticky-wrap">
            <!-- Room Images Carousel (Right Side) -->
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="room__details">
                    @php
                        // Combine cover image with gallery images
                        $allImages = collect();
                        if ($room->cover_image) {
                            $allImages->push((object)['image' => $room->cover_image, 'is_cover' => true]);
                        }
                        if ($images && count($images) > 0) {
                            foreach ($images as $img) {
                                $allImages->push((object)['image' => $img->image, 'is_cover' => false]);
                            }
                        }
                    @endphp
                    @if($allImages->count() > 0)
                        <div class="image-gallery-wrapper mb-4">
                            <!-- Main Image Display -->
                            <div class="gallery-main-image">
                                <img id="roomMainImage" 
                                     src="{{ asset('storage/' . $allImages->first()->image) }}" 
                                     alt="{{ $room->title }} - Main Image"
                                     loading="eager"
                                     class="gallery-main-img">
                            </div>
                            
                            <!-- Thumbnail Gallery -->
                            @if($allImages->count() > 1)
                                <div class="gallery-thumbnails">
                                    @foreach($allImages as $key => $img)
                                        <div class="thumbnail-item {{ $key === 0 ? 'active' : '' }}" 
                                             data-image="{{ asset('storage/' . $img->image) }}"
                                             data-index="{{ $key }}">
                                            <img src="{{ asset('storage/' . $img->image) }}" 
                                                 alt="{{ $room->title }} - Thumbnail {{ $key + 1 }}"
                                                 loading="lazy"
                                                 class="thumbnail-img">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="room__feature__image mb-10" style="border-radius: 10px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.15);">
                            <img class="rounded-2" 
                                 src="{{ asset('storage/' . ($room->cover_image ?? 'rooms/default.jpg')) }}" 
                                 alt="Main Room Image"
                                 loading="eager"
                                 style="width: 100%; height: 550px; object-fit: cover;">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Room Details (Left Side) -->
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="room__details">
                    <div class="d-flex justify-content-between align-items-center mb-30">
                        <h2 class="room__title">{{ $room->title }}</h2>
                        <span class="h4 price" style="color: #2176af; font-weight: 600;">
                            ${{ number_format($room->price, 0) }}/Night
                        </span>
                    </div>

                    <!-- Room Info -->
                    <div class="mb-30" style="display: flex; gap: 30px; padding: 20px; background: #f9f9f9; border-radius: 8px;">
                        @if($room->max_occupancy)
                        <div>
                            <i class="fas fa-users" style="color: #2176af; font-size: 20px;"></i>
                            <p class="mb-0 mt-2"><strong>Max Guests:</strong> {{ $room->max_occupancy }}</p>
                        </div>
                        @endif
                        @if($room->bed_count)
                        <div>
                            <i class="fas fa-bed" style="color: #2176af; font-size: 20px;"></i>
                            <p class="mb-0 mt-2"><strong>Beds:</strong> {{ $room->bed_count }} {{ $room->bed_type ?? '' }}</p>
                        </div>
                        @endif
                        @if($room->room_number)
                        <div>
                            <i class="fas fa-door-open" style="color: #2176af; font-size: 20px;"></i>
                            <p class="mb-0 mt-2"><strong>Room #:</strong> {{ $room->room_number }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Amenities -->
                    @if($amenities && $amenities->count() > 0)
                    <div class="mb-30">
                        <h4 class="mb-20">Room Amenities</h4>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            @foreach($amenities as $amenity)
                                <div style="display: flex; align-items: center; padding: 8px; background: #f9f9f9; border-radius: 5px;">
                                    <span style="margin-right: 8px; color: #2176af;">✓</span>
                                    {{ $amenity->title }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Description -->
                    <div class="mb-30">
                        <h4 class="mb-20">Description</h4>
                        <div style="line-height: 1.8; color: #666;">
                            {!! $room->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Form Section -->
        <div class="row mt-50" id="booking">
            <div class="col-lg-8 mx-auto">
                <div class="rts__booking__form has__background" style="padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <h3 class="mb-30 text-center">Book This Room</h3>
                    <form action="{{ route('bookNow') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="row g-20">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Check In <span class="text-danger">*</span></label>
                                <input type="date" 
                                       id="checkin_date" 
                                       name="checkin" 
                                       class="form-control" 
                                       required 
                                       min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Check Out <span class="text-danger">*</span></label>
                                <input type="date" 
                                       id="checkout_date" 
                                       name="checkout" 
                                       class="form-control" 
                                       required 
                                       min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adults <span class="text-danger">*</span></label>
                                <input type="number" 
                                       id="adults" 
                                       name="adults" 
                                       class="form-control" 
                                       min="1" 
                                       value="1" 
                                       required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children</label>
                                <input type="number" 
                                       id="children" 
                                       name="children" 
                                       class="form-control" 
                                       min="0" 
                                       value="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="names" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Number of Rooms</label>
                                <input type="number" name="rooms" class="form-control" min="1" value="1">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Special Requests</label>
                                <textarea name="message" class="form-control" rows="3" placeholder="Any special requests or notes..."></textarea>
                            </div>
                            
                            <!-- Price Calculation Display -->
                            <div class="col-12 mb-3" style="background: #f9f9f9; padding: 20px; border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span><strong>Room Price per Night:</strong></span>
                                    <span id="room_price">${{ number_format($room->price, 2) }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span><strong>Number of Nights:</strong></span>
                                    <span id="nights_count">0</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-top: 10px; border-top: 2px solid #ddd;">
                                    <span><strong>Subtotal:</strong></span>
                                    <span id="subtotal">$0.00</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span>Tax (10%):</span>
                                    <span id="tax">$0.00</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding-top: 10px; border-top: 2px solid #2176af; font-size: 18px; font-weight: 600;">
                                    <span><strong>Total Amount:</strong></span>
                                    <span id="total_amount" style="color: #2176af;">$0.00</span>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="theme-btn btn-style fill" style="width: 100%; padding: 15px; font-size: 18px;">
                                    <span>Complete Booking</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Room Details End -->

<!-- Similar Rooms -->
@if($allRooms && $allRooms->count() > 0)
<div class="rts__section" style="padding: 80px 0; background-color: #f9f9f9;">
    <div class="container">
        <div class="row justify-content-center text-center mb-40">
            <div class="col-lg-6">
                <div class="section__topbar">
                    <h2>Similar Rooms</h2>
                </div>
            </div>
        </div>
        <div class="row g-30">
            @foreach ($allRooms as $similarRoom)
            <div class="col-lg-4 col-md-6">
                <div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 3px 10px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <div>
                        <a href="{{ route('room',['slug'=>$similarRoom->slug]) }}">
                            <img src="{{ asset('storage/images/rooms/' . ($similarRoom->cover_image ?? $similarRoom->image ?? 'default.jpg')) }}" 
                                 alt="{{ $similarRoom->title }}" 
                                 style="width: 100%; height: 250px; object-fit: cover;">
                        </a>
                    </div>
                    <div style="padding: 20px;">
                        <a href="{{ route('room',['slug'=>$similarRoom->slug]) }}" 
                           style="font-size: 20px; font-weight: 600; color: #222; text-decoration: none; display: block; margin-bottom: 10px;">
                            {{ $similarRoom->title }}
                        </a>
                        <div style="font-size: 18px; font-weight: bold; color: #2176af; margin-bottom: 15px;">
                            ${{ number_format($similarRoom->price, 0) }}/Night
                        </div>
                        <a href="{{ route('room',['slug'=>$similarRoom->slug]) }}" 
                           class="theme-btn btn-style sm-btn fill" 
                           style="width: 100%; text-align: center;">
                            <span>View Details</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Similar Rooms End -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('checkin_date');
    const checkoutInput = document.getElementById('checkout_date');
    const roomPrice = {{ $room->price }};
    const subtotalEl = document.getElementById('subtotal');
    const taxEl = document.getElementById('tax');
    const totalEl = document.getElementById('total_amount');
    const nightsEl = document.getElementById('nights_count');

    function calculateTotal() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        
        if (checkin && checkout && checkout > checkin) {
            const diffTime = Math.abs(checkout - checkin);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const nights = diffDays;
            
            nightsEl.textContent = nights + ' night' + (nights !== 1 ? 's' : '');
            
            const subtotal = roomPrice * nights;
            const tax = subtotal * 0.10;
            const total = subtotal + tax;
            
            subtotalEl.textContent = '$' + subtotal.toFixed(2);
            taxEl.textContent = '$' + tax.toFixed(2);
            totalEl.textContent = '$' + total.toFixed(2);
        } else {
            nightsEl.textContent = '0';
            subtotalEl.textContent = '$0.00';
            taxEl.textContent = '$0.00';
            totalEl.textContent = '$0.00';
        }
    }

    checkinInput.addEventListener('change', function() {
        if (checkoutInput.value) {
            checkoutInput.min = this.value;
            calculateTotal();
        }
    });

    checkoutInput.addEventListener('change', function() {
        if (checkinInput.value) {
            if (this.value <= checkinInput.value) {
                alert('Check-out date must be after check-in date');
                this.value = '';
                return;
            }
            calculateTotal();
        }
    });
});

// Image Gallery Functionality
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('roomMainImage');
    const thumbnails = document.querySelectorAll('.gallery-thumbnails .thumbnail-item');
    
    if (mainImage && thumbnails.length > 0) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const newImageSrc = this.getAttribute('data-image');
                
                // Remove active class from all thumbnails
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                
                // Add active class to clicked thumbnail
                this.classList.add('active');
                
                // Fade out main image
                mainImage.style.opacity = '0';
                
                // After fade out, change image and fade in
                setTimeout(() => {
                    mainImage.src = newImageSrc;
                    mainImage.style.opacity = '1';
                }, 200);
            });
        });
    }
});
</script>

<style>
/* Image Gallery Styles */
.image-gallery-wrapper {
    width: 100%;
}

.gallery-main-image {
    width: 100%;
    margin-bottom: 15px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    background: #f8f9fa;
    position: relative;
    aspect-ratio: 16/10;
}

.gallery-main-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: opacity 0.4s ease-in-out;
    opacity: 1;
}

.gallery-thumbnails {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    padding: 5px 0;
    scrollbar-width: thin;
    scrollbar-color: rgba(0, 0, 0, 0.3) transparent;
}

.gallery-thumbnails::-webkit-scrollbar {
    height: 6px;
}

.gallery-thumbnails::-webkit-scrollbar-track {
    background: transparent;
}

.gallery-thumbnails::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.3);
    border-radius: 3px;
}

.thumbnail-item {
    flex: 0 0 auto;
    width: 100px;
    height: 100px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    position: relative;
    background: #f8f9fa;
}

.thumbnail-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.thumbnail-item.active {
    border-color: #2176af;
    box-shadow: 0 0 0 2px rgba(33, 118, 175, 0.2), 0 4px 12px rgba(33, 118, 175, 0.3);
}

.thumbnail-item.active::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(33, 118, 175, 0.1);
    pointer-events: none;
}

.thumbnail-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.thumbnail-item:hover .thumbnail-img {
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .gallery-main-image {
        aspect-ratio: 4/3;
    }
    
    .thumbnail-item {
        width: 80px;
        height: 80px;
    }
    
    .gallery-thumbnails {
        gap: 8px;
    }
}

@media (max-width: 576px) {
    .thumbnail-item {
        width: 70px;
        height: 70px;
    }
}
</style>

@endsection
