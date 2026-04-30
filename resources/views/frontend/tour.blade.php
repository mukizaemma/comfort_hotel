@extends('layouts.frontbase')
<base href="/public">
@section('content')

<section class="page-header bg--cover" style="background-image: url(images/slider-1.jpg)">
    <div class="container">
      <div class="page-header__content text-center">
        <h2>{{$tour->title ?? ''}}</h2>

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
                            <li><img src="{{ asset('storage/images/trips/' .$tour->image) }}" alt="{{ $tour->caption ?? '' }}"  style="height:550px"></li>
                            @foreach($images as $image)
                            <li><img src="{{ asset('storage/images/trips/' .$tour->image) }}" alt="{{ $tour->caption ?? '' }}" style="height:550px"></li>
                        @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>                
                  </div>
                </div>
              <div class="room__details-content">
                <h3>{{ $tour->title }}</h3>
                <div class="room__details-text">
                  <p>
                    {!! $tour->description !!}
                  </p>
                </div>
                <div class="room__amenities mt-2">
                  <div class="room__amenities-content">
                    <h4 style="padding-bottom:5px; font-size:24px">Overview</h4>
                    <ul class="team-single__staff-info">
                  <li class="team-single__staff-infoitem">
                    <p class="team-single__staff-infoname">Location</p>
                    <p class="pteam-single__staff-infovalue">{{ $tour->location ?? '' }}</p>
                  </li>
                  <li class="team-single__staff-infoitem">
                    <p class="team-single__staff-infoname">Duration</p>
                    <p class="pteam-single__staff-infovalue">{{ $tour->duration ?? '' }}</p>
                  </li>
                  <li class="team-single__staff-infoitem">
                    <p class="team-single__staff-infoname">Departure Time</p>
                    <p class="pteam-single__staff-infovalue">{{ $tour->location ?? ""}}</p>
                  </li>
                  <li class="team-single__staff-infoitem">
                    <p class="team-single__staff-infoname">Languages Spoken</p>
                    <p class="pteam-single__staff-infovalue">{{ $tour->languages ?? '' }}</p>
                  </li>
                  <li class="team-single__staff-infoitem">
                    <p class="team-single__staff-infoname">Currency Used</p>
                    <p class="pteam-single__staff-infovalue">USD & Rwandan Francs</p>
                  </li>
                  <li class="team-single__staff-infoitem">
                    <p class="team-single__staff-infoname">Maxmum People</p>
                    <p class="pteam-single__staff-infovalue">{{ $tour->maxPeople ?? '' }}</p>
                  </li>
                  <li class="team-single__staff-infoitem">
                    <p class="team-single__staff-infoname">Min Age</p>
                    <p class="pteam-single__staff-infovalue">{{ $tour->minAge ?? ''}}</p>
                  </li>
                </ul>
                    {{-- <h4 style="padding-bottom:5px; font-size:24px; padding-top:20px">Trip Itenary</h4>
                    <ul class="room__amenities-list">
                      <li class="room__amenities-item"><span><i class="fa-regular fa-circle-check"></i></span> Early rise for breakfast at 6 am.</li>
                      <li class="room__amenities-item"><span><i class="fa-regular fa-circle-check"></i></span> At 6h30 am, then transfer to the park office in Kinigi by 7 am. Make sure to bring a lunch box. upon arrival, meet the park guides for a briefing about the park rules.</li>
                      <li class="room__amenities-item"><span><i class="fa-regular fa-circle-check"></i></span> After briefing, drive near the base of Mt Bisoke to begin the hiking adventure.</li>
                      <li class="room__amenities-item"><span><i class="fa-regular fa-circle-check"></i></span> Kindly the price is from Musanze, out of Musanze the price may vary.</li>
                    </ul> --}}
                  </div>
                </div>
                
                <div class="widget widget-booking">
                    
                  <div class="booking__wrapper booking__wrapper--has-shadow bg-section-color">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="text-center">Other Details</h4>
                        <div id="accordion">

                          <div class="card">
                            <div class="card-header">
                              <a class="btn" data-bs-toggle="collapse" href="#collapseOne">
                                Tour Itinerary
                              </a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                              <div class="card-body">
                                {!! $tour->itinerary !!}
                              </div>
                            </div>
                          </div>
                        
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo">
                                Expectations
                              </a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                              <div class="card-body">
                                {!! $tour->expectations !!}
                              </div>
                            </div>
                          </div>
                        
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseThree">
                                Recommendations
                              </a>
                            </div>
                            <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                              <div class="card-body">
                                {!! $tour->recommendations !!}
                              </div>
                            </div>
                          </div>
                        
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseFour">
                                Inclusions
                              </a>
                            </div>
                            <div id="collapseFour" class="collapse" data-bs-parent="#accordion">
                              <div class="card-body">
                                {!! $tour->inclusions !!}
                              </div>
                            </div>
                          </div>
                        
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseFive">
                                Exclusions
                              </a>
                            </div>
                            <div id="collapseFive" class="collapse" data-bs-parent="#accordion">
                              <div class="card-body">
                                {!! $tour->exclusions !!}
                              </div>
                            </div>
                          </div>
                        
                        </div>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
          </div>

          <div class="col-lg-4 col-md-8">
            <div class="widget widget-booking">
                    
              <div class="booking__wrapper booking__wrapper--has-shadow bg-section-color">
                <div class="row">
                  <div class="col-12">
                    @include('frontend.includes.booking-contact-cta', [
                      'ctaTitle' => 'Book your tour stay',
                      'ctaDescription' => 'Reserve your stay on Booking.com and contact us for tour planning support.'
                    ])
                 </div>
                </div>
              </div>
            </div>

            <h2 style="font-size: 24px; color: #333; margin-bottom: 20px;">Related Trips</h2>
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($tours as $rs )
                <li style="display: flex; align-items: center; margin-bottom: 15px; background-color: #fff; padding: 10px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                    <!-- Image on the left -->
                    <div style="flex-shrink: 0; margin-right: 15px;">
                        <a href="{{ route('tour',['slug'=>$rs->slug]) }}">
                            <img src="{{ asset('storage/images/trips/' .$rs->image) }}" alt="Single Room with Balcony" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;">
                        </a>
                    </div>
                    <!-- Title and Price on the right -->
                    <div style="flex-grow: 1; display: flex; justify-content: space-between; align-items: left;">
                        <div>

                            <a href="{{ route('tour',['slug'=>$rs->slug]) }}" style="font-size: 18px; color: #333; margin: 0;">{{ $rs->title }}</a>
                            {{-- <span style="font-size: 16px; font-weight: bold; color: #007bff;">$120/night</span> --}}
                        </div>

                    </div>
                </li>
                @endforeach

                <!-- Add more rooms here following the same structure -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection