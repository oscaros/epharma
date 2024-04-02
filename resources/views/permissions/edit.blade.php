<x-app-layout :assets="$assets ?? []">
    <!-- Edit Permission Form -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Permission</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="permission-name" class="form-label">Permission Name:</label>
                                <input type="text" class="form-control" id="permission-name" name="name" value="{{ $permission->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="permission-description" class="form-label">Description:</label>
                                <textarea class="form-control" id="permission-description" name="description" rows="3" required>{{ $permission->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Permission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Edit Permission Form -->
</x-app-layout>
