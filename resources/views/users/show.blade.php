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
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of User Details -->
</x-app-layout>
