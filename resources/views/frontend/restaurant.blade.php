@extends('layouts.frontbase')

@section('content')


<section class="page-header bg--cover" style="background-image: url(images/slider-1.jpg)">
    <div class="container">
      <div class="page-header__content text-center">
        <h2>{{$restaurant->title}}</h2>

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
                              {{-- <li><img src="{{ asset('storage/images/' .$restaurant->image) }}" alt="Bed in Apartment" style="height:550px"></li> --}}
                            @foreach($images as $image)
                                <li><img src="{{ asset('storage/images/restaurant/' .$image->image) }}" alt="Bed in Apartment" style="height:550px"></li>
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
                  <p>{!!$restaurant->description!!}</p>
                  <h4><strong>Garden</strong></h4>
                  <p>{!!$restaurant->description!!}</p>
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
                        'ctaTitle' => 'Book dining stay',
                        'ctaDescription' => 'Reserve your stay through Booking.com and contact us directly for dining arrangements.'
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