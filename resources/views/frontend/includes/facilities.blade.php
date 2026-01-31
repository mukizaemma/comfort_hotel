    <div class="rts__section section__padding">
        <div class="container">
            <!-- row -->
            <div class="row g-30">
                <!-- single room -->
                    @foreach ($facilities as $facility )
                    <div class="col-lg-6">
                    <div class="room__card is__style__three vh-100">
                        <div class="room__card__top">
                            <div class="room__card__image">
                                <a href="{{ route('facility',['slug'=>$facility->slug]) }}">
                                    <img src="{{ asset('storage/' . ($facility->cover_image ?? 'facilities/default.jpg')) }}" width="645" height="415" alt="{{ $facility->title }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                                </a>
                            </div>
                        </div>
                        <div class="room__card__meta">
                            <a href="{{ route('facility',['slug'=>$facility->slug]) }}" class="room__card__title h4">{{ $facility->title }}</a>
                            <p class="font-sm">{!! Str::words($facility->description, 20, '...') !!}</p>
                            <a href="{{ route('facility',['slug'=>$facility->slug]) }}" class="room__card__link">Discover More</a>

                        </div>
                    </div>
                </div>
                    @endforeach
                <!-- single room end -->



            </div>
            <!-- row end -->

        </div>
    </div>
