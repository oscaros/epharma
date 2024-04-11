<x-app-layout :assets="$assets ?? []">
    <!-- Edit Product Form -->
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
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name:</label>
                            <input type="text" class="form-input mt-1 block w-full" id="name" name="name" value="{{ $product->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                            <input type="text" class="form-input mt-1 block w-full" id="price" name="price" value="{{ $product->price }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Current Stock/Quantity:</label>
                            <input type="number" class="form-input mt-1 block w-full" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="new_quantity" class="block text-sm font-medium text-gray-700">New Stock/Quantity:</label>
                            <input type="number" class="form-input mt-1 block w-full" id="new_quantity" name="new_quantity" value="" required>
                        </div>

                        {{-- expiry date --}}
                        <div class="mb-4">
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date:</label>
                            <input type="date" class="form-input mt-1 block w-full" id="expiry_date" name="expiry_date" value="{{ $product->expiry_date }}" required>
                        </div>

                        
                       
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Edit Product Form -->
</x-app-layout>
