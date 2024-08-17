<x-app-layout :assets="$assets ?? []">
    <!-- Create Entity Form -->
   <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Edit Business</h5>
                    </div>
                    <form method="POST" action="{{ route('entities.update', $entity->id) }}">
                    
                        @csrf
                        @method('PUT')

                       
                        <div class="mb-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Business Name</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="EntityName" name="EntityName" placeholder="Enter entity name" value="{{ $entity->EntityName }}">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="Phone" name="Phone" placeholder="Enter entity phone" value="{{ $entity->Phone }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" class="form-input mt-1 block w-full rounded-md" id="Email" name="Email" placeholder="Enter entity email" value="{{ $entity->Email }}">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="Address" name="Address" placeholder="Enter entity address" value="{{ $entity->Address }}">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="block text-sm font-medium text-gray-700">Commission</label>
                            <input type="number" class="form-input mt-1 block w-full rounded-md" id="commission" name="commission" step="0.01" min="0" max="100" placeholder="0.00" value="{{ $entity->Commission}}">
                        </div>




                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Business</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create Entity Form -->
</x-app-layout>
