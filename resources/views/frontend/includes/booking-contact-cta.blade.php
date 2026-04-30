@php
    $ctaTitle = $ctaTitle ?? 'Reserve your stay';
    $ctaDescription = $ctaDescription ?? 'For reservations, use Booking.com. For direct assistance, contact us via WhatsApp, phone, or email.';
    $hotelContact = $hotelContact ?? \App\Models\HotelContact::first();
    $bookingUrl = trim((string) ($setting->linktree ?? ''));
    $phoneRaw = optional($hotelContact)->phone ?? $setting->phone ?? '';
    $phoneDigits = preg_replace('/\D+/', '', (string) $phoneRaw);
    $whatsappRaw = trim((string) ($setting->whatsapp_phone ?? ''));
    if ($whatsappRaw === '') {
        $whatsappRaw = trim((string) (optional($hotelContact)->whatsapp ?? ''));
    }
    if ($whatsappRaw === '') {
        $whatsappRaw = trim((string) ($setting->reception_phone ?? ''));
    }
    if ($whatsappRaw === '') {
        $whatsappRaw = $phoneRaw;
    }
    $whatsappDigits = preg_replace('/\D+/', '', (string) $whatsappRaw);
    $emailAddress = optional($hotelContact)->email ?? $setting->email ?? '';
@endphp

@once
<style>
    .booking-cta-card { background: #fff; border: 1px solid #e9edf3; border-radius: 14px; box-shadow: 0 8px 24px rgba(16, 24, 40, .06); padding: 24px; }
    .booking-cta-chip { display: inline-flex; align-items: center; gap: 8px; background: #eef4ff; color: #1e5fbf; border: 1px solid #d7e5ff; border-radius: 999px; padding: 6px 12px; font-size: 13px; font-weight: 600; }
    .booking-cta-title { margin: 12px 0 8px; font-size: 28px; line-height: 1.2; }
    .booking-cta-text { color: #4b5563; margin-bottom: 14px; }
    .booking-cta-help { color: #6b7280; font-size: 14px; margin-bottom: 16px; }
    .booking-cta-btn { display: inline-flex; align-items: center; justify-content: center; width: 100%; min-height: 46px; border-radius: 8px; font-weight: 600; border: 1px solid transparent; text-decoration: none; transition: .2s ease; }
    .booking-cta-btn:hover { transform: translateY(-1px); color: inherit; }
    .booking-cta-btn.primary { background: #165fc2; color: #fff; }
    .booking-cta-btn.whatsapp { background: #22c55e; color: #fff; }
    .booking-cta-btn.secondary { background: #fff; color: #165fc2; border-color: #9db7e5; }
    .booking-cta-btn.call { background: #fff; color: #111827; border-color: #d1d5db; }
</style>
@endonce

<div class="booking-cta-card">
    <span class="booking-cta-chip"><i class="fas fa-calendar-check"></i> Booking options</span>
    <h3 class="booking-cta-title">{{ $ctaTitle }}</h3>
    <p class="booking-cta-text">{{ $ctaDescription }}</p>
    <p class="booking-cta-help">Secure reservations are managed through Booking.com.</p>

    @if(!empty($bookingUrl))
        <a href="{{ $bookingUrl }}" target="_blank" rel="noopener noreferrer" class="booking-cta-btn primary mb-2">
            <span>Book on Booking.com</span>
        </a>
    @endif

    <div class="row g-2">
        @if(!empty($whatsappDigits))
            <div class="col-md-6">
                <a href="https://wa.me/{{ $whatsappDigits }}" target="_blank" rel="noopener noreferrer" class="booking-cta-btn whatsapp">
                    <i class="fab fa-whatsapp me-2"></i><span>WhatsApp</span>
                </a>
            </div>
        @endif
        @if(!empty($phoneRaw))
            <div class="col-md-6">
                <a href="tel:{{ $phoneDigits ?: $phoneRaw }}" class="booking-cta-btn call">
                    <i class="fas fa-phone me-2"></i><span>Call</span>
                </a>
            </div>
        @endif
        @if(!empty($emailAddress))
            <div class="col-12">
                <a href="mailto:{{ $emailAddress }}" class="booking-cta-btn secondary">
                    <i class="fas fa-envelope me-2"></i><span>Email us</span>
                </a>
            </div>
        @endif
    </div>
</div>
