@include('admin/partials.header-css')
@include('admin/partials.sidebar')
@include('admin/partials.top-content')

<div class="container-fluid">
    <div class="shadow-lg p-4 mb-5 bg-body rounded">
        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 text-muted">Create Tour</h1>
        </div>

        <!-- Tour Creation Form -->
        <form id="createTourForm" action="{{ route('create-destination-api') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Row 1: Tour Type, Location Type, Location, Price -->
            <div class="row">
                <div class="col-md-3">
                    <label for="tour_type">Tour Type:</label>
                    <select class="form-control" name="tour_type">
                        <option value="solo">Solo</option>
                        <option value="group">Group</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="location_type">Location Type:</label>
                    <select class="form-control" name="location_type">
                        <option value="">Select Location Type</option>
                        <option value="local">Local</option>
                        <option value="international">International</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="location">Location:</label>
                    <select class="form-control" name="location">
                        <option value="">Select Location</option>
                        <!-- Dynamically Populate Locations Here -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" name="price" value="₱ 0.00" readonly>
                </div>
            </div>

            <!-- Row 2: Date, Duration (Days/Nights), Availability -->
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" name="date">
                </div>
                <div class="col-md-3">
                    <label for="duration_days">Duration:</label>
                    <div class="d-flex">
                        <input type="number" class="form-control me-2" name="duration_days" value="1">
                        <span class="mt-2">Days</span>
                        <input type="number" class="form-control ms-2" name="duration_nights" value="0">
                        <span class="mt-2">Nights</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="availability">Availability:</label>
                    <input type="text" class="form-control" name="availability" value="Available" readonly>
                </div>
                <div class="col-md-3">
                    <label for="tour_guide">Tour Guide:</label>
                    <input type="text" class="form-control" name="tour_guide" placeholder="Enter tour guide name">
                </div>
            </div>

            <!-- Row 3: Image Upload, Packages -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="col-md-6">
                    <label for="packages">Packages:</label>
                    <textarea class="form-control" name="packages" placeholder="List included packages (e.g., accommodations, meals, activities)"></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mt-4">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Save Tour</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('admin/partials.footer')
