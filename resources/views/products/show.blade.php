<x-app-layout :assets="$assets ?? []">
    <!-- Product Details Page -->
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="col-span-1 lg:col-span-2">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Product Details</h5>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name:</label>
                        <p id="name" class="mt-1 block w-full">{{ $product->ProductName }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="serial_number" class="block text-sm font-medium text-gray-700">Serial Number:</label>
                        <p id="serial_number" class="mt-1 block w-full">{{ $product->serial_number }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                        <p id="price" class="mt-1 block w-full">{{ $product->Price }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Current Stock/Quantity:</label>
                        <p id="quantity" class="mt-1 block w-full">{{ $product->Quantity }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="insured" class="block text-sm font-medium text-gray-700">Insured:</label>
                        <p id="insured" class="mt-1 block w-full">{{ $product->Insured ? 'Yes' : 'No' }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="department_id" class="block text-sm font-medium text-gray-700">Service Point:</label>
                        <p id="department_id" class="mt-1 block w-full">{{ $departments->firstWhere('id', $product->department_id)->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Product Details Page -->
</x-app-layout>
