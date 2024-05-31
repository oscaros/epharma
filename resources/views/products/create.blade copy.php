{{-- Add Product Form --}}
<x-app-layout :assets="$assets ?? []">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="max mx-auto bg-white shadow-md rounded-lg p-6">
            <h5 class="text-lg font-semibold mb-6">Add Product</h5>
            <form method="POST" action="{{ route('products.store') }}" class="grid grid-cols-2 gap-x-6" novalidate
                enctype="multipart/form-data">
                @csrf

                 {{-- Type --}}
                 <div class="col-span-1">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type <span
                            class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-select mt-1 block w-full" required>
                        <option value="">Select Type</option>
                        <option value="Product">Medicine</option>
                        <option value="Service">Service</option>
                    </select>
                </div>

                
                {{-- Product Name --}}
                <div class="col-span-1">
                    <label for="ProductName" class="block text-sm font-medium text-gray-700">Product Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="ProductName" name="ProductName" required
                        placeholder="Enter product name">
                </div>

                {{-- Price --}}
                <div class="col-span-1">
                    <label for="Price" class="block text-sm font-medium text-gray-700">Price <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="Price" name="Price" required
                        placeholder="Enter product Price">
                    <!-- Hidden input field to store the raw numeric value -->
                    <input type="hidden" id="raw_price" name="Price" value="0">
                </div>

                {{-- Quantity --}}
                <div class="col-span-1">
                    <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity <span
                            class="text-danger">*</span></label>
                    <input type="number" class="form-input mt-1 block w-full" id="Quantity" name="Quantity" required
                        placeholder="Enter product Quantity">
                </div>

                {{-- Brand Name --}}
                <div class="col-span-1">
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand Name<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="brand" name="brand" required
                        placeholder="Enter brand name">
                </div>

                {{-- Drug Class --}}
                <div class="col-span-1">
                    <label for="drug_class" class="block text-sm font-medium text-gray-700">Drug Class<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="drug_class" name="drug_class" required
                        placeholder="Enter drug class">
                </div>

                {{-- Expiry Date --}}
                <div class="col-span-1">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" class="form-input mt-1 block w-full" id="expiry_date" name="expiry_date"
                        placeholder="Enter expiry date">
                </div>

               

                {{-- Submit Button --}}
                <div class="col-span-2">
                    <button type="submit"
                        class="bg-blue-500 text-white mt-4 px-4 py-2 rounded-md hover:bg-blue-600">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    // Function to show or hide fields based on the selected type
    function toggleFields() {
        var type = document.getElementById('type').value;
        var productName = document.getElementById('ProductName');
        var price = document.getElementById('Price');
        var quantity = document.getElementById('Quantity');
        var brand = document.getElementById('brand');
        var drugClass = document.getElementById('drug_class');
        var expiryDate = document.getElementById('expiry_date');

        if (type === 'medicine') {
            // Show all fields
            productName.disabled = false;
            price.disabled = false;
            quantity.disabled = false;
            brand.disabled = false;
            drugClass.disabled = false;
            expiryDate.disabled = false;
        } else if (type === 'service') {
            // Disable some fields for service type
            productName.disabled = true;
            price.disabled = true;
            quantity.disabled = true;
            brand.disabled = false;
            drugClass.disabled = false;
            expiryDate.disabled = false;
        }
    }

    // Add event listener to the type select
    document.getElementById('type').addEventListener('change', toggleFields);
</script>
