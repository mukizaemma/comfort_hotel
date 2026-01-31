@extends('layouts.adminBase')

@section('content')
<!-- Sidebar Start -->
@include('accountant.includes.sidebar')
<!-- Sidebar End -->

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('admin.includes.navbar')
    <!-- Navbar End -->

    <div class="container-fluid pt-4 px-4">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(auth()->user()->isSuperAdmin())
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-crown me-2"></i>Super Admin Mode:</strong> You have full access to all dashboards. Use the "Switch Dashboard" button in the top navigation to access Content Management or Front Office dashboards.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(auth()->user()->isAccountant())
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-user-tie me-2"></i>Accountant Dashboard:</strong> You have access to financial operations, expenses, sales reports, invoices, and payments.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-dollar-sign fa-3x text-success"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today's Sales</p>
                        <h6 class="mb-0">{{ number_format($stats['today_sales'], 2) }} RWF</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Month's Sales</p>
                        <h6 class="mb-0">{{ number_format($stats['month_sales'], 2) }} RWF</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-money-bill-wave fa-3x text-danger"></i>
                    <div class="ms-3">
                        <p class="mb-2">Month's Expenses</p>
                        <h6 class="mb-0">{{ number_format($stats['month_expenses'], 2) }} RWF</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-clock fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pending Payments</p>
                        <h6 class="mb-0">{{ $stats['pending_payments'] }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Quick Actions</h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('accountant.expenses') }}" class="btn btn-danger w-100">
                                <i class="fa fa-money-bill-wave me-2"></i>Record Expense
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('accountant.payments') }}" class="btn btn-warning w-100">
                                <i class="fa fa-check-circle me-2"></i>Confirm Payments
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('accountant.sales') }}" class="btn btn-success w-100">
                                <i class="fa fa-chart-bar me-2"></i>Sales Reports
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('accountant.invoices') }}" class="btn btn-info w-100">
                                <i class="fa fa-file-invoice me-2"></i>Generate Invoice
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content End -->
@endsection
