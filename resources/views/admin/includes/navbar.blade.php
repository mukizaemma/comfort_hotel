<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        @php
            $user = auth()->user();
            $currentRoute = request()->route()->getName();
            $currentDashboard = 'content-management';
            if (str_contains($currentRoute, 'accountant.')) {
                $currentDashboard = 'accountant';
            } elseif (str_contains($currentRoute, 'front-office.')) {
                $currentDashboard = 'front-office';
            }
        @endphp

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">{{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <div class="dropdown-header">
                    <strong>{{ auth()->user()->name }}</strong>
                    <br>
                    <small class="text-muted">{{ auth()->user()->role->name ?? 'No Role' }}</small>
                </div>
                <div class="dropdown-divider"></div>
                
                @if($user->isSuperAdmin())
                <!-- Dashboard Switcher for Super Admin -->
                <h6 class="dropdown-header">Switch Dashboard</h6>
                <a href="{{ route('accountant.dashboard') }}" class="dropdown-item {{ $currentDashboard == 'accountant' ? 'active' : '' }}">
                    <i class="fa fa-calculator me-2"></i>Finance Dashboard
                    @if($currentDashboard == 'accountant')
                        <i class="fa fa-check float-end mt-1"></i>
                    @endif
                </a>
                <a href="{{ route('content-management.dashboard') }}" class="dropdown-item {{ $currentDashboard == 'content-management' ? 'active' : '' }}">
                    <i class="fa fa-cog me-2"></i>Content Management
                    @if($currentDashboard == 'content-management')
                        <i class="fa fa-check float-end mt-1"></i>
                    @endif
                </a>
                <a href="{{ route('front-office.dashboard') }}" class="dropdown-item {{ $currentDashboard == 'front-office' ? 'active' : '' }}">
                    <i class="fa fa-concierge-bell me-2"></i>Front Office
                    @if($currentDashboard == 'front-office')
                        <i class="fa fa-check float-end mt-1"></i>
                    @endif
                </a>
                <div class="dropdown-divider"></div>
                @endif
                
                {{-- Billing & Finance Section --}}
                @if($user->isSuperAdmin() || $user->isAccountant())
                <h6 class="dropdown-header">Billing & Finance</h6>
                <a href="{{ route('accountant.expenses') }}" class="dropdown-item">
                    <i class="fa fa-money-bill-wave me-2"></i>Expenses
                </a>
                <a href="{{ route('accountant.sales') }}" class="dropdown-item">
                    <i class="fa fa-chart-bar me-2"></i>Sales Reports
                </a>
                <a href="{{ route('accountant.invoices') }}" class="dropdown-item">
                    <i class="fa fa-file-invoice me-2"></i>Invoices
                </a>
                <a href="{{ route('accountant.payments') }}" class="dropdown-item">
                    <i class="fa fa-check-circle me-2"></i>Payments
                </a>
                <div class="dropdown-divider"></div>
                @endif
                
                {{-- <a href="{{ route('aboutPage') }}" class="dropdown-item">
                    <i class="fa fa-user me-2"></i>My Profile
                </a> --}}
                <a href="{{ route('setting') }}" class="dropdown-item">
                    <i class="fa fa-cog me-2"></i>Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logouts') }}" class="dropdown-item">
                    <i class="fa fa-sign-out-alt me-2"></i>Log Out
                </a>
            </div>
        </div>
    </div>
</nav>