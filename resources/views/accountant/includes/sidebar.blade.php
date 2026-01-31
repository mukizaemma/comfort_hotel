@php
$setting = App\Models\Setting::first();
$currentRoute = request()->route()->getName();
@endphp

<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('storage/images') . ($setting->logo ?? '') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                {{-- <h6 class="mb-0">{{ $setting->company ?? 'Comfort Hotel' }}</h6> --}}
                <span>
                    @if(auth()->user()->isSuperAdmin())
                        <span class="badge bg-danger me-1">Super Admin</span>
                    @elseif(auth()->user()->isAccountant())
                        <span class="badge bg-success me-1">Accountant</span>
                    @endif
                    Accountant Dashboard
                </span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            {{-- ACCOUNTANT MENU - Only for Accountant (role_id=3) and Super Admin when on this dashboard --}}
            {{-- Accountant (role_id=3) sees ONLY these menus --}}
            {{-- Super Admin (role_id=1) sees ONLY these menus when on Accountant dashboard --}}
            {{-- NO mixing with Content Management or Front Office menus --}}
            
            <a href="{{ route('accountant.dashboard') }}" class="nav-item nav-link {{ $currentRoute == 'accountant.dashboard' ? 'active' : '' }}">
                <i class="fas fa-grip-horizontal me-2"></i>Dashboard
            </a>
            
            {{-- Accountant Features - ONLY these items, no mixing with other dashboards --}}
            <a href="{{ route('accountant.expense-categories') }}" class="nav-item nav-link {{ str_contains($currentRoute, 'accountant.expense-categories') ? 'active' : '' }}">
                <i class="fas fa-tags me-2"></i>Expense Categories
            </a>
            <a href="{{ route('accountant.expenses') }}" class="nav-item nav-link {{ str_contains($currentRoute, 'accountant.expenses') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave me-2"></i>Expenses
            </a>
            <a href="{{ route('accountant.sales') }}" class="nav-item nav-link {{ str_contains($currentRoute, 'accountant.sales') ? 'active' : '' }}">
                <i class="fas fa-chart-bar me-2"></i>Sales Reports
            </a>
            <a href="{{ route('accountant.invoices') }}" class="nav-item nav-link {{ str_contains($currentRoute, 'accountant.invoices') ? 'active' : '' }}">
                <i class="fas fa-file-invoice me-2"></i>Invoices
            </a>
            <a href="{{ route('accountant.payments') }}" class="nav-item nav-link {{ str_contains($currentRoute, 'accountant.payments') ? 'active' : '' }}">
                <i class="fas fa-check-circle me-2"></i>Payments
            </a>
            
            <hr>
            <a href="{{ route('logouts') }}" class="nav-item nav-link">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </div>
    </nav>
</div>
