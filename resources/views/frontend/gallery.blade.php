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
    $galleryImageList = [];
    foreach ($galleryImages as $img) {
        $url = $img->image && (strpos($img->image, 'gallery/') === 0 || strpos($img->image, '/') !== false)
            ? asset('storage/' . $img->image)
            : asset('storage/images/gallery/' . $img->image);
        $galleryImageList[] = ['url' => $url, 'caption' => $img->caption ?? ''];
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

    <!-- gallery with tabs -->
    <div class="rts__section section__padding">
        <div class="container">
            <ul class="nav nav-tabs mb-4" id="galleryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="true">Images</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">Videos</button>
                </li>
            </ul>

            <div class="tab-content" id="galleryTabsContent">
                <!-- Images tab (default) -->
                <div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
                    <div class="row g-4" id="galleryImagesRow">
                        @forelse ($galleryImages as $index => $image)
                            @php
                                $imageUrl = $image->image && (strpos($image->image, 'gallery/') === 0 || strpos($image->image, '/') !== false)
                                    ? asset('storage/' . $image->image)
                                    : asset('storage/images/gallery/' . $image->image);
                            @endphp
                            <div class="col-lg-4 col-md-6">
                                <div class="gallery__item h-100">
                                    <a href="javascript:void(0)" class="gallery__link d-block rounded-2 overflow-hidden gallery-image-trigger" data-index="{{ $index }}" role="button">
                                        <img class="img-fluid w-100" src="{{ $imageUrl }}" alt="{{ $image->caption ?? 'Gallery image' }}" loading="lazy" style="height: 260px; object-fit: cover;">
                                    </a>
                                    @if(!empty($image->caption))
                                        <p class="mt-2 small text-muted mb-0">{{ $image->caption }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted mb-0">No images in the gallery yet.</p>
                            </div>
                        @endforelse
                    </div>
                    @if($galleryImages->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $galleryImages->links() }}
                        </div>
                    @endif
                </div>

                <!-- Videos tab -->
                <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                    <div class="row g-4">
                        @forelse ($galleryVideos as $video)
                            @php $videoId = $video->youtube_video_id; @endphp
                            @if($videoId)
                                <div class="col-lg-4 col-md-6">
                                    <div class="gallery__item h-100">
                                        <div class="ratio ratio-16x9 rounded-2 overflow-hidden bg-dark gallery-video-trigger" data-video-id="{{ $videoId }}" data-caption="{{ $video->caption ?? '' }}" role="button" style="cursor: pointer; position: relative;">
                                            <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" alt="{{ $video->caption ?? 'Video' }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            <div class="position-absolute top-50 start-50 translate-middle" style="pointer-events: none;">
                                                <span class="rounded-circle d-flex align-items-center justify-content-center bg-danger text-white" style="width: 70px; height: 70px; font-size: 28px;"><i class="fas fa-play"></i></span>
                                            </div>
                                        </div>
                                        @if(!empty($video->caption))
                                            <p class="mt-2 small text-muted mb-0">{{ $video->caption }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted mb-0">No videos in the gallery yet. Add YouTube links from the admin.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Lightbox Modal: card with arrows and close -->
    <div class="modal fade" id="imageLightboxModal" tabindex="-1" aria-labelledby="imageLightboxLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="modal-header border-0 py-2 px-3 bg-dark text-white d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-link text-white text-decoration-none p-0 me-auto gallery-lightbox-prev" aria-label="Previous"><i class="fas fa-chevron-left fa-2x"></i></button>
                    <h5 class="modal-title mb-0 mx-2" id="imageLightboxLabel">Image</h5>
                    <div class="d-flex align-items-center">
                        <span class="gallery-lightbox-counter me-3 small"></span>
                        <button type="button" class="btn btn-link text-white text-decoration-none p-0 gallery-lightbox-close" aria-label="Close"><i class="fas fa-times fa-2x"></i></button>
                    </div>
                    <button type="button" class="btn btn-link text-white text-decoration-none p-0 ms-auto gallery-lightbox-next" aria-label="Next"><i class="fas fa-chevron-right fa-2x"></i></button>
                </div>
                <div class="modal-body p-0 bg-dark text-center">
                    <img class="gallery-lightbox-image img-fluid" src="" alt="" style="max-height: 80vh; width: auto;">
                    <p class="gallery-lightbox-caption text-white small p-2 mb-0"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Lightbox Modal: larger card to watch video -->
    <div class="modal fade" id="videoLightboxModal" tabindex="-1" aria-labelledby="videoLightboxLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="modal-header border-0 py-2 px-3 bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="modal-title mb-0" id="videoLightboxLabel">Video</h5>
                    <button type="button" class="btn btn-link text-white text-decoration-none p-0 gallery-video-close" aria-label="Close"><i class="fas fa-times fa-2x"></i></button>
                </div>
                <div class="modal-body p-0 bg-dark">
                    <div class="ratio ratio-16x9">
                        <iframe class="gallery-video-iframe" src="" title="Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <p class="gallery-video-caption text-white small p-3 mb-0"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        var galleryImages = @json($galleryImageList);
        var currentImageIndex = 0;
        var imageModalEl = document.getElementById('imageLightboxModal');
        var imageModal = imageModalEl ? new bootstrap.Modal(imageModalEl) : null;

        function openImageLightbox(index) {
            if (!galleryImages.length || !imageModal) return;
            currentImageIndex = (index + galleryImages.length) % galleryImages.length;
            var item = galleryImages[currentImageIndex];
            var imgEl = document.querySelector('.gallery-lightbox-image');
            var capEl = document.querySelector('.gallery-lightbox-caption');
            var counterEl = document.querySelector('.gallery-lightbox-counter');
            if (imgEl) imgEl.src = item.url;
            if (imgEl) imgEl.alt = item.caption || 'Gallery image';
            if (capEl) capEl.textContent = item.caption || '';
            if (counterEl) counterEl.textContent = (currentImageIndex + 1) + ' / ' + galleryImages.length;
            imageModal.show();
        }

        function showPrevImage() {
            currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
            var item = galleryImages[currentImageIndex];
            var imgEl = document.querySelector('.gallery-lightbox-image');
            var capEl = document.querySelector('.gallery-lightbox-caption');
            var counterEl = document.querySelector('.gallery-lightbox-counter');
            if (imgEl) imgEl.src = item.url;
            if (capEl) capEl.textContent = item.caption || '';
            if (counterEl) counterEl.textContent = (currentImageIndex + 1) + ' / ' + galleryImages.length;
        }

        function showNextImage() {
            currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
            var item = galleryImages[currentImageIndex];
            var imgEl = document.querySelector('.gallery-lightbox-image');
            var capEl = document.querySelector('.gallery-lightbox-caption');
            var counterEl = document.querySelector('.gallery-lightbox-counter');
            if (imgEl) imgEl.src = item.url;
            if (capEl) capEl.textContent = item.caption || '';
            if (counterEl) counterEl.textContent = (currentImageIndex + 1) + ' / ' + galleryImages.length;
        }

        document.querySelectorAll('.gallery-image-trigger').forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var index = parseInt(this.getAttribute('data-index'), 10);
                openImageLightbox(index);
            });
        });

        var prevBtn = document.querySelector('.gallery-lightbox-prev');
        var nextBtn = document.querySelector('.gallery-lightbox-next');
        var closeBtn = document.querySelector('.gallery-lightbox-close');
        if (prevBtn) prevBtn.addEventListener('click', showPrevImage);
        if (nextBtn) nextBtn.addEventListener('click', showNextImage);
        if (closeBtn) closeBtn.addEventListener('click', function() { if (imageModal) imageModal.hide(); });

        document.querySelectorAll('.gallery-video-trigger').forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var videoId = this.getAttribute('data-video-id');
                var caption = this.getAttribute('data-caption') || '';
                var iframe = document.querySelector('.gallery-video-iframe');
                var capEl = document.querySelector('.gallery-video-caption');
                if (iframe) iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
                if (capEl) capEl.textContent = caption;
                var videoModalEl = document.getElementById('videoLightboxModal');
                if (videoModalEl) {
                    var videoModal = bootstrap.Modal.getOrCreateInstance(videoModalEl);
                    videoModal.show();
                }
            });
        });

        var videoCloseBtn = document.querySelector('.gallery-video-close');
        if (videoCloseBtn) {
            videoCloseBtn.addEventListener('click', function() {
                var videoModalEl = document.getElementById('videoLightboxModal');
                if (videoModalEl) {
                    var videoModal = bootstrap.Modal.getInstance(videoModalEl);
                    if (videoModal) videoModal.hide();
                }
                var iframe = document.querySelector('.gallery-video-iframe');
                if (iframe) iframe.src = '';
            });
        }

        document.getElementById('videoLightboxModal').addEventListener('hidden.bs.modal', function() {
            var iframe = document.querySelector('.gallery-video-iframe');
            if (iframe) iframe.src = '';
        });
    })();
    </script>

@endsection
