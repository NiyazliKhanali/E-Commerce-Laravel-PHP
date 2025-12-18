@extends('layouts.app')

@section('title', 'Edit Vehicle - Admin')

@section('styles')
<style>
    .form-section {
        transition: all 0.3s ease;
    }
    
    .input-field:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .image-preview {
        position: relative;
        overflow: hidden;
    }
    
    .image-preview img {
        transition: transform 0.3s ease;
    }
    
    .image-preview:hover img {
        transform: scale(1.05);
    }
    
    .delete-image-btn {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border-radius: 50%;
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .delete-image-btn:hover {
        background: rgba(220, 38, 38, 1);
        transform: scale(1.1);
    }
</style>
@endsection

@section('content')
<!-- ===== Header ===== -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-12 text-white">
    <div class="container mx-auto px-4">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.cars.index') }}" class="text-blue-100 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-4xl font-bold">Edit Vehicle</h1>
        </div>
        <p class="text-blue-100">Update vehicle details and information</p>
    </div>
</section>

<!-- ===== Form ===== -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="form-section bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Basic Information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="model_name" class="block text-sm font-semibold text-gray-700 mb-2">Model Name *</label>
                        <input type="text" 
                               id="model_name" 
                               name="model_name" 
                               value="{{ old('model_name', $car->model_name) }}"
                               required 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('model_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="brand" class="block text-sm font-semibold text-gray-700 mb-2">Brand *</label>
                        <input type="text" 
                               id="brand" 
                               name="brand" 
                               value="{{ old('brand', $car->brand) }}"
                               required 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('brand')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">Year *</label>
                        <input type="number" 
                               id="year" 
                               name="year" 
                               value="{{ old('year', $car->year) }}"
                               min="1900" 
                               max="{{ date('Y') + 1 }}" 
                               required 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('year')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price (USD) *</label>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price', $car->price) }}"
                               min="0" 
                               step="0.01" 
                               required 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mileage" class="block text-sm font-semibold text-gray-700 mb-2">Mileage (km) *</label>
                        <input type="number" 
                               id="mileage" 
                               name="mileage" 
                               value="{{ old('mileage', $car->mileage) }}"
                               min="0" 
                               required 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('mileage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">Color *</label>
                        <input type="text" 
                               id="color" 
                               name="color" 
                               value="{{ old('color', $car->color) }}"
                               required 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('color')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Technical Details -->
            <div class="form-section bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Technical Details
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="fuel_type" class="block text-sm font-semibold text-gray-700 mb-2">Fuel Type *</label>
                        <input type="text" 
                               id="fuel_type" 
                               name="fuel_type" 
                               value="{{ old('fuel_type', $car->fuel_type) }}"
                               required 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">

                        @error('fuel_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="transmission" class="block text-sm font-semibold text-gray-700 mb-2">Transmission *</label>
                        <select id="transmission" 
                                name="transmission" 
                                required 
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                            <option value="">Select Transmission</option>
                            <option value="Avtomat" {{ old('transmission', $car->transmission) == 'Avtomat' ? 'selected' : '' }}>Avtomat</option>
                            <option value="Mexanik" {{ old('transmission', $car->transmission) == 'Mexanik' ? 'selected' : '' }}>Mexanik</option>
                            <option value="Custom" {{ old('transmission') == 'Custom' ? 'selected' : '' }}>Add New</option>
                        </select>
                        <input type="text"
                            id="transmission_custom_input"
                            name="transmission_custom"
                            placeholder="Enter new transmission type"
                            value="{{ old('transmission_custom') }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition mt-2"
                            style="display: none;">
                        @error('transmission')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <script>
                            document.getElementById('transmission').addEventListener('change', function() {
                                var customInput = document.getElementById('transmission_custom_input');
                                if (this.value === 'Custom') {
                                    customInput.style.display = 'block';
                                } else {
                                    customInput.style.display = 'none';
                                    customInput.value = '';
                                }
                            });
                        </script>
                    </div>

                    <div>
                        <label for="engine_size" class="block text-sm font-semibold text-gray-700 mb-2">Engine Size (L)</label>
                        <input type="number" 
                               id="engine_size" 
                               name="engine_size" 
                               value="{{ old('engine_size', $car->engine_size) }}"
                               min="0" 
                               step="0.1" 
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('engine_size')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <input type="text" 
                               id="category" 
                               name="category" 
                               value="{{ old('category', $car->category) }}"
                               class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="form-section bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Description
                </h2>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Vehicle Description</label>
                    <textarea id="description" 
                              name="description" 
                              rows="6" 
                              class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition resize-none">{{ old('description', $car->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Existing Images -->
            @if($car->images->count() > 0)
            <div class="form-section bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Current Images
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($car->images as $image)
                    <div class="image-preview relative rounded-lg overflow-hidden border-2 border-gray-200">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="Car image" 
                             class="w-full h-32 object-cover">
                        <button type="button" 
                                class="delete-image-btn"
                                onclick="deleteImage({{ $image->id }})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- New Images -->
            <div class="form-section bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Images
                </h2>

                <div>
                    <label for="images" class="block text-sm font-semibold text-gray-700 mb-2">Upload New Images (Multiple allowed)</label>
                    <input type="file" 
                           id="images" 
                           name="images[]" 
                           multiple 
                           accept="image/*" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                    <p class="text-sm text-gray-500 mt-2">Add more images to this vehicle. Recommended size: 1200x800px</p>
                    @error('images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
            </div>

            <!-- Status -->
            <div class="form-section bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Status
                </h2>

                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Publication Status *</label>
                    <select id="status" 
                            name="status" 
                            required 
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition">
                        <option value="active" {{ old('status', $car->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $car->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-bold text-lg hover:shadow-lg transform hover:scale-105 transition">
                    Update Vehicle
                </button>
                <a href="{{ route('admin.cars.index') }}" class="flex-1 px-8 py-4 bg-gray-100 text-gray-700 text-center rounded-lg font-bold text-lg hover:bg-gray-200 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

<script>
// Preview new images
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    const files = Array.from(e.target.files);
    
    files.forEach(file => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'image-preview relative rounded-lg overflow-hidden border-2 border-gray-200';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="w-full h-32 object-cover">
                `;
                preview.appendChild(div);
            }
            
            reader.readAsDataURL(file);
        }
    });
});

// Delete existing image
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/cars/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the image');
        });
    }
}
</script>
@endsection