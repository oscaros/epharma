<x-app-layout :assets="$assets ?? []">
    <!-- Create User Form -->
   <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Add Staff Member</h5>
                    </div>
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        {{-- add field first name --}}
                        <div class="mb-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="first_name" name="first_name" placeholder="Enter user first name" required>
                        </div>

                        {{-- add field last name --}}
                        <div class="mb-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="last_name" name="last_name" placeholder="Enter user last name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" class="form-input mt-1 block w-full rounded-md" id="email" name="email" placeholder="Enter user email" required>
                        </div>

                        {{-- add field phone number --}}
                        <div class="mb-3">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="phone_number" name="phone_number" required placeholder="Enter user phone number">
                        </div>

                        <!-- Role select field with Select2 -->
                        <div class="mb-3">
                            <label for="role_id" class="block text-sm font-medium text-gray-700">Role</label>
                            <select class="form-select w-full rounded-md" id="role_id" name="role_id" required>
                                <option value="" selected disabled>Select user role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>



                         <!-- department select field with Select2 -->
                         <div class="mb-3">
                            <label for="department_id" class="block text-sm font-medium text-gray-700">Service Point</label>
                            <select class="form-select w-full rounded-md" id="department_id" name="department_id" required>
                                <option value="" selected disabled>Select User's Service Point</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <!-- entity select field with Select2 -->
                        <div class="mb-3">
                            <label for="entity_id" class="block text-sm font-medium text-gray-700">Entity</label>
                            <select class="form-select w-full rounded-md" id="entity_id" name="entity_id" required>
                                <option value="" selected disabled>Select user entity</option>
                                @foreach($entities as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->EntityName }}</option>
                                @endforeach
                            </select>
                        </div>





                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Staff Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create User Form -->
</x-app-layout>


<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('#role_id').select2();
        $('#entity_id').select2();
        $('#department_id').select2();
    });
</script>

<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('#role_id').select2();
    });
</script>
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
</script>

