<x-app-layout>
    <!-- Add Customer Form -->
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1">
            <div class="col-span-1 md:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h1 class="text-lg font-semibold mb-6">Add Customer</h1>
                    <form method="POST" action="{{ route('customers.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4" enctype="multipart/form-data">
                        @csrf

                        <!-- Customer Information -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input mt-1 block w-full" id="name" name="name" placeholder="Enter name" required>
                            <div class="invalid-feedback hidden">
                                Please provide a name.
                            </div>
                        </div>

                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input mt-1 block w-full" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                            <div class="invalid-feedback hidden">
                                Please provide a phone number.
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Customer Address</label>
                            <input type="text" class="form-input mt-1 block w-full" id="address" name="address" placeholder="Enter customer address">
                        </div>

                        <div>
                            <label for="nin" class="block text-sm font-medium text-gray-700">NIN</label>
                            <input type="text" class="form-input mt-1 block w-full" id="nin" name="nin" placeholder="Enter your NIN">
                        </div>

                        <div>
                            <label for="picture" class="block text-sm font-medium text-gray-700">Picture</label>
                            <input type="file" class="form-input mt-1 block w-full" id="picture" name="picture">
                            <div class="invalid-feedback hidden">
                                Please provide a valid image for the picture.
                            </div>
                        </div>

                        <div>
                            <label for="balance" class="block text-sm font-medium text-gray-700">Current Advance Balance</label>
                            <input type="text" class="form-input mt-1 block w-full" id="balance" name="balance" value="0">
                            <!-- Hidden input field to store the raw numeric value -->
                            <input type="hidden" id="raw_balance" name="raw_balance" value="0">
                        </div>

                        <!-- Guarantor Information -->
                        <div>
                            <label for="guarantor_name" class="block text-sm font-medium text-gray-700">Guarantor Name </label>
                            <input type="text" class="form-input mt-1 block w-full" id="guarantor_name" name="guarantor_name" placeholder="Enter guarantor's name">
                            <div class="invalid-feedback hidden">
                                Please provide the guarantor's name.
                            </div>
                        </div>

                        <div>
                            <label for="guarantor_location" class="block text-sm font-medium text-gray-700">Guarantor Location </label>
                            <input type="text" class="form-input mt-1 block w-full" id="guarantor_location" name="guarantor_location" placeholder="Enter guarantor's location" >
                            <div class="invalid-feedback hidden">
                                Please provide the guarantor's location.
                            </div>
                        </div>

                        <div>
                            <label for="guarantor_phone_number" class="block text-sm font-medium text-gray-700">Guarantor Phone Number</label>
                            <input type="text" class="form-input mt-1 block w-full" id="guarantor_phone_number" name="guarantor_phone_number" placeholder="Enter guarantor's phone number">
                            <div class="invalid-feedback hidden">
                                Please provide the guarantor's phone number.
                            </div>
                        </div>

                        <div>
                            <label for="guarantor_picture" class="block text-sm font-medium text-gray-700">Guarantor Picture</label>
                            <input type="file" class="form-input mt-1 block w-full" id="guarantor_picture" name="guarantor_picture">
                            <div class="invalid-feedback hidden">
                                Please provide a valid image for the guarantor's picture.
                            </div>
                        </div>

                        <!-- Care Information -->
                        <div>
                            <label for="care_name" class="block text-sm font-medium text-gray-700">Care of Name</label>
                            <input type="text" class="form-input mt-1 block w-full" id="care_name" name="care_name" placeholder="Enter care of  name">
                            <div class="invalid-feedback hidden">
                                Please provide the care of name.
                            </div>
                        </div>

                        <div>
                            <label for="care_phone_number" class="block text-sm font-medium text-gray-700">Care of Phone Number </label>
                            <input type="text" class="form-input mt-1 block w-full" id="care_phone_number" name="care_phone_number" placeholder="Enter care's phone number">
                            <div class="invalid-feedback hidden">
                                Please provide the care of name's phone number.
                            </div>
                        </div>

                        <div>
                            <label for="care_picture" class="block text-sm font-medium text-gray-700">Care of Picture</label>
                            <input type="file" class="form-input mt-1 block w-full" id="care_picture" name="care_picture">
                            <div class="invalid-feedback hidden">
                                Please provide a valid image for the care of name's picture.
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-span-2">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" type="submit">Add Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Add Customer Form -->


</x-app-layout>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the balance input element
        var balanceInput = document.getElementById('balance');
        // Get the hidden input for raw balance
        var rawBalanceInput = document.getElementById('raw_balance');

        // Add event listener for input event
        balanceInput.addEventListener('input', function() {
            // Get the current value of the balance input and remove non-numeric characters
            var balanceValue = balanceInput.value.replace(/[^\d.]/g, '');

            // Parse the numeric value
            var parsedBalance = parseFloat(balanceValue);

            // Set the raw numeric value to the hidden input
            rawBalanceInput.value = parsedBalance;

            // Format the balance value (assuming you want to format it as a currency)
            var formattedBalance =
                parsedBalance.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'UGX'
                });

            // Set the formatted value back to the input field
            balanceInput.value = formattedBalance;
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Get the form element
        var form = document.querySelector('form');
        //get hidden class
        var hidden = document.querySelector('hidden');

        // Add submit event listener to the form
        form.addEventListener('submit', function(event) {
            // Get the input elements
            var nameInput = document.getElementById('name');
            var phoneInput = document.getElementById('phone_number');
            var guarantorNameInput = document.getElementById('guarantor_name');
            var guarantorLocationInput = document.getElementById('guarantor_location');
            var guarantorPhoneInput = document.getElementById('guarantor_phone_number');
            var careNameInput = document.getElementById('care_name');
            var carePhoneInput = document.getElementById('care_phone_number');

            // Check if any of the required fields are empty
            if (nameInput.value.trim() === '' || phoneInput.value.trim() === '' || guarantorNameInput.value.trim() === '' || guarantorLocationInput.value.trim() === '' || guarantorPhoneInput.value.trim() === '' || careNameInput.value.trim() === '' || carePhoneInput.value.trim() === '') {
                // Prevent form submission
                event.preventDefault();

                // Show the invalid feedback
                var invalidFeedback = document.querySelectorAll('.invalid-feedback');
                invalidFeedback.forEach(function(feedback) {
                    feedback.style.display = 'block';
                    //remove hidden class
                    hidden.classList.remove('hidden');
                    feedback.style.color = 'red';
                    
                });

                // Scroll to the top of the form to show the feedback
                window.scrollTo({ top: form.offsetTop, behavior: 'smooth' });
            }
        });
    });
</script>
