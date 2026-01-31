@extends('layouts.frontbase')

@section('content')


    <!-- page header -->
@php
    $heroImage = '';
    $heroCaption = 'Our Rooms';
    $heroDescription = 'A step up from the standard room, often with better views, more space, and additional amenities.';
    
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

    <!-- single rooms -->
    <div class="rts__section section__padding">
        <div class="container">
            <div class="row g-30 main__content sticky-wrap">
                <div class="col-xl-8 col-lg-7 order-2 order-lg-1">
                    <!-- row -->
                    <div class="row g-30">
                        <!-- single room -->
                            @foreach ($rooms as $room)
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="room__card vh-100">
                                    <div class="room__card__top">
                                        <div class="room__card__image">
                                            <a href="{{ route('room',['slug'=>$room->slug]) }}">
                                                <img src="{{ asset('storage/' . ($room->cover_image ?? 'rooms/default.jpg')) }}" width="420" height="310" alt="{{ $room->title ?? 'room card' }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="room__card__meta">
                                        <a href="{{ route('room',['slug'=>$room->slug]) }}" class="room__card__title h5">{{ $room->title }}</a>
                                        <div class="room__card__meta__info">
                                            <p class="font-sm">{!! Str::words($room->description, 30, '...') !!}</p>
                                        </div>
                                        <div class="room__price__tag">
                                            <span class="h6 d-block">{{ $room->price }}{{ $room->price > 200 ? '/Month' : '/Night' }}</span>
                                        </div>
                                        <a href="{{ route('room',['slug'=>$room->slug]) }}" class="room__card__link">Discover More</a>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <!-- single room end -->

                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 order-1 order-lg-2 mb-5 mb-lg-0 sticky-item">
                    <div class="rts__booking__form has__background no__shadow">
                        <form action="#" method="post" class="advance__search">
                            <h5>Book Your Stay</h5>
                            <div class="advance__search__wrapper">
                                <!-- single input -->
                                <div class="query__input wow fadeInUp">
                                    <label for="check__in" class="query__label">Check In</label>
                                    <div class="query__input__position">
                                        <input type="text" id="check__in" name="check__in" placeholder="15 Jun 2024" required>
                                        <div class="query__input__icon">
                                            <i class="flaticon-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- single input end -->

                                <!-- single input -->
                                <div class="query__input wow fadeInUp" data-wow-delay=".3s">
                                    <label for="check__out" class="query__label">Check Out</label>
                                    <div class="query__input__position">
                                        <input type="text" id="check__out" name="check__out" placeholder="15 May 2024" required>
                                        <div class="query__input__icon">
                                            <i class="flaticon-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- single input end -->

                                <!-- single input -->
                                <div class="query__input wow fadeInUp" data-wow-delay=".4s">
                                    <label for="adult" class="query__label">Adult</label>
                                    <input type="text" name="child" id="child" class="form-input">
                                </div>
                                <!-- single input end -->

                                <!-- single input -->
                                <div class="query__input wow fadeInUp" data-wow-delay=".5s">
                                    <label for="child" class="query__label">Child</label>
                                        <input type="text" name="child" id="child" class="form-input">
                                </div>
                                <!-- single input end -->
                                <!-- submit button -->
                                <button class="theme-btn btn-style fill no-border search__btn wow fadeInUp" data-wow-delay=".6s">
                                    <span><i class="flaticon-search-1"></i> Search</span>
                                </button>
                                <!-- submit button end -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('frontend.includes.rooms')

@endsection