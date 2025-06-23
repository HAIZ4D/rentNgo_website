<!-- resources/views/cars/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="rentngo-container">
@include('navbarAdmin')
<link rel="stylesheet" href="{{ asset('css/admin_manage_cars.css') }}">

    <div class="main-content">
        <div class="add-car-section">
            <div class="add-card">
                <h2 class="section-title"><strong>ADD NEW CAR</strong></h2>

                <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Image Upload --}}
                    <div class="upload-box text-center">
                        <label for="carImage" class="upload-label">
                            <div class="upload-preview-wrapper">
                                <img id="imagePreview" src="#" alt="Image Preview" class="img-preview" style="display: none;" />
                                <div class="upload-placeholder" id="uploadPlaceholder">
                                    <div class="upload-icon">📷</div>
                                    <div class="upload-text">Click or drag an image here</div>
                                </div>
                            </div>
                        </label>
                        <input type="file" class="d-none" name="carImage" id="carImage" accept="image/*">
                        <small id="uploadStatus" class="text-muted" style="display: none;">Image ready for upload</small>
                    </div>
                    {{-- Car Fields --}}
                    
                    <div class="mb-2"><input type="text" name="carName" class="form-control" placeholder="Name" required></div>
                    <div class="mb-2"><input type="text" name="carModel" class="form-control" placeholder="Model" required></div>
                    <div class="mb-2"><input type="text" name="carType"  class="form-control" placeholder="Car Type" required></div>
                    <div class="mb-2"><input type="number" name="carSeat" class="form-control" placeholder="Seats" required></div>
                    <div class="mb-2"><input type="number" name="carMileage" class="form-control" placeholder="Mileage (km)" required></div>
                    <div class="mb-2"><input type="text" name="plateNumber" class="form-control" placeholder="Plate Number" required></div>
                    <div class="mb-2"><input type="number" step="0.01" name="pricePerDay" class="form-control" placeholder="Price Per Day (RM)" required></div>
                    <div class="mb-2"><input type="text" name="transmissionType" class="form-control" placeholder="Transmission Type" required></div>
                    <div class="mb-2"><input type="text" name="location" class="form-control" placeholder="Location" required></div>
                    <div class="mb-2"><input type="text" name="fuelType" class="form-control" placeholder="Fuel Type" required></div>
                    <div class="mb-2">
                        <select class="form-control" name="availabilityStatus">
                            <option value="Available" {{ (old('availabilityStatus', $car->availabilityStatus ?? '') == 'Available') ? 'selected' : '' }}>Available</option>
                            <option value="Unavailable" {{ (old('availabilityStatus', $car->availabilityStatus ?? '') == 'Unavailable') ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Available From</label>
                        <input type="date" name="availableFrom" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>

                    {{-- Divider Line --}}
                    <hr style="border-top: 1px solid #ccc; margin: 8px 0;">

                    <div class="mb-2">
                        <label>Available To</label>
                        <input type="date" name="availableTo" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="add-button">ADD</button>
                        <button type="reset" class="cancel-button">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="recent-car-section">
            <h2 class="section-title"><strong>CAR ADDED IN THE SYSTEM</strong></h2>

            @foreach($cars as $car)
                <div class="car-card">
                    <div class="car-card-left">
                        <img src="{{ asset('storage/' . $car->carImage) }}" alt="Car Image" class="car-image">
                    </div>
                    <div class="car-card-right">
                        <h5 class="car-title">{{ $car->carName }}</h5>
                        <p class="car-info">{{ $car->carModel }}</p>
                        <p class="car-info">{{ number_format($car->carMileage) }} km</p>
                        <p class="car-info">{{ $car->location }}</p>
                        <p class="car-price">RM{{ number_format($car->pricePerDay, 2) }} (Per Day)</p>
                        <div class="button-group">
                            <a href="{{ route('cars.edit', ['car' => $car->carID]) }}" class="update-button">UPDATE</a>
                            <form action="{{ route('cars.destroy', ['car' => $car->carID]) }}" method="POST" onsubmit="return confirm('Are you sure want to delete?');">
                                @csrf
                                <button type="submit" class="remove-button">REMOVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fromInput = document.querySelector('input[name="availableFrom"]');
        const toInput = document.querySelector('input[name="availableTo"]');
        fromInput.addEventListener('change', () => {
            toInput.min = fromInput.value;
        });

        // Image preview dekat form
        const carImage = document.getElementById("carImage");
        const imagePreview = document.getElementById("imagePreview");
        const uploadStatus = document.getElementById("uploadStatus");
        const placeholder = document.getElementById("uploadPlaceholder");

    carImage.addEventListener("change", function (event) {
        const file = event.target.files[0];
    if (file) {
        imagePreview.src = URL.createObjectURL(file);
        imagePreview.style.display = "block";
        placeholder.style.display = "none";
        uploadStatus.style.display = "block";
    } else {
        imagePreview.style.display = "none";
        placeholder.style.display = "flex";
        uploadStatus.style.display = "none";
    }
    });
});
</script>
@endsection