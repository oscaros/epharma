<x-app-layout :assets="$assets ?? []">
    <!-- User Details -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>User Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" value="{{ $user->first_name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" value="{{ $user->last_name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" value="{{ $user->phone_number }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <input type="text" class="form-control" id="role" value="{{ $user->role->name }}" readonly>
                        </div>
                         <div class="mb-3">
                            <label for="branch" class="form-label">Branch:</label>
                            <input type="text" class="form-control" id="branch" value="{{ $user->branch ? $user->branch->name : 'N/A' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="business" class="form-label">Business:</label>
                            <input type="text" class="form-control" id="business" value="{{ $user->business ? $user->business->name : 'N/A' }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of User Details -->
</x-app-layout>
