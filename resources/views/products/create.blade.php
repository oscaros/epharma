<x-app-layout :assets="$assets ?? []">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="max mx-auto bg-white shadow-md rounded-lg p-6">
            <h5 class="text-lg font-semibold mb-6">Add Item</h5>
            <form method="POST" action="{{ route('products.store') }}" class="grid grid-cols-2 gap-x-6" novalidate>
                @csrf

                {{-- Type --}}
                <div class="col-span-1">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type <span
                            class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-select mt-1 block w-full" required>
                        <option value="">Select Type</option>
                        <option value="Drug">Item</option>
                        <option value="Service">Service</option>
                    </select>
                </div>

                {{-- Insured --}}
                <div class="col-span-1">
                    <label for="Insured" class="block text-sm font-medium text-gray-700">Insured?</label>
                    <input type="hidden" name="Insured" value="0">
                    <input type="checkbox" id="Insured" name="Insured" value="1"
                        class="form-checkbox mt-1 block">
                </div>

                {{-- Departments --}}
                <div class="col-span-1">
                    <label for="departments" class="block text-sm font-medium text-gray-700">Service Points</label>
                    <select name="departments[]" id="departments" multiple class="form-select mt-1 block w-full"
                        required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Product Name --}}
                <div class="col-span-1">
                    <label for="ProductName" class="block text-sm font-medium text-gray-700">Item Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="ProductName" name="ProductName"
                        required placeholder="Enter product name">
                </div>

                {{-- Price --}}
                <div class="col-span-1">
                    <label for="Price" class="block text-sm font-medium text-gray-700">Price <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="Price" name="Price" required
                        placeholder="Enter product price">
                    <!-- Hidden input to store the raw numeric value -->
                    <input type="hidden" id="raw_price" name="raw_price" value="">
                </div>

                {{-- Quantity --}}
                <div class="col-span-1" id="quantity">
                    <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity <span
                            class="text-danger">*</span></label>
                    <input type="number" class="form-input mt-1 block w-full" id="Quantity" name="Quantity"
                        placeholder="Enter product quantity">
                </div>

                {{-- Brand Name --}}
                <div class="col-span-1" id="brand">
                    <label for="BrandNames" class="block text-sm font-medium text-gray-700">Brand Name</label>
                    <input type="text" class="form-input mt-1 block w-full" id="BrandNames" name="BrandNames"
                        placeholder="Enter brand name">
                </div>

                {{-- Drug Class --}}
                <div class="col-span-1" id="drug-class">
                    <label for="DrugClass" class="block text-sm font-medium text-gray-700">Item Classification</label>
                    <input type="text" class="form-input mt-1 block w-full" id="DrugClass" name="DrugClass"
                        placeholder="Enter drug class">
                </div>


                {{-- <button x-data="{}" x-on:click="$dispatch('open-modal', { id: 'database-notifications' })"
                    type="button">
                    Notifications
                </button> --}}

                {{-- Submit Button --}}
                <div class="col-span-2">
                    <button type="submit"
                        class="bg-blue-500 text-white mt-4 px-4 py-2 rounded-md hover:bg-blue-600">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<style>
    /* Style for disabled inputs */
    input:disabled {
        background-color: #f0f0f0;
    }
</style>

<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Initialize Select2 and Toggle Fields -->
<script>
    $(document).ready(function() {
        $('#departments').select2();
        toggleFields(); // Set initial state based on pre-selected type
    });

    function toggleFields() {
        var type = document.getElementById('type').value;
        var productName = document.getElementById('ProductName');
        var price = document.getElementById('Price');
        var quantity = document.getElementById('Quantity');
        var brand = document.getElementById('BrandNames');
        var drugClass = document.getElementById('DrugClass');

        if (type === 'Drug') {
            productName.disabled = false;
            price.disabled = false;
            quantity.disabled = false;
            brand.disabled = false;
            drugClass.disabled = false;

            document.getElementById('quantity').style.display = 'block';
            document.getElementById('brand').style.display = 'block';
            document.getElementById('drug-class').style.display = 'block';
            document.getElementById('ProductName').innerHTML = 'Drug Name <span class="text-danger">*</span>';
        } else if (type === 'Service') {
            productName.disabled = false;
            price.disabled = false;
            quantity.disabled = true;
            brand.disabled = true;
            drugClass.disabled = true;

            document.getElementById('quantity').style.display = 'none';
            document.getElementById('brand').style.display = 'none';
            document.getElementById('drug-class').style.display = 'none';
            document.getElementById('ProductName').innerHTML = 'Service Name <span class="text-danger">*</span>';
        }
    }

    document.getElementById('type').addEventListener('change', toggleFields);

    // Format price input as currency
    document.addEventListener('DOMContentLoaded', function() {
        var priceInput = document.getElementById('Price');
        var rawPriceInput = document.getElementById('raw_price');

        priceInput.addEventListener('input', function() {
            var priceValue = priceInput.value.replace(/[^\d.]/g, '');
            var parsedPrice = parseFloat(priceValue);
            if (!isNaN(parsedPrice)) {
                rawPriceInput.value = parsedPrice;
                priceInput.value = parsedPrice.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'UGX'
                });
            }
        });
    });
</script>
