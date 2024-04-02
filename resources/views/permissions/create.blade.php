<x-app-layout :assets="$assets ?? []">
    <!-- Create Permission Form -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Permission</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.store') }}" class="row g-3 needs-validation" novalidate>
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">
                                    Please provide a name.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                                <div class="invalid-feedback">
                                    Please provide a description.
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Add Permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create Permission Form -->
</x-app-layout>
