{{-- Add Product Form --}}
<x-app-layout :assets="$assets ?? []">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="max mx-auto bg-white shadow-md rounded-lg p-6">
            <h5 id ="drug" class="text-lg font-semibold mb-6">Add Drug</h5>
            <form method="POST" action="{{ route('products.store') }}" class="grid grid-cols-2 gap-x-6" novalidate
                enctype="multipart/form-data">
                @csrf

                 {{-- Type --}}
                 <div class="col-span-1">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type <span
                            class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-select mt-1 block w-full" required>
                        <option value="">Select Type</option>
                        <option value="Drug">Drug</option>
                        <option value="Service">Service</option>
                    </select>
                </div>



                 
                {{-- Insured --}}
                <div class="col-span-1">
                    <label for="Insured" class="block text-sm font-medium text-gray-700">Insured?</label>
                    <input type="hidden" name="Insured" id="Insured" value="0"> <!-- Hidden input to ensure a value is always sent -->
                    <input type="checkbox" id="Insured" name="Insured" value="1" class="form-checkbox mt-1 block">
                </div>



                <!-- department select field with Select2 -->
                <div class="mb-3">
                    <label for="department_id" class="block text-sm font-medium text-gray-700">Service Point</label>
                    <select class="form-select w-full rounded-md" id="department_id" name="department_id" required>
                        <option value="" selected disabled>Select Service Point</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>


                {{-- Product Name --}}
                <div class="col-span-1">
                    <label id="ProductName" for="ProductName" class="block text-sm font-medium text-gray-700">Drug Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="ProductName" name="ProductName" required
                        placeholder="Enter product name">
                </div>

                {{-- Price --}}
                <div class="col-span-1">
                    <label id="price" for="Price" class="block text-sm font-medium text-gray-700">Drug Price <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="Price" name="Price" required
                        placeholder="Enter product Price">
                    <!-- Hidden input field to store the raw numeric value -->
                    <input type="hidden" id="raw_price" name="Price" value="0">
                </div>

                {{-- Quantity --}}
                <div class="col-span-1" id="quantity">
                    <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity <span
                            class="text-danger">*</span></label>
                    <input type="number" class="form-input mt-1 block w-full" id="Quantity" name="Quantity" 
                        placeholder="Enter product Quantity">
                </div>

                {{-- Brand Name --}}
                <div class="col-span-1" id="brand">
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand Name<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="brand" name="brand" 
                        placeholder="Enter brand name">
                </div>

                {{-- Drug Class --}}
                {{-- <div class="col-span-1" id="drug_class">
                    <label for="drug_class" class="block text-sm font-medium text-gray-700">Drug Class<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="drug_class" name="drug_class" 
                        placeholder="Enter drug class">
                </div> --}}

                {{-- Expiry Date --}}
                {{-- <div class="col-span-1" id="expiry_date">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" class="form-input mt-1 block w-full" id="expiry_date" name="expiry_date"
                        placeholder="Enter expiry date">
                </div> --}}

               

                {{-- Submit Button --}}
                <div class="col-span-2">
                    <button type="submit" id="button"
                        class="bg-blue-500 text-white mt-4 px-4 py-2 rounded-md hover:bg-blue-600">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<style>
    /* Style for disabled inputs */
    input:disabled {
        background-color: black;
    }
</style>


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
        // $('#type').select2();
        $('#department_id').select2();
    });
</script>


<script>
    // Function to show or hide fields based on the selected type
    function toggleFields() {
        var type = document.getElementById('type').value;
        var productName = document.getElementById('ProductName');
        var price = document.getElementById('Price');
        var quantity = document.getElementById('Quantity');
        var brand = document.getElementById('brand');
        // var drugClass = document.getElementById('drug_class');
        // var expiryDate = document.getElementById('expiry_date');

        if (type === 'Drug') {
            // Show all fields
            productName.disabled = false;
            price.disabled = false;
            quantity.disabled = false;
            brand.disabled = false;
            drugClass.disabled = false;
            expiryDate.disabled = false;


            document.getElementById('quantity').style.display = 'block';
            document.getElementById('brand').style.display = 'block';
            // document.getElementById('drug_class').style.display = 'block';
            // document.getElementById('expiry_date').style.display = 'block';


            document.getElementById('ProductName').innerHTML = 'Drug Name *';
            document.getElementById('drug').innerHTML = 'Add Drug';
            document.getElementById('price').innerHTML = 'Drug Price *';
            document.getElementById('button').innerHTML = 'Add Drug';



        } else if (type === 'Service') {
            // Disable some fields for service type
            productName.disabled = false;
            //display none for price
            document.getElementById('quantity').style.display = 'none';
            document.getElementById('brand').style.display = 'none';
            // document.getElementById('drug_class').style.display = 'none';
            // document.getElementById('expiry_date').style.display = 'none';

            price.disabled = false;
            // quantity.disabled = true;
            // brand.disabled = true;
            // drugClass.disabled = true;
            // expiryDate.disabled = true;
            //change inner html for product to service
            document.getElementById('ProductName').innerHTML = 'Service Name';
            document.getElementById('drug').innerHTML = 'Add Service';
            document.getElementById('price').innerHTML = 'Service Price';
            document.getElementById('button').innerHTML = 'Add Service';
        }
    }

    // Add event listener to the type select
    document.getElementById('type').addEventListener('change', toggleFields);

    //add price input converter
    document.addEventListener('DOMContentLoaded', function() {
        // Get the balance input element
        var balanceInput = document.getElementById('Price');
        // Get the hidden input for raw balance
        var rawBalanceInput = document.getElementById('raw_price');

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

</script>
