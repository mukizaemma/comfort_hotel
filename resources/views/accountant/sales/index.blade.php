@extends('layouts.adminBase')

@section('content')
@include('accountant.includes.sidebar')
<div class="content">
    @include('admin.includes.navbar')

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Sales Reports</h4>
            
            <form method="GET" action="{{ route('accountant.sales') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>

            <div class="alert alert-info">
                <h5>Total Sales: {{ number_format($totalSales, 2) }} RWF</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Payment #</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Received By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_number }}</td>
                            <td>{{ ucfirst($payment->payment_type) }}</td>
                            <td>{{ number_format($payment->amount, 2) }} RWF</td>
                            <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                            <td><span class="badge bg-{{ $payment->status == 'confirmed' ? 'success' : 'warning' }}">{{ ucfirst($payment->status) }}</span></td>
                            <td>{{ $payment->receivedBy->name ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
