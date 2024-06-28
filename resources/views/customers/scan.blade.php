


<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <h1 class="text-lg font-semibold mb-6">Scan Patient Card</h1>

        <div class="flex justify-center my-4">
            <video id="preview" class="w-full max-w-md"></video>
        </div>

        <form id="scanForm" action="{{ route('customers.scan.process') }}" method="POST">
            @csrf
            <div class="flex justify-center my-4">
                <input type="text" name="phone" id="phone" placeholder="Scan Number" class="border rounded px-4 py-2">
            </div>
            <button type="submit" class="hidden"></button>
        </form>

        <div class="flex justify-center my-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" id="scanButton">Scan QR Code with Camera</button>
        </div>

        <div class="flex justify-center my-4">
            <input type="file" accept="image/*" capture="environment" id="fileInput" class="hidden">
            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600" id="fileScanButton">Select Patient File</button>
        </div>

        <div class="flex justify-center my-4">
            <p id="scanResult" class="text-lg font-semibold"></p>
        </div>
    </div>
    
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

