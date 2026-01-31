@extends('layouts.frontbase')

@section('content')


@php
    $heroImage = '';
    $heroCaption = 'Our Facilities';
    $heroDescription = '';
    
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
<section class="page-header bg--cover" style="background-image: url({{ $heroImage }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
      <div class="page-header__content text-center">
        <h2>{{ $heroCaption }}</h2>
        @if($heroDescription)
            <p>{{ $heroDescription }}</p>
        @endif
      </div>
    </div>
  </section>

@include('frontend.includes.facilities')
</div>


@endsection