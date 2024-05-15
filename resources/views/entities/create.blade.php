<x-app-layout :assets="$assets ?? []">
    <!-- Create Entity Form -->
   <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Create Entity</h5>
                    </div>
                    <form method="POST" action="{{ route('entities.store') }}">
                        @csrf

                        {{-- add field  name --}}
                        <div class="mb-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Entity Name</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="name" name="EntityName" placeholder="Enter entity name" required>
                        </div>

                        {{-- entity phone --}}
                        <div class="mb-3">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="phone" name="phone" placeholder="Enter entity phone" required>
                        </div>

                        {{-- entity email --}}
                        <div class="mb-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" class="form-input mt-1 block w-full rounded-md" id="email" name="email" placeholder="Enter entity email" required>
                        </div>

                        {{-- entity address --}}
                        <div class="mb-3">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md" id="address" name="address" placeholder="Enter entity address" required>
                        </div>





                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create Entity</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create Entity Form -->
</x-app-layout>
