@extends('layouts.adminBase')

@section('content')
@include('accountant.includes.sidebar')
<div class="content">
    @include('admin.includes.navbar')

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Payment Confirmations</h4>

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
                            <th>Actions</th>
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
                            <td>
                                <span class="badge bg-{{ $payment->status == 'confirmed' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td>{{ $payment->receivedBy->name ?? 'N/A' }}</td>
                            <td>
                                @if($payment->status == 'pending')
                                <button class="btn btn-sm btn-success" onclick="confirmPayment({{ $payment->id }})">
                                    <i class="fa fa-check"></i> Confirm
                                </button>
                                @else
                                <span class="text-muted">Confirmed by {{ $payment->confirmedBy->name ?? 'N/A' }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmPayment(id) {
    if (confirm('Confirm this payment?')) {
        fetch(`/accountant/payments/${id}/confirm`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}
</script>
@endsection
