<x-app-layout :assets="$assets ?? []">
    <div class="container mx-auto p-8 bg-white shadow-lg rounded-lg">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">{{ $customer->FirstName }} {{ $customer->LastName }}</h1>
            <p class="text-lg text-gray-600">{{ $entity->EntityName }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <p class="text-lg"><strong>Email:</strong> {{ $customer->Email }}</p>
                <p class="text-lg"><strong>Phone:</strong> {{ $customer->Phone }}</p>
                <p class="text-lg"><strong>Address:</strong> {{ $customer->Address }}</p>
                <p class="text-lg"><strong>NIN:</strong> {{ $customer->NIN }}</p>
                <p class="text-lg"><strong>Patient Type:</strong> {{ $customer->PType == 1 ? 'Inpatient' : 'Outpatient' }}</p>
                <p class="text-lg"><strong>Insured:</strong>
                    <strong disabled  class="text-lg h-5 w-5 text-blue-600">{{ $customer->PInsured ? 'Yes' : 'No' }} </strong>
                </p>
            </div>
            <div class="flex flex-col items-center justify-center">
                @if($customer->qr_code_path)
                    <div class="mb-4">
                        <h3 class="text-2xl font-semibold mb-2 text-gray-800">QR Code:</h3>
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <img src="{{ asset('storage/' . $customer->qr_code_path) }}" alt="QR Code" class="w-48 h-48">
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="text-center mt-8">
            <button onclick="window.print()" class="bg-blue-500 text-white px-8 py-3 rounded-md hover:bg-blue-600 transition duration-300">Print</button>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .container, .container * {
                visibility: visible;
            }
            .container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 0;
                margin: 0;
            }
        }
    </style>
</x-app-layout>
