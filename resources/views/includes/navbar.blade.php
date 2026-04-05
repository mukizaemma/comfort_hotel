<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s" style="background-color: #fff;">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-tel-alt me-2"></i><a href="tel:{{ $setting->phone ?? '' }}">{{ $setting->phone ?? '' }}</a></small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i><a href="mailto:{{ $setting->email ?? '' }}">{{ $setting->email ?? '' }}</a></small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            @php
                $u = function ($v) {
                    $s = trim((string) ($v ?? ''));
                    return $s !== '' ? $s : null;
                };
                $topSocial = [];
                if ($x = $u($setting->facebook ?? null)) {
                    $topSocial[] = ['url' => $x, 'icon' => 'fab fa-facebook-f'];
                }
                if ($x = $u($setting->twitter ?? null)) {
                    $topSocial[] = ['url' => $x, 'icon' => 'fab fa-twitter'];
                }
                if ($x = $u($setting->linkedin ?? null)) {
                    $topSocial[] = ['url' => $x, 'icon' => 'fab fa-linkedin-in'];
                }
                if ($x = $u($setting->instagram ?? null)) {
                    $topSocial[] = ['url' => $x, 'icon' => 'fab fa-instagram'];
                }
            @endphp
            @if(count($topSocial) > 0)
                <small>Follow us:</small>
                @foreach($topSocial as $link)
                    <a class="text-body ms-3" href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"><i class="{{ $link['icon'] }}"></i></a>
                @endforeach
            @endif
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ route('home') }}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0"><span class="text-secondary">Fly</span> Study</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                {{-- <a href="index.html" class="nav-item nav-link active">Home</a> --}}
                <a href="{{ route('home') }}" class="nav-item nav-link">About Us</a>
                {{-- <a href="{{ route('about') }}" class="nav-item nav-link">About</a> --}}
                @foreach ($programs as $program)
                <a href="{{ route('categoryPrograms',['slug'=>$program->slug]) }}" class="nav-item nav-link">{{ $program->title }}</a>
                @endforeach
       
                <a href="{{ route('connect') }}" class="nav-item nav-link">Contact Us</a>
            </div>
            <div class="d-none d-lg-flex ms-2">

                {{-- <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                    <small class="fa fa-user text-body"></small>
                </a> --}}
            </div>
        </div>
    </nav>
</div>