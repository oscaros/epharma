<x-app-layout :assets="$assets ?? []">
    <!-- Edit Customer Form -->
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1">
            <div class="col-span-1 md:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="font-bold text-lg mb-4">
                        {{ __('Edit Customer Details') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('customers.update', $customer->id) }}"
                            class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name <span
                                        class="text-red-500"> *</span></label></label>
                                <input type="text" class="form-input mt-1 block w-full rounded-md" id="name"
                                    name="name" value="{{ $customer->FirstName.' '.$customer->LastName }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone
                                    Number <span class="text-red-500"> *</span></label></label>
                                <input type="text" class="form-input mt-1 block w-full rounded-md" id="phone_number"
                                    name="phone_number" value="{{ $customer->Phone }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nin" class="block text-sm font-medium text-gray-700">NIN</label>
                                <input type="text" class="form-input mt-1 block w-full rounded-md" id="nin"
                                    name="nin" value="{{ $customer->NIN }}">
                            </div>
                           

                         


                            {{-- customer address --}}
                            <div class="mb-3">
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" class="form-input mt-1 block w-full rounded-md" id="address"
                                    name="address" rows="3" required value="{{ $customer->Address }}">
                            </div>

                            <div class="col-span-1">
                                <label for="Insured" class="block text-sm font-medium text-gray-700">Insured?</label>
                                <input type="hidden" name="PInsured" id="PInsured" value="0"> <!-- Hidden input to ensure a value is always sent -->
                                <input type="checkbox" id="PInsured" name="PInsured" value="{{ $customer->PInsured }}" class="form-checkbox mt-1 block">
                            </div>
            
                        
                            <div class= "col-span-2 ">
                                <!-- Add other fields as needed -->
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update
                                    Patient Details</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Edit Customer Form -->
</x-app-layout>



<script>
    $(document).ready(function() {
        $('#customer_id').select2();
    });

    function formatAmount(value) {
        // Get the input element
        var input = document.getElementById('total_amount');

        // Update the disabled input with the formatted value
        document.getElementById('formatted_amount').value = formattedValue;
    }
</script>

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
            var formattedBalance = parsedBalance.toLocaleString('en-US', {
                style: 'currency',
                currency: 'UGX'
            });

            // Set the formatted value back to the input field
            balanceInput.value = formattedBalance;
            rawBalanceInput.value = parsedBalance;
        });
    });
</script>

