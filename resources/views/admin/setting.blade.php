@extends('layouts.adminBase')

@section('content')
@include('content-management.includes.sidebar')
<div class="content">
    @include('admin.includes.navbar')

    <div class="container-fluid pt-4 px-4">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#contacts">Contacts & Logo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#about">About Hotel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#terms">Terms & Conditions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#seo">SEO Data</a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Contacts & Logo Tab -->
            <div id="contacts" class="tab-pane fade show active">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Contacts & Logo Settings</h4>
                    <form action="{{ route('saveSetting', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="company" class="form-label">Website Title</label>
                                <input type="text" class="form-control" value="{{ $data->company }}" name="company">
                            </div>
                            <div class="col-lg-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" value="{{ $data->address }}" name="address">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" value="{{ $data->phone }}" name="phone">
                            </div>
                            <div class="col-lg-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $data->email }}" name="email">
                            </div>
                        </div>
                        <h5 class="mb-3">Social Media</h5>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" value="{{ $data->facebook }}" name="facebook">
                            </div>
                            <div class="col-lg-6">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" value="{{ $data->instagram }}" name="instagram">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="youtube" class="form-label">YouTube</label>
                                <input type="text" class="form-control" value="{{ $data->youtube }}" name="youtube">
                            </div>
                            <div class="col-lg-6">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="text" class="form-control" value="{{ $data->linkedin }}" name="linkedin">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="linktree" class="form-label">Booking Link</label>
                                <input type="text" class="form-control" value="{{ $data->linktree ?? '' }}" name="linktree">
                            </div>
                        </div>
                        <h5 class="mb-3">Logo</h5>
                        <div class="row mb-4">
                            <div class="col-lg-6 text-center" style="padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                                <label class="form-label fw-bold">Header Logo</label>
                                <div class="my-3">
                                    <img src="{{ asset('storage/images') . $data->logo }}" alt="Logo" style="width: 150px; border-radius: 8px;">
                                </div>
                                <label for="logo" class="form-label">Change Header Logo</label>
                                <input type="file" class="form-control mt-2" name="logo">
                            </div>
                            <div class="col-lg-6 text-center" style="padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                                <label class="form-label fw-bold">Footer Logo</label>
                                <div class="my-3">
                                    <img src="{{ asset('storage/images') . $data->donate }}" alt="Logo" style="width: 150px; border-radius: 8px;">
                                </div>
                                <label for="donate" class="form-label">Change Footer Logo</label>
                                <input type="file" class="form-control mt-2" name="donate">
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Contacts & Logo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- About Hotel Tab -->
            <div id="about" class="tab-pane fade">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">About Hotel</h4>
                    @php $about = App\Models\About::first(); @endphp
                    <form action="{{ route('content-management.about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $about->title ?? '' }}">
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Sub Title</label>
                            <input type="text" class="form-control" name="subTitle" value="{{ $about->subTitle ?? '' }}">
                        </div> --}}
                        <div class="mb-3">
                            <label class="form-label">About Description</label>
                            <textarea class="form-control" name="founderDescription" rows="6" id="founderDescription">{{ $about->founderDescription ?? '' }}</textarea>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Vision</label>
                            <textarea class="form-control" name="vision" rows="4" id="vision">{{ $about->vision ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mission</label>
                            <textarea class="form-control" name="mission" rows="4" id="mission">{{ $about->mission ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Story Description</label>
                            <textarea class="form-control" name="storyDescription" rows="6" id="storyDescription">{{ $about->storyDescription ?? '' }}</textarea>
                        </div> --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">About us Image</label>
                                <input type="file" class="form-control" name="image1" accept="image/*">
                                @if($about && $about->image1)
                                    <img src="{{ asset('storage/' . $about->image1) }}" alt="Image 1" class="img-thumbnail mt-2" style="max-width: 100px;">
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Home Middle Image</label>
                                <input type="file" class="form-control" name="image2" accept="image/*">
                                @if($about && $about->image2)
                                    <img src="{{ asset('storage/' . $about->image2) }}" alt="Image 2" class="img-thumbnail mt-2" style="max-width: 100px;">
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Image 3</label>
                                <input type="file" class="form-control" name="image3" accept="image/*">
                                @if($about && $about->image3)
                                    <img src="{{ asset('storage/' . $about->image3) }}" alt="Image 3" class="img-thumbnail mt-2" style="max-width: 100px;">
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Image 4</label>
                                <input type="file" class="form-control" name="image4" accept="image/*">
                                @if($about && $about->image4)
                                    <img src="{{ asset('storage/' . $about->image4) }}" alt="Image 4" class="img-thumbnail mt-2" style="max-width: 100px;">
                                @endif
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Story Image</label>
                            <input type="file" class="form-control" name="storyImage" accept="image/*">
                            @if($about && $about->storyImage)
                                <img src="{{ asset('storage/' . $about->storyImage) }}" alt="Story Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                            @endif
                        </div> --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update About Hotel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Terms & Conditions Tab -->
            <div id="terms" class="tab-pane fade">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Terms & Conditions</h4>
                    @php $terms = App\Models\TermsCondition::first(); @endphp
                    <form action="{{ route('content-management.terms.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" name="content" rows="15" id="termsContent">{{ $terms->content ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="active" {{ ($terms->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ ($terms->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Terms & Conditions
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SEO Data Tab -->
            <div id="seo" class="tab-pane fade">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">SEO Data Management</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seoModal" onclick="resetSeoForm()">
                            <i class="fa fa-plus me-2"></i>Add SEO Data
                        </button>
                    </div>
                    @php $seoData = App\Models\SeoData::all(); @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Page Name</th>
                                    <th>Meta Title</th>
                                    <th>Meta Keywords</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seoData as $seo)
                                <tr>
                                    <td>{{ $seo->page_name }}</td>
                                    <td>{{ $seo->meta_title }}</td>
                                    <td>{{ Str::limit($seo->meta_keywords, 50) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editSeo({{ $seo->id }})">
                                            <i class="fa fa-edit"></i>
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
    </div>
</div>

<!-- SEO Modal -->
<div class="modal fade" id="seoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seoModalTitle">Add SEO Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="seoForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="seoFormErrors" class="alert alert-danger" style="display: none;"></div>
                    <input type="hidden" id="seo_id" name="id">
                    <div class="mb-3">
                        <label class="form-label">Page Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="seo_page_name" name="page_name" required>
                        <div class="invalid-feedback">Please provide a page name.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" class="form-control" id="seo_meta_title" name="meta_title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control" id="seo_meta_description" name="meta_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control" id="seo_meta_keywords" name="meta_keywords" placeholder="keyword1, keyword2, keyword3">
                        <small class="text-muted">Separate keywords with commas</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">OG Title</label>
                        <input type="text" class="form-control" id="seo_og_title" name="og_title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">OG Description</label>
                        <textarea class="form-control" id="seo_og_description" name="og_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">OG Image</label>
                        <input type="file" class="form-control" id="seo_og_image" name="og_image" accept="image/*">
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
$(document).ready(function() {
    // Initialize Summernote for all textareas
    $('#founderDescription, #vision, #mission, #storyDescription, #termsContent').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

let currentSeoId = null;

function resetSeoForm() {
    currentSeoId = null;
    const form = document.getElementById('seoForm');
    form.reset();
    form.classList.remove('was-validated');
    document.getElementById('seo_id').value = '';
    document.getElementById('seoModalTitle').textContent = 'Add SEO Data';
    document.getElementById('seoFormErrors').style.display = 'none';
    document.getElementById('seoFormErrors').innerHTML = '';
    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
}

function editSeo(id) {
    fetch(`{{ route('content-management.seo.show', ':id') }}`.replace(':id', id))
        .then(response => response.json())
        .then(data => {
            currentSeoId = id;
            document.getElementById('seo_id').value = data.id;
            document.getElementById('seo_page_name').value = data.page_name;
            document.getElementById('seo_meta_title').value = data.meta_title || '';
            document.getElementById('seo_meta_description').value = data.meta_description || '';
            document.getElementById('seo_meta_keywords').value = data.meta_keywords || '';
            document.getElementById('seo_og_title').value = data.og_title || '';
            document.getElementById('seo_og_description').value = data.og_description || '';
            document.getElementById('seoModalTitle').textContent = 'Edit SEO Data';
            new bootstrap.Modal(document.getElementById('seoModal')).show();
        });
}

document.getElementById('seoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const form = this;
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');
    
    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        form.querySelectorAll(':invalid').forEach(field => {
            field.classList.add('is-invalid');
        });
        return false;
    }
    
    submitBtn.disabled = true;
    spinner.classList.remove('d-none');
    
    const formData = new FormData(form);
    const url = currentSeoId 
        ? `{{ route('content-management.seo.update') }}?id=${currentSeoId}`
        : '{{ route('content-management.seo.store') }}';
    
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
            const modalElement = document.getElementById('seoModal');
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
            const errorDiv = document.getElementById('seoFormErrors');
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
        const errorDiv = document.getElementById('seoFormErrors');
        errorDiv.style.display = 'block';
        errorDiv.innerHTML = `<strong>Error:</strong> ${error.message || 'An error occurred. Please try again.'}`;
    });
});
</script>
@endsection
