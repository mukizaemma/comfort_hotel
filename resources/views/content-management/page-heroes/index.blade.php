@extends('layouts.adminBase')

@section('content')
@include('content-management.includes.sidebar')
<div class="content">
    @include('admin.includes.navbar')

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Page Hero Sections Management</h4>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Validation Errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                @foreach($pageHeroes as $pageHero)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $pageHero->page_name }}</h5>
                            <span class="badge bg-{{ $pageHero->is_active ? 'success' : 'secondary' }}">
                                {{ $pageHero->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="card-body">
                            @if($pageHero->background_image)
                                <img src="{{ asset('storage/' . $pageHero->background_image) }}" 
                                     class="img-fluid rounded mb-3" 
                                     alt="{{ $pageHero->page_name }}"
                                     style="max-height: 200px; width: 100%; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded mb-3 d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <i class="fa fa-image fa-3x text-white-50"></i>
                                </div>
                            @endif
                            
                            @if($pageHero->caption)
                                <p class="text-muted mb-2"><strong>Caption:</strong> {{ $pageHero->caption }}</p>
                            @endif
                            
                            @if($pageHero->description)
                                <p class="text-muted mb-2"><small>{{ Str::limit($pageHero->description, 100) }}</small></p>
                            @endif
                            
                            <button type="button" class="btn btn-primary btn-sm w-100" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editHeroModal{{ $pageHero->id }}">
                                <i class="fa fa-edit me-2"></i>Edit Hero
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal for each page -->
                <div class="modal fade" id="editHeroModal{{ $pageHero->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Hero Section - {{ $pageHero->page_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('content-management.page-heroes.update', $pageHero->id) }}" 
                                  method="POST" 
                                  enctype="multipart/form-data"
                                  id="heroForm{{ $pageHero->id }}"
                                  onsubmit="return validateHeroForm({{ $pageHero->id }})">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Background Image</label>
                                        @if($pageHero->background_image)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $pageHero->background_image) }}" 
                                                     class="img-fluid rounded" 
                                                     alt="Current image"
                                                     style="max-height: 200px;">
                                            </div>
                                        @endif
                                        <input type="file" 
                                               class="form-control" 
                                               name="background_image" 
                                               accept="image/*">
                                        <small class="form-text text-muted">Upload a new image to replace the current one (Max: 2MB)</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Caption</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="caption" 
                                               value="{{ $pageHero->caption }}" 
                                               placeholder="e.g., Welcome to Our Hotel">
                                        <small class="form-text text-muted">Main heading text displayed on the hero section</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" 
                                                  name="description" 
                                                  rows="3" 
                                                  placeholder="Optional description or subtitle">{{ $pageHero->description }}</textarea>
                                        <small class="form-text text-muted">Optional subtitle or description text</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="is_active" 
                                                   value="1"
                                                   id="is_active{{ $pageHero->id }}" 
                                                   {{ $pageHero->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active{{ $pageHero->id }}">
                                                Active (Show this hero section on the page)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Hero</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function validateHeroForm(id) {
    const form = document.getElementById('heroForm' + id);
    const formData = new FormData(form);
    
    // Check if at least one field is being updated
    const hasImage = formData.get('background_image') && formData.get('background_image').size > 0;
    const hasCaption = formData.get('caption') !== null;
    const hasDescription = formData.get('description') !== null;
    const hasActive = formData.get('is_active') !== null;
    
    if (!hasImage && !hasCaption && !hasDescription && !hasActive) {
        alert('Please update at least one field.');
        return false;
    }
    
    // Check file size if image is being uploaded
    if (hasImage) {
        const file = formData.get('background_image');
        if (file.size > 2048 * 1024) { // 2MB in bytes
            alert('Image size must be less than 2MB.');
            return false;
        }
    }
    
    return true;
}

// Debug: Log form submission
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[id^="heroForm"]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            console.log('Form submitting:', this.action);
            console.log('Form data:', new FormData(this));
        });
    });
});
</script>
@endsection
