@extends('layouts.frontbase')

@section('content')

<section class="page-header bg--cover" style="background-image: url(images/slider-1.jpg)">
    <div class="container">
      <div class="page-header__content text-center">
        <h2>{{$event->title}}</h2>

      </div>
    </div>
</section>
<section class="room padding-top padding-bottom">
    <div class="container">
      <div class="room__wrapper">
        <div class="row g-5">
          <div class="col-lg-8">
            <div class="room__details">
              <div class="room__details-image">
                  <div class="wrapper-full">
                    <div class="widget-carousel">
                      <div id="wrapper">
                        <div class="callbacks_container">
                          <ul class="rslides" id="slider1">            
                            @foreach($images as $image)
                                <li><img src="{{ asset('storage/images/events/' .$image->image) }}" alt="Bed in Apartment" style="height:550px"></li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>                
                  </div>
                </div>
              <div class="room__details-content">
                <h3>Events</h3>
                <div class="room__details-text">
                    <p>{!!$event->description!!}</p>
                </div>
              </div>
            </div>            
          </div>

          <div class="col-lg-4 col-md-8">
            <aside>
              <div class="widget widget-booking">
                <div class="booking__wrapper booking__wrapper--has-shadow bg-section-color">
                  <div class="row">
                    <div class="col-12">
                      @include('frontend.includes.booking-contact-cta', [
                        'ctaTitle' => 'Book your event stay',
                        'ctaDescription' => 'For event-related stays, complete your reservation on Booking.com or reach us directly.'
                      ])
                   </div>
                  </div>
                </div>
              </div>

            </aside>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection