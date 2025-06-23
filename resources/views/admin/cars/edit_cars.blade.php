@extends('layouts.app')

@section('content')
@include('navbar')

    <br>
    <h2 class="mb-4" style="text-align: center"><strong>UPDATE CAR - {{ $car->carModel }}</strong></h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('cars.update', $car->carID) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Existing image preview --}}
                        @if ($car->carImage)
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/' . $car->carImage) }}" class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                        @endif

                        {{-- Image Upload --}}
                        <div class="mb-3">
                            <label for="carImage" class="form-label">Upload New Image (optional)</label>
                            <input type="file" class="form-control" name="carImage" id="carImage">
                        </div>

                        {{-- Car Fields --}}
                        <div class="mb-2"><input type="text" name="carName" class="form-control" placeholder="Name" value="{{ $car->carName }}" required></div>
                        <div class="mb-2"><input type="text" name="carModel" class="form-control" placeholder="Model" value="{{ $car->carModel }}" required></div>
                        <div class="mb-2"><input type="text" name="carType" class="form-control" placeholder="Type" value="{{ $car->carType }}" required></div>
                        <div class="mb-2"><input type="number" name="carSeat" class="form-control" placeholder="Seats" value="{{ $car->carSeat }}" required></div>
                        <div class="mb-2"><input type="number" name="carMileage" class="form-control" placeholder="Mileage" value="{{ $car->carMileage }}" required></div>
                        <div class="mb-2"><input type="text" name="plateNumber" class="form-control" placeholder="Plate Number" value="{{ $car->plateNumber }}" required></div>
                        <div class="mb-2"><input type="number" step="0.01" name="pricePerDay" class="form-control" placeholder="Price Per Day (RM)" value="{{ $car->pricePerDay }}" required></div>
                        <div class="mb-2"><input type="text" name="transmissionType" class="form-control" placeholder="Transmission" value="{{ $car->transmissionType }}" required></div>
                        <div class="mb-2"><input type="text" name="location" class="form-control" placeholder="Location" value="{{ $car->location }}" required></div>
                        <div class="mb-2"><input type="text" name="fuelType" class="form-control" placeholder="Fuel Type" value="{{ $car->fuelType }}" required></div>
                        <div class="mb-2">
                            <label>Available From</label>
                            <input type="date" name="availableFrom" class="form-control" value="{{ $car->availableFrom }}" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-2">
                            <label>Available To</label>
                            <input type="date" name="availableTo" class="form-control" value="{{ $car->availableTo }}" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-2">
                            <label for="availabilityStatus" class="form-label">Availability Status</label>
                                <select name="availabilityStatus" id="availabilityStatus" class="form-control" required>
                                    <option value="Available" {{ $car->availabilityStatus == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Unavailable" {{ $car->availabilityStatus == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success px-4">Update</button>
                            <a href="{{ route('cars.manage') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fromInput = document.querySelector('input[name="availableFrom"]');
        const toInput = document.querySelector('input[name="availableTo"]');

        fromInput.addEventListener('change', () => {
            toInput.min = fromInput.value;
        });
    });
</script>

