@extends('layouts.frontbase')

@section('content')


    <!-- page header -->
@php
    $heroImage = '';
    $isApartmentPage = ($activeType ?? 'room') === 'apartment';
    $heroCaption = $isApartmentPage ? 'Our Apartments' : 'Our Rooms';
    $heroDescription = $isApartmentPage
        ? 'Apartments with one and two rooms, ideal for longer stays and families who need more space and privacy.'
        : 'A step up from the standard room, often with better views, more space, and additional amenities.';
    
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
    <!-- page header end -->

    <!-- Toggle between rooms and apartments -->
    <div class="rts__section pt-60 pb-0">
        <div class="container">
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="{{ route('rooms') }}"
                   class="btn btn-sm {{ ($activeType ?? 'room') === 'room' ? 'btn-primary' : 'btn-outline-primary' }}">
                    View Rooms
                </a>
                <a href="{{ route('apartments') }}"
                   class="btn btn-sm {{ ($activeType ?? 'room') === 'apartment' ? 'btn-primary' : 'btn-outline-primary' }}">
                    View Apartments
                </a>
            </div>
        </div>
    </div>

    <!-- rooms grid: image, title, price/Night, short description, View details (no booking form on listing) -->
    <div class="rts__section section__padding pt-40">
        <div class="container">
            <div class="row g-4">
                @foreach ($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="room__card h-100 d-flex flex-column rounded-3 overflow-hidden shadow-sm" style="background: #fff; border: 1px solid #eee;">
                        <div class="room__card__top flex-grow-0">
                            <div class="room__card__image">
                                <a href="{{ route('room', ['slug' => $room->slug]) }}">
                                    <img src="{{ asset('storage/' . ($room->cover_image ?? 'rooms/default.jpg')) }}" width="420" height="280" alt="{{ $room->title ?? 'Room' }}" loading="lazy" style="width: 100%; height: 280px; object-fit: cover;">
                                </a>
                            </div>
                        </div>
                        <div class="room__card__meta p-4 d-flex flex-column flex-grow-1">
                            <a href="{{ route('room', ['slug' => $room->slug]) }}" class="room__card__title h5 mb-2 text-dark text-decoration-none">{{ $room->title }}</a>
                            <div class="room__price__tag mb-2">
                                <span class="h5 text-primary">${{ number_format($room->price ?? 0, 0) }}/Night</span>
                            </div>
                            <div class="room__card__meta__info mb-3 flex-grow-1">
                                <p class="font-sm text-muted mb-0">{!! Str::words(strip_tags($room->description ?? ''), 20, '...') !!}</p>
                            </div>
                            <a href="{{ route('room', ['slug' => $room->slug]) }}#booking" class="theme-btn btn-style fill align-self-start">
                                <span>View details &amp; Book</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@include('frontend.includes.rooms')

@endsection