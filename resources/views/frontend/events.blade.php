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
                      <form action="econtacto-eventos.php" class="booking__form">
                        <div class="row justify-content-center g-4">
                          <div class="col-12">
                            <div class="booking__form-inputgroup">
                              <div class="booking__form-input">
                                <input type="text" class="form-control" placeholder="Name" name="nombre" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="booking__form-inputgroup">
                              <div class="booking__form-input">
                                <input type="text" class="form-control" placeholder="Phone" name="telefono" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="booking__form-inputgroup">
                              <div class="booking__form-input">
                                <input type="text" class="form-control" placeholder="Email" name="email" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="booking__form-inputgroup">
                              <div class="booking__form-date">
                                <input type="text" class="date-input form-control" placeholder="Event Day" name="date_in" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="booking__form-inputgroup">
                              <select class="nice-selct wide form-select" aria-label="Default select example" id="booking-field-3" name="tipo">
                                <option>Event type</option>
                                <option value="Marriage">Marriage</option>
                                <option value="Anniversary">Anniversary</option>
                                <option value="15 years">15 years</option>
                                <option value="Birthday">Birthday</option>
                                <option value="Meetings">Meetings</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-12">
                              <select class="nice-selct wide form-select" aria-label="Default select example" id="booking-field-4" name="personas">
                                <option selected>Nº Persons</option>
                                <option value="1 Person">1 Person</option>
                                <option value="2 Persons">2 Persons</option>
                                <option value="3 Persons">3 Persons</option>
                                <option value="4 Persons">4 Persons</option>
                                <option value="5 Persons">5 Persons</option>
                                <option value="6 Persons">6 Persons</option>
                                <option value="7 Persons">7 Persons</option>
                                <option value="8 Persons">8 Persons</option>
                                <option value="9 Persons">9 Persons</option>
                                <option value="More 10 Persons">More 10 Persons</option>
                              </select>
                        
                          </div>
                          <div class="col-12">
                           <script src='https://www.google.com/recaptcha/api.js'></script>
                    <div class="g-recaptcha" data-sitekey="6LdtLgkqAAAAAIb0bEQt16PF0YMGQXHaQlO5Ty3x"></div>
                          </div>
                          <div class="col-12">
                            <div class="booking__form-btn">
                              <button class="custom-btn custom-btn--fluid" type="submit"><span>Book Now</span></button>
                            </div>
                          </div>
                        </div>
                      </form>
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