<x-app-layout :assets="$assets ?? []">
    <!-- Edit User Form -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit User</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                           
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number:</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role:</label>
                                <select class="form-select" id="role_id" name="role_id" required>
                                    <option value="">Select a role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="branch_id" class="form-label">Entity:</label>
                                <select class="form-select" id="entity_id" name="entity_id" required>
                                    <option value="">Select a branch</option>
                                    @foreach($entities as $entity)
                                    <option value="{{ $entity->id }}" {{ $user->entity_id == $entity->id ? 'selected' : '' }}>{{ $entity->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Edit User Form -->
</x-app-layout>
