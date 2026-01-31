@extends('layouts.frontbase')

@section('content')

<!-- Page Header -->
@php
    $heroImage2 = '';
    if ($about && $about->image2) {
        if (strpos($about->image2, '/') !== false || strpos($about->image2, 'abouts') === 0) {
            $heroImage2 = asset('storage/' . $about->image2);
        } else {
            $heroImage2 = asset('storage/images/about/' . $about->image2);
        }
    } else {
        $heroImage2 = asset('storage/images/about/default.jpg');
    }
@endphp
<div class="rts__section page__hero__height page__hero__bg" style="background-image: url({{ $heroImage2 }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="page__hero__content">
                    <h1 class="wow fadeInUp">Guest Reviews</h1>
                    <p class="wow fadeInUp font-sm">Read what our guests have to say about their stay</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Reviews Section -->
<div class="rts__section section__padding">
    <div class="container">
        <div class="row mb-40">
            <div class="col-12 text-center">
                <h2>All Reviews ({{ $reviewCount }})</h2>
                <a href="#add-review" class="theme-btn btn-style fill mt-3">
                    <span>Add Your Review</span>
                </a>
            </div>
        </div>
        
        <div class="row g-30">
            @forelse($reviews as $review)
            <div class="col-lg-6 wow fadeInUp">
                <div class="review__card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); height: 100%;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                        <div>
                            <h5 style="margin-bottom: 5px;">{{ $review->names }}</h5>
                            <div style="display: flex; gap: 5px; margin-bottom: 10px;">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <span class="font-sm" style="color: #999;">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 15px;">
                        {{ $review->testimony }}
                    </p>
                    <a href="{{ route('review', ['id' => $review->id]) }}" class="theme-btn btn-style sm-btn border">
                        <span>Read Full Review</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="font-lg">No reviews yet. Be the first to review!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
        <div class="row mt-40">
            <div class="col-12">
                {{ $reviews->links() }}
            </div>
        </div>
        @endif

        <!-- Add Review Form -->
        <div class="row mt-60" id="add-review">
            <div class="col-lg-8 mx-auto">
                <div style="background: #f9f9f9; padding: 40px; border-radius: 10px;">
                    <h3 class="text-center mb-30">Share Your Experience</h3>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="row g-20">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="names" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                <select name="rating" class="form-control" required>
                                    <option value="">Select Rating</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Website (Optional)</label>
                                <input type="url" name="website" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Your Review <span class="text-danger">*</span></label>
                                <textarea name="testimony" class="form-control" rows="5" required placeholder="Share your experience..."></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="theme-btn btn-style fill">
                                    <span>Submit Review</span>
                                </button>
                                <p class="font-sm mt-3" style="color: #999;">
                                    Your review will be published after admin approval.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reviews End -->

@endsection
