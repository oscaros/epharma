<x-app-layout :assets="$assets ?? []">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1">
            <div class="col-span-1 md:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Add Product </h5>
                    </div>
                    <form method="POST" action="{{ route('products.store') }}" class="row g-3 needs-validation" novalidate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-input mt-1 block w-full" id="name" name="name"
                                required placeholder="Enter product name">
                            {{-- <div class="invalid-feedback">
                                Please provide a product name.
                            </div> --}}
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-input mt-1 block w-full" id="price" name="price"
                                required placeholder="Enter product price">
                            <!-- Hidden input field to store the raw numeric value -->
                            <input type="hidden" id="raw_price" name="price" value="0">
                            {{-- <div class="invalid-feedback">
                                Please provide a price.
                            </div> --}}
                        </div>

                        <div class="col-md-6">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-input mt-1 block w-full" id="quantity" name="quantity"
                                required placeholder="Enter product quantity">
                            {{-- <div class="invalid-feedback">
                                Please provide a quantity.
                            </div> --}}
                        </div>

                        <div class="col-md-6">
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                            <input type="date" class="form-input mt-1 block w-full" id="expiry_date"
                                name="expiry_date" placeholder="Enter expiry date">
                        </div>

                       <div class="col-span-2">
                            <button type="submit"
                                class="bg-blue-500 text-white mt-4 px-4 py-2 rounded-md hover:bg-blue-600">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var priceInput = document.getElementById('price');
        var rawPriceInput = document.getElementById('raw_price');
        priceInput.addEventListener('input', function() {
            // Get the current value of the price input and remove non-numeric characters
            var priceValue = priceInput.value.replace(/[^\d.]/g, '');
            // Parse the numeric value
            var parsedPrice = parseFloat(priceValue);
            // Set the raw numeric value to the hidden input
            rawPriceInput.value = parsedPrice;
            // Format the price value (assuming you want to format it as a currency)
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
