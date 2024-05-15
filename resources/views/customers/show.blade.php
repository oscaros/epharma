<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Customer Details -->
        <div class="p-4 bg-white shadow-md rounded-lg">
            <h1 class="text-3xl mb-6 text-center">Customer Details</h1>

            <!-- Customer Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Left column content -->
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-circle text-4xl mr-2"></i>
                        <span class="font-bold text-xl">Customer Information</span>
                    </div>
                    <div class="mb-3 flex items-center border-b border-gray-300">
                        <i class="fas fa-user mr-2"></i>

                        <span>
                            @if ($customer->picture)
                                <img src="{{ asset($customer->picture) }}" alt="customer picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <img src="{{ asset('images/01.png') }}" alt="customer picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @endif
                        </span>
                    </div>

                    <!-- Customer Details -->
                    <div class="mb-3 flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span class="font-bold">Name:</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>{{ $customer->name }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span class="font-bold">Address:</span>
                        <span>{{ $customer->address }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-id-card mr-2"></i>
                        <span class="font-bold">Account Number:</span>
                        <span>{{ $customer->account_number }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span class="font-bold">Phone Number:</span>
                        <span>{{ $customer->phone_number }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-money-bill-wave mr-2"></i>
                        <span class="font-bold">Balance:</span>
                        <span>UGX {{ number_format($customer->balance, 2) }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-id-card mr-2"></i>
                        <span class="font-bold">NIN:</span>
                        <span>{{ $customer->nin }}</span>
                    </div>
                </div>

                <!-- Right column content -->
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-shield text-4xl mr-2"></i>
                        <span class="font-bold text-xl">Guarantor Information</span>
                    </div>

                    <!-- Guarantor Details -->

                    <div class="mb-3 flex items-center border-b border-gray-300">
                        <i class="fas fa-user mr-2"></i>
                        {{-- <span class="font-bold">Guarantor's Photo:</span> --}}
                        <span>
                            @if ($customer->guarantor->photo)
                                <img src="{{ asset($customer->guarantor->photo) }}" alt="guarantor picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <img src="{{ asset('images/01.png') }}" alt="guarantor picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @endif
                        </span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span class="font-bold">Guarantor's Name:</span>
                        <span>{{ $customer->guarantor->name }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span class="font-bold">Guarantor's Address:</span>
                        <span>{{ $customer->guarantor->location }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span class="font-bold">Guarantor's Phone Number:</span>
                        <span>{{ $customer->guarantor->phone_number }}</span>
                    </div>



                    <div class="mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span class="font-bold">Alternative Phone Number:</span>
                        <span>{{ $customer->alternative_number }}</span>
                    </div>
                </div>
            </div>


            <!-- Right column content -->

            




            
            <div class="bg-gray-100 rounded-lg p-4  mt-10">
                <div class="flex items-center mb-3">
                    <i class="fas fa-user-shield text-4xl mr-2"></i>
                    <span class="font-bold text-xl">Care Taker's Information</span>
                   
                </div>

                 {{-- photo --}}
                    
                    <div class="mb-3 flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        {{-- <span class="font-bold">Care Taker's Photo:</span> --}}
                        <span>
                            @if ($customer->careTaker->photo)
                                <img src="{{ asset($customer->careTaker->photo) }}" alt="careTaker picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <img src="{{ asset('images/01.png') }}" alt="careTaker picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @endif
                        </span>
                    </div>

                <div class="mb-3 flex items-center">
                    <i class="fas fa-phone-alt mr-2"></i>
                    <span class="font-bold">Name:</span>
                    <span>{{ $customer->careTaker->name }}</span>
                </div>

                <div class="mb-3 flex items-center">
                    <i class="fas fa-id-card mr-2"></i>
                    <span class="font-bold">Care Of Name's Phone Number:</span>
                    <span>{{ $customer->careTaker->phone_number }}</span>
                </div>





            </div>

            <!-- Button -->
            <div class="text-center mt-6">
                <a href="{{ route('customers.index') }}"
                    class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">Go Back</a>
            </div>
        </div>
        <!-- End of Customer Details -->
    </div>
</x-app-layout>