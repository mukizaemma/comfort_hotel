@extends('layouts.adminBase')

@section('content')
@include('content-management.includes.sidebar')
<div class="content">
    @include('admin.includes.navbar')

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Services Management</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal" onclick="resetForm()">
                    <i class="fa fa-plus me-2"></i>Add New Service
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->title }}</td>
                            <td><span class="badge bg-{{ $service->status == 'Active' ? 'success' : 'danger' }}">{{ $service->status }}</span></td>
                            <td>{{ $service->images->count() }} images</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="viewService({{ $service->id }})">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" onclick="editService({{ $service->id }})">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteService({{ $service->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Service Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalTitle">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="serviceForm" enctype="multipart/form-data" novalidate>
                <div class="modal-body">
                    <div id="serviceFormErrors" class="alert alert-danger" style="display: none;"></div>
                    <input type="hidden" id="service_id" name="id">
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="service_title" name="title" required>
                        <div class="invalid-feedback">Please provide a title.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="service_description" name="description" rows="6"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cover Image</label>
                        <input type="file" class="form-control" id="service_cover_image" name="cover_image" accept="image/*">
                        <small class="text-muted">Optional - Main image for the service</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gallery Images (Multiple)</label>
                        <input type="file" class="form-control" id="service_images" name="images[]" multiple accept="image/*">
                        <small class="text-muted">Optional - You can select multiple images</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="service_status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <div class="invalid-feedback">Please select a status.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentServiceId = null;

function resetForm() {
    currentServiceId = null;
    const form = document.getElementById('serviceForm');
    form.reset();
    form.classList.remove('was-validated');
    document.getElementById('service_id').value = '';
    document.getElementById('serviceModalTitle').textContent = 'Add New Service';
    document.getElementById('serviceFormErrors').style.display = 'none';
    document.getElementById('serviceFormErrors').innerHTML = '';
    // Remove invalid classes
    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
}

function editService(id) {
    fetch(`{{ route('content-management.services.show', ':id') }}`.replace(':id', id))
        .then(response => response.json())
        .then(data => {
            currentServiceId = id;
            document.getElementById('service_id').value = data.id;
            document.getElementById('service_title').value = data.title;
            document.getElementById('service_description').value = data.description || '';
            document.getElementById('service_status').value = data.status;
            document.getElementById('serviceModalTitle').textContent = 'Edit Service';
            new bootstrap.Modal(document.getElementById('serviceModal')).show();
        });
}

function viewService(id) {
    window.location.href = `/content-management/services/${id}`;
}

function deleteService(id) {
    if (confirm('Are you sure you want to delete this service?')) {
        fetch(`{{ route('content-management.services.destroy', ':id') }}`.replace(':id', id), {
            method: 'DELETE',
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

document.getElementById('serviceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const form = this;
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    // Check HTML5 validation
    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        // Highlight invalid fields
        form.querySelectorAll(':invalid').forEach(field => {
            field.classList.add('is-invalid');
        });
        return false;
    }
    
    // Show loading state
    submitBtn.disabled = true;
    spinner.classList.remove('d-none');
    
    const formData = new FormData(form);
    const url = currentServiceId 
        ? `{{ route('content-management.services.update', ':id') }}`.replace(':id', currentServiceId)
        : '{{ route('content-management.services.store') }}';
    
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
        
        if (data.success) {
            // Close modal using jQuery (more reliable)
            const modalElement = document.getElementById('serviceModal');
            if (modalElement && typeof jQuery !== 'undefined') {
                jQuery(modalElement).modal('hide');
            } else if (modalElement) {
                // Fallback: manually hide
                modalElement.classList.remove('show');
                modalElement.style.display = 'none';
                document.body.classList.remove('modal-open');
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) backdrop.remove();
            }
            setTimeout(() => location.reload(), 300);
        } else {
            // Show validation errors
            const errorDiv = document.getElementById('serviceFormErrors');
            errorDiv.style.display = 'block';
            let errorHtml = '<strong>Please fix the following errors:</strong><ul class="mb-0">';
            
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    errorHtml += `<li>${data.errors[field][0]}</li>`;
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                    }
                });
            } else if (data.message) {
                errorHtml += `<li>${data.message}</li>`;
            }
            errorHtml += '</ul>';
            errorDiv.innerHTML = errorHtml;
        }
    })
    .catch(error => {
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
        const errorDiv = document.getElementById('serviceFormErrors');
        errorDiv.style.display = 'block';
        errorDiv.innerHTML = `<strong>Error:</strong> ${error.message || 'An error occurred. Please try again.'}`;
    });
});

// Initialize Summernote for description
$(document).ready(function() {
    $('#service_description').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
});
</script>
@endsection
