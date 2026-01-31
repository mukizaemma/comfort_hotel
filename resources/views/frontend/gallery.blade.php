@extends('layouts.frontbase')

@section('content')


@php
    $heroImage = '';
    $heroCaption = 'Gallery';
    $heroDescription = 'where every image tells a story of luxury, comfort, and unparalleled hospitality';
    
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


        <!-- gallery -->
    <div class="rts__section section__padding">
        <div class="container">
            <div class="row g-30 gallery">
              @foreach ($gallery as $image)
                  <div class="col-lg-6 col-md-6">
                    <div class="gallery__item">
                        <a href="{{ asset('storage/images/gallery/' . $image->image) }}" class="gallery__link">
                            <img class="rounded-2 img-fluid" src="{{ asset('storage/images/gallery/' . $image->image) }}" alt="gallery">
                        </a>
                    </div>
                </div>
              @endforeach


            </div>
        </div>
    </div>
    <!-- gallery end -->


@endsection