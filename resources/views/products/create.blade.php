<x-app-layout :assets="$assets ?? []">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="max mx-auto bg-white shadow-md rounded-lg p-6">
            <h5 class="text-lg font-semibold mb-6">Add Product</h5>
            <form method="POST" action="{{ route('products.store') }}" class="grid grid-cols-2 gap-x-6" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="col-span-1">
                    <label for="ProductName" class="block text-sm font-medium text-gray-700">Product Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="ProductName" name="ProductName" required
                        placeholder="Enter product name">
                </div>

                <div class="col-span-1">
                    <label for="Price" class="block text-sm font-medium text-gray-700">Price <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-input mt-1 block w-full" id="Price" name="Price" required
                        placeholder="Enter product Price">
                    <!-- Hidden input field to store the raw numeric value -->
                    <input type="hidden" id="raw_price" name="Price" value="0">
                </div>

                <div class="col-span-1">
                    <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity <span
                            class="text-danger">*</span></label>
                    <input type="number" class="form-input mt-1 block w-full" id="Quantity" name="Quantity" required
                        placeholder="Enter product Quantity">
                </div>

                <div class="col-span-1">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" class="form-input mt-1 block w-full" id="expiry_date" name="expiry_date"
                        placeholder="Enter expiry date">
                </div>

                <div class="col-span-2">
                    <button type="submit"
                        class="bg-blue-500 text-white mt-4 px-4 py-2 rounded-md hover:bg-blue-600">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the Price input element
        var priceInput = document.getElementById('Price');
        // Get the hidden input for raw Price
        var rawPriceInput = document.getElementById('raw_price');

        // Add event listener for input event
        priceInput.addEventListener('input', function() {
            // Get the current value of the Price input and remove non-numeric characters
            var priceValue = priceInput.value.replace(/[^\d.]/g, '');

            // Parse the numeric value
            var parsedPrice = parseFloat(priceValue);

            // Set the raw numeric value to the hidden input
            rawPriceInput.value = parsedPrice;

            // Format the Price value (assuming you want to format it as a currency)
            var formattedPrice =
                parsedPrice.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'UGX'
                });

            // Set the formatted value back to the input field
            priceInput.value = formattedPrice;
        });
    });

    </script>