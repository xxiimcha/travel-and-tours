@include('admin/partials.header-css')
@include('admin/partials.sidebar')
@include('admin/partials.top-content')

<style>
    input[type="file"] {
        display: block;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        background-color: #f8f9fa;
    }

    input[type="file"]::-webkit-file-upload-button {
        display: none;
    }

    #preview-container img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-top: 10px;
    }
</style>

<div class="container-fluid">
    <div class="shadow-lg p-4 mb-5 bg-body rounded">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 text-muted">Create Tour Itinerary</h1>
        </div>

        @if(session('success'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <form action="{{ route('create_tour_itinerary') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Row 1: Destination Name -->
            <div class="row mb-3 justify-content-center">
                <div class="col-md-6">
                    <label for="destination_name">Destination Name</label>
                    <select name="destination_name" class="form-control @error('destination_name') is-invalid @enderror">
                        <option value="" disabled selected>--- Select Category ---</option>
                        @foreach ($data as $destination)
                            <option value="{{ $destination->id }}-{{ $destination->destination_name }}">{{ $destination->destination_name }}</option>
                        @endforeach
                    </select>
                    @error('destination_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Row 2: Category and Day -->
            <div class="row mb-3 justify-content-center">
                <div class="col-md-6">
                    <label for="destination_category">Destination Category</label>
                    <input type="text" name="destination_category" value="{{ old('destination_category') }}" class="form-control @error('destination_category') is-invalid @enderror" placeholder="Enter category">
                    @error('destination_category') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="daily_itinerary">Day</label>
                    <select name="daily_itinerary" class="form-control @error('daily_itinerary') is-invalid @enderror">
                        <option value="" disabled selected>--- Select Day Of Itinerary ---</option>
                        @for ($i = 1; $i <= 15; $i++)
                            <option value="Day {{ $i }}">Day {{ $i }}</option>
                        @endfor
                    </select>
                    @error('daily_itinerary') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Row 3: Location and Image Upload -->
            <div class="row mb-3 justify-content-center">
                <div class="col-md-6">
                    <label for="destination_location">Destination Location</label>
                    <input type="text" name="destination_location" value="{{ old('destination_location') }}" class="form-control @error('destination_location') is-invalid @enderror" placeholder="Enter location">
                    @error('destination_location') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="image">Itinerary Image</label>
                    <input type="file" name="image" id="image-input" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    <div id="preview-container"></div>
                </div>
            </div>

            <!-- Row 4: Description -->
            <div class="row mb-3 justify-content-center">
                <div class="col-md-12">
                    <label for="destination_description">Destination Description</label>
                    <textarea name="destination_description" rows="6" class="form-control @error('destination_description') is-invalid @enderror">{{ old('destination_description') }}</textarea>
                    @error('destination_description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col text-end">
                    <button type="submit" class="btn btn-primary px-4">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview script
    document.getElementById('image-input').addEventListener('change', function (e) {
        const previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = ''; // Clear previous preview

        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (evt) {
                const img = document.createElement('img');
                img.src = evt.target.result;
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@include('admin/partials.footer')
