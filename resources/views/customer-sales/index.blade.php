  {{-- @if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
      <x-app-layout>
       

          <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
              <h1 class="text-lg font-semibold mb-6">Patient Prescriptions</h1>

              <div class="flex justify-end my-4">
                <a class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" href="{{route('customers.scan')}}">Scan Customer Card</a>
            </div>
              {{-- @livewire('list-sales', ['filter' => request()->query('filter', 'all')]) 
              @livewire('list-customer-sales', ['customer_id' => request()->query('customer_id')])
          </div>


      </x-app-layout>
  @else
      <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
  @endif --}}





  @if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
      <x-app-layout>
          <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
              <h1 class="text-lg font-semibold mb-6">Patient Prescriptions</h1>


              <div class="flex justify-center my-4" class="hidden">
                <video   id="preview" class="w-full h-10 max-w-md"></video>
            </div>


              <form id="scanForm" action="{{ route('customers.scan.process')  }}" method="POST">
                  @csrf
                  <div class="flex justify-left my-4">
                      <input type="text" name="phone" id="phone" placeholder="Scan Number"
                          class="border rounded px-4 py-2">
                  </div>
                  <button type="submit" class="hidden"></button>
              </form>



              <div class="flex justify-end my-4 mr-5">
                  <button class="bg-blue-500 text-white px-4 py-2 mr-5 rounded-md hover:bg-blue-600" id="scanButton">Scan QR
                      Code with Camera</button>


                  <input type="file" accept="image/*" capture="environment" id="fileInput" class="hidden">
                  <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
                      id="fileScanButton">Select Patient File</button>
              </div>



              @if (isset($customer))
                  <h2 class="text-xl font-semibold mb-4">Customer Information</h2>
                  <p><strong>First Name:</strong> {{ $customer->FirstName }}</p>
                  <p><strong>Last Name:</strong> {{ $customer->LastName }}</p>
                  <p><strong>Phone:</strong> {{ $customer->Phone }}</p>
                  <p><strong>NIN:</strong> {{ $customer->NIN }}</p>

                  <h2 class="text-xl font-semibold mb-4 mt-6">Sales Items</h2>
                  <table class="min-w-full bg-white">
                      <thead>
                          <tr>
                              <th class="py-2">Product</th>
                              <th class="py-2">Quantity</th>
                              <th class="py-2">Price</th>
                              <th class="py-2">Total</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($sales as $sale)
                              @foreach ($sale->saleItems as $item)
                                  <tr>
                                      <td class="py-2">{{ $item->product->name }}</td>
                                      <td class="py-2">{{ $item->Quantity }}</td>
                                      <td class="py-2">{{ $item->Price }}</td>
                                      <td class="py-2">{{ $item->Quantity * $item->Price }}</td>
                                  </tr>
                              @endforeach
                          @endforeach
                      </tbody>
                  </table>
              @else
                  <p>No customer selected.</p>
              @endif

              @livewire('list-customer-sales', ['customer_id' => request()->query('customer_id')])

          </div>
      {{-- </x-app-layout> --}}
  @else
      <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
  @endif



  <script src="https://unpkg.com/@zxing/library@latest"></script>
  <script>
      const codeReader = new ZXing.BrowserQRCodeReader();
      const previewElem = document.getElementById('preview');
      const scanForm = document.getElementById('scanForm');
      const phoneInput = document.getElementById('phone');
      const scanButton = document.getElementById('scanButton');
      const fileInput = document.getElementById('fileInput');
      const fileScanButton = document.getElementById('fileScanButton');
      const scanResult = document.getElementById('scanResult');

      scanButton.addEventListener('click', () => {
          codeReader.decodeOnceFromVideoDevice(undefined, previewElem).then(result => {
              phoneInput.value = result.text;
              scanResult.textContent = `Scanned Result: ${result.text}`;
              scanForm.submit();
          }).catch(err => console.error(err));
      });

      fileScanButton.addEventListener('click', () => {
          fileInput.click();
      });

      fileInput.addEventListener('change', (event) => {
          const file = event.target.files[0];
          const reader = new FileReader();
          reader.onload = (e) => {
              const imageSrc = e.target.result;
              codeReader.decodeFromImage(undefined, imageSrc).then(result => {
                  phoneInput.value = result.text;
                  scanResult.textContent = `Scanned Result: ${result.text}`;
                  scanForm.submit();
              }).catch(err => console.error(err));
          };
          reader.readAsDataURL(file);
      });

      phoneInput.addEventListener('input', () => {
          if (phoneInput.value) {
              scanResult.textContent = `Scanned Result: ${phoneInput.value}`;
              scanForm.submit();
          }
      });
  </script>
  </x-app-layout>
