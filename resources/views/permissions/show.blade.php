<x-app-layout :assets="$assets ?? []">
    <!-- Permission Details -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Permission Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="permission-name" class="form-label">Permission Name:</label>
                            <input type="text" class="form-control" id="permission-name" value="{{ $permission->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="permission-description" class="form-label">Description:</label>
                            <textarea class="form-control" id="permission-description" rows="3" readonly>{{ $permission->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Permission Details -->
</x-app-layout>
