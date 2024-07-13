<x-app-layout :assets="$assets ?? []">
    <!-- Edit Product Form -->
     <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="col-span-1 lg:col-span-2">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Edit Product</h5>
                    </div>
                    {{-- <form method="POST" action="{{ route('products.update', $product->id) }}"> --}}
                        <form method="POST" action="{{ route('products_temp.store') }}">
                        @csrf
                        @method('POST')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name:</label>
                            <input type="text" class="form-input mt-1 block w-full" id="name" name="ProductName" value="{{ $product->ProductName }}" required>
                        </div>

                        {{-- serial number --}}
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-gray-700">Serial Number:</label>
                            <input readonly type="text" class="form-input mt-1 block w-full" id="serial_number" name="serial_number" value="{{ $product->serial_number }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                            <input type="text" class="form-input mt-1 block w-full" id="price" name="Price" value="{{ $product->Price }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Current Stock/Quantity:</label>
                            <input type="number" class="form-input mt-1 block w-full" id="quantity" name="Quantity" value="{{ $product->Quantity }}" required>
                        </div>

                      


                        {{-- Insured --}}
                <div class="col-span-1">
                    <label for="Insured" class="block text-sm font-medium text-gray-700">Insured?</label>
                    <input type="hidden" name="Insured" id="Insured" value="0"> <!-- Hidden input to ensure a value is always sent -->
                    <input type="checkbox" id="Insured" name="Insured" value="{{ $product->Insured }}" class="form-checkbox mt-1 block">
                </div>



                <!-- department select field with Select2 -->
                <div class="mb-3">
                    <label for="department_id" class="block text-sm font-medium text-gray-700">Service Point</label>
                    <select class="form-select w-full rounded-md" id="department_id" name="department_id" required>
                        <option value="" selected disabled>Select Service Point</option>
                        @foreach($departments as $department)
                        <option value="{{ $product->department_id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                       

                        
                       
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Edit Product Form -->
</x-app-layout>
