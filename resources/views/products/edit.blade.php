<x-app-layout :assets="$assets ?? []">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="col-span-1 lg:col-span-2">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Edit Product</h5>
                    </div>
                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="ProductName" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" class="form-input mt-1 block w-full" id="ProductName" name="ProductName" value="{{ $product->ProductName }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="Price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="text" class="form-input mt-1 block w-full" id="Price" name="Price" value="{{ number_format($product->Price, 2) }}" required>
                            <!-- Hidden input to store the raw numeric value -->
                            <input type="hidden" id="raw_price" name="raw_price" value="{{ $product->Price }}">
                        </div>

                        <div class="mb-4">
                            <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" class="form-input mt-1 block w-full" id="Quantity" name="Quantity" value="{{ $product->Quantity }}">
                        </div>

                        <div class="mb-4">
                            <label for="BrandNames" class="block text-sm font-medium text-gray-700">Brand Name</label>
                            <input type="text" class="form-input mt-1 block w-full" id="BrandNames" name="BrandNames" value="{{ $product->BrandNames }}">
                        </div>

                        <div class="mb-4">
                            <label for="DrugClass" class="block text-sm font-medium text-gray-700">Drug Class</label>
                            <input type="text" class="form-input mt-1 block w-full" id="DrugClass" name="DrugClass" value="{{ $product->DrugClass }}">
                        </div>

                        <div class="mb-4">
                            <label for="Insured" class="block text-sm font-medium text-gray-700">Insured?</label>
                            <input type="hidden" name="Insured" value="0">
                            <input type="checkbox" id="Insured" name="Insured" value="1" class="form-checkbox mt-1 block" {{ $product->Insured ? 'checked' : '' }}>
                        </div>

                        <div class="mb-4">
                            <label for="departments" class="block text-sm font-medium text-gray-700">Service Points</label>
                            <select name="departments[]" id="departments" multiple class="form-select mt-1 block w-full" required>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ in_array($department->id, $product->departments->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Initialize Select2 and Price Formatting -->
<script>
    $(document).ready(function() {
        $('#departments').select2();

        // Initialize price field formatting
        var priceInput = document.getElementById('Price');
        var rawPriceInput = document.getElementById('raw_price');

        priceInput.addEventListener('input', function() {
            var priceValue = priceInput.value.replace(/[^\d.]/g, '');
            var parsedPrice = parseFloat(priceValue);
            if (!isNaN(parsedPrice)) {
                rawPriceInput.value = parsedPrice;
                priceInput.value = parsedPrice.toLocaleString('en-US', { style: 'currency', currency: 'UGX' });
            }
        });
    });
</script>
