<!DOCTYPE html>
<html>
<head>
    <title>QR Code Reader</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const qrInput = document.getElementById('qr-input');

            qrInput.addEventListener('input', function() {
                const value = qrInput.value.trim();
                if (value.length > 0) {
                    console.log(`Scan result: ${value}`); // Debug message
                    document.getElementById('message').value = value;
                    document.getElementById('qrForm').submit();
                }
            });
        });
    </script>
</head>
<body>
    <h1>Scan QR Code</h1>
    <input type="text" id="qr-input" autofocus style="position: absolute; top: -1000px;">
    <form id="qrForm" action="{{ route('qrcode.read') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" id="message" name="message">
    </form>
    <p id="status"></p>
</body>
</html>
