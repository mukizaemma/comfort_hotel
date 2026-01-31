@extends('layouts.adminBase')

@section('content')
@include('accountant.includes.sidebar')
<div class="content">
    @include('admin.includes.navbar')

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Invoices</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal" onclick="resetForm()">
                    <i class="fa fa-plus me-2"></i>Generate Invoice
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Type</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ ucfirst($invoice->invoice_type) }}</td>
                            <td>{{ $invoice->customer_name }}</td>
                            <td>{{ number_format($invoice->total, 2) }} RWF</td>
                            <td>{{ $invoice->invoice_date->format('Y-m-d') }}</td>
                            <td><span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'sent' ? 'info' : 'warning') }}">{{ ucfirst($invoice->status) }}</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info" onclick="viewInvoice({{ $invoice->id }})">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="invoiceForm" action="{{ route('accountant.invoices.generate') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Invoice Type *</label>
                        <select class="form-control" name="invoice_type" required>
                            <option value="room">Room</option>
                            <option value="restaurant">Restaurant</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Booking/Reservation ID</label>
                        <input type="number" class="form-control" name="booking_id" placeholder="Leave blank if not applicable">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Name *</label>
                            <input type="text" class="form-control" name="customer_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" class="form-control" name="customer_email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Phone</label>
                            <input type="text" class="form-control" name="customer_phone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Invoice Date *</label>
                            <input type="date" class="form-control" name="invoice_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Customer Address</label>
                        <textarea class="form-control" name="customer_address" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Subtotal *</label>
                            <input type="number" step="0.01" class="form-control" name="subtotal" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tax</label>
                            <input type="number" step="0.01" class="form-control" name="tax" value="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Discount</label>
                            <input type="number" step="0.01" class="form-control" name="discount" value="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total *</label>
                        <input type="number" step="0.01" class="form-control" name="total" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function resetForm() {
    document.getElementById('invoiceForm').reset();
    document.querySelector('input[name="invoice_date"]').value = '{{ date('Y-m-d') }}';
}

function viewInvoice(id) {
    // Implement invoice view
    alert('View invoice functionality');
}
</script>
@endsection
