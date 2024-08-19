<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />



<x-app-layout :assets="$assets ?? []">
    <div class="container mx-auto p-8 bg-white shadow-lg rounded-lg">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">{{ $customer->FirstName }} {{ $customer->LastName }}</h1>
            <p class="text-lg text-gray-600"><strong>{{ $entity->EntityName }}</strong></p>
           
            {{-- <button id="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 print">QR generate</button> --}}
            {{-- <div id="qrcode"></div>  --}}
            
             <p class="text-lg text-gray-600 " id="generate"><strong>Client ID:  </strong>{{ $customer->ClientID }}</p>

     
            <div class="flex flex-col items-center justify-center space-y-4">
                 <p class="text-lg"><strong>Today's Serial Number: </strong> {{ $customer->NewVisitNumber }}</p>
                 
                {{-- @if($customer->qr_code_path)
                    <div class="mb-4" id="qrcode">
                        <h3 class="text-2xl font-semibold mb-2 text-gray-800">QR Code:</h3>
                        <div class="p-4 bg-gray-100 rounded-lg">
                            {{-- <img src="{{ asset('storage/'.$customer->qr_code_path) }}" alt="QR Code" class="w-48 h-48" onerror="this.onerror=null;this.src='{{ asset('images/01.png') }}';"> --}}
                            {{-- <img src="{{ url('storage/' . $customer->qr_code_path) }}" alt="QR Code" class="w-48 h-48"> 

                        </div>
                    </div>
                @else
                    <p>QR Code not available.</p>
                @endif --}}
                
                
                <div id="qrcode" class="items-center justify-center space-y-4"></div> 



            </div>

            
            
            
        </div>
        <div class="text-center mt-8 ">
            <button onclick="window.print()" class="bg-blue-500 text-white px-8 py-3 rounded-md hover:bg-blue-600 transition duration-300 print">Print</button>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
                /* margin: 2%; */
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
            .print {
                display: none;
            }
        }
    </style>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var text = document.getElementById('generate').textContent;

        var qrcodeContainer = document.getElementById('qrcode');
        qrcodeContainer.innerHTML = ""; // Clear previous QR code if any

        new QRCode(qrcodeContainer, {
            text: text,
            width: 128,
            height: 128
        });
    });
</script>


<style>
    /* body {
        font-family: Arial, sans-serif;
        margin: 20px;
    } */
    #qrcode {
        margin-top: 20px;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

