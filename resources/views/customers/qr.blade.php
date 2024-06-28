<x-app-layout>
    <!-- Add Customer Form -->
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1">
            <div class="col-span-1 md:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h1 class="text-lg font-semibold mb-6">Add Customer</h1>
                    <form method="POST" action="{{ route('customers.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4" enctype="multipart/form-data">
                        @csrf

                        <!-- Customer Information -->
                        <div>
                            <label for="FirstName" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input mt-1 block w-full" id="FirstName" name="FirstName" placeholder="Enter First Name" required>
                            <div class="invalid-feedback hidden">
                                Please provide first name.
                            </div>
                        </div>

                        <div>
                            <label for="LastName" class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input mt-1 block w-full" id="LastName" name="LastName" placeholder="Enter Last Name" required>
                            <div class="invalid-feedback hidden">
                                Please provide last name.
                            </div>
                        </div>

                        <div>
                            <label for="Phone" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                            <input type="number" class="form-input mt-1 block w-full" id="Phone" name="Phone" placeholder="Enter your phone number" required>
                            <div class="invalid-feedback hidden">
                                Please provide a phone number.
                            </div>
                        </div>

                        <div>
                            <label for="Address" class="block text-sm font-medium text-gray-700">Customer Address</label>
                            <input type="text" class="form-input mt-1 block w-full" id="Address" name="Address" placeholder="Enter customer address">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" class="form-input mt-1 block w-full" id="Email" name="Email" placeholder="Enter your email">
                        </div>

                        <div>
                            <label for="NIN" class="block text-sm font-medium text-gray-700">NIN</label>
                            <input type="text" maxlength="14"  class="form-input mt-1 block w-full" id="NIN" name="NIN" placeholder="Enter your NIN" max="14">
                        </div>

                       

                        <!-- Submit Button -->
                        <div class="col-span-2">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" type="submit">Add Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Add Customer Form -->


</x-app-layout>


