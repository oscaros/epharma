<x-app-layout :assets="$assets ?? []">
    <!-- Create User Form -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create User</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}" class="row g-3 needs-validation" >
                            @csrf
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter user first name" required>
                            </div>

                            {{-- add field last name --}}
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter user last name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter user email" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter user phone number" required>
                            </div>
                            <div class="col-md-6">
                                <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-select" id="role_id" name="role_id" required>
                                    <option value="" selected disabled>Select user role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="branch_id" class="form-label">Entity <span class="text-danger">*</span></label>
                                <select class="form-select" id="entity_id" name="entity_id" required>
                                    <option value="" selected disabled>Select User Entity</option>
                                    @foreach ($entities as $entity)
                                        <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 justify-center">
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create User Form -->
</x-app-layout>

<!-- Script to check password strength and toggle password visibility -->
<script>
    // Function to calculate password strength
    function calculatePasswordStrength(password) {
        // Minimum length for a strong password
        var minLength = 8;

        // Regular expressions to match different character types
        var regex = {
            uppercase: /[A-Z]/,
            lowercase: /[a-z]/,
            number: /[0-9]/,
            special: /[^A-Za-z0-9]/
        };

        // Calculate score based on character types
        var score = 0;
        if (regex.uppercase.test(password)) score++;
        if (regex.lowercase.test(password)) score++;
        if (regex.number.test(password)) score++;
        if (regex.special.test(password)) score++;

        // Additional score for length
        if (password.length >= minLength) {
            score++;
        }

        return score;
    }

    // Function to update password strength indicator
    function updatePasswordStrength() {
        var passwordInput = document.getElementById('password');
        var passwordStrength = document.getElementById('password-strength');
        var strengthText = '';

        // Calculate password strength
        var strength = calculatePasswordStrength(passwordInput.value);

        // Determine strength text based on score
        switch (strength) {
            case 0:
            case 1:
                strengthText = 'Weak';
                break;
            case 2:
                strengthText = 'Moderate';
                break;
            case 3:
                strengthText = 'Strong';
                break;
            case 4:
                strengthText = 'Very Strong';
                break;
        }

        // Update strength indicator
        passwordStrength.textContent = 'Password Strength: ' + strengthText;
    }

    // Attach event listener to input field to update strength indicator on input
    document.getElementById('password').addEventListener('input', updatePasswordStrength);

    // Function to toggle password visibility
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var toggleButton = document.getElementById('togglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = 'Show';
        }
    }

    // Attach event listener to toggle button to toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', togglePasswordVisibility);
</script>
