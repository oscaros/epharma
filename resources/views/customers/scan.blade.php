<!DOCTYPE html>
<html>
<head>
    <title>Scan QR Code</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Scan QR Code</h1>
        <div id="reader" style="width: 500px;"></div>
        <form id="scan-form" action="{{ route('customers.retrieve') }}" method="POST" style="display:none;">
            @csrf
            <input type="text" id="phone" name="phone">
        </form>
        <button id="start-scan">Start Scan</button>
    </div>

    <script>
        function onScanSuccess(qrCodeMessage) {
            // Extract the phone number from the QR code message
            document.getElementById('phone').value = qrCodeMessage;
            document.getElementById('scan-form').submit();
        }

        function onScanError(errorMessage) {
            // Handle scan error
            console.error(errorMessage);
        }

        document.getElementById('start-scan').addEventListener('click', function() {
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess, onScanError);
        });
    </script>
</body>
</html>
