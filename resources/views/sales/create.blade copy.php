@if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    <x-app-layout>
        <form id="receiptForm" method="POST" action="{{ route('yopay') }}">
            <div class="px-4 sm:px-6 lg:px-8 py-0 w-full max-w-9xl mx-auto">
                
                
                
                <div class="form-group ">
                    <br>


                      
                      
                      <select wire:model="selectedCustomerId" class="form-control" id="customer_id" name="customer_id" onchange="fetchSalesItems(this.value);">
    <option value="">Select Patient</option>
    @foreach ($customers as $customer)
        <option value="{{ $customer->id }}" data-phone="{{ $customer->Phone }}">
            {{ $customer->FirstName }} {{ $customer->LastName }} {{ $customer->Phone }}
        </option>
    @endforeach
</select>

<div id="result"></div>
                
                    <label class="mr-10" style="margin: 20px;">You can auto search for patient by scanning the QR code on the Patient's Card using a QR/Bar Code Scanner</label>
                    
                    
                     <div class="flex justify-end my-0 mr-5">
                            <div class="mr-10">
                                {{-- <input type="text" name="phone" id="phone" placeholder="Scanned Number"
                                    class="border rounded px-4 py-2"  onchange="fetchSalesItems(this.value); ">
                                <button type="button" id="submitScan"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 ml-1">Submit</button> --}}

                             
                                     <div id="result">Result:</div>


                                   


                            </div>

                            <img class="w-9 h-9 rounded-full" src="{{ asset('images/1.png') }}" width="36" height="36" alt="User 01" id="customer-icon" style="margin-right: 10px;" onchange="fetchSalesItems(this.value); "/>
                            <button class="bg-blue-500 text-white px-4 py-2 mr-2 rounded-md hover:bg-blue-600"
                                id="scanQrButton" type="button">Use Scanner</button>

                                <input type="file" accept="image/*" capture="environment" id="fileInput" class="hidden" onchange="fetchSalesItems(this.value); ">
                                <button class="bg-blue-500 text-white px-4 py-2 mr-5 rounded-md hover:bg-blue-600" id="scanButton" style="margin-right: 10px;" type="button">Scan with Camera</button>



                            {{-- <input type="file" accept="image/*" capture="environment" id="fileInput" class="hidden" onchange="fetchSalesItems(this.value); ">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600" id="fileScanButton" type="button">Select Patient File</button>
               --}}
                        </div>


                  
                    
                    <table id="sales_items_table" class="table border border-gray-300 w-full mt-4 rounded flex py-2 justify-center px-2 mb-10">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sales items will be displayed here -->
                        </tbody>
                    </table>
                    




                    <div class="flex justify-center my-4 hidden">
                        <video id="preview" class="w-full h-10 max-w-md"></video>
                    </div>

                    <div id="scanForm">
                        @csrf



                       


                    </div>
                    {{-- <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                <h1 class="text-lg font-semibold mb-6">Selection Status</h1>
              @livewire('list-sale-items', ['customer_id' => request()->query('customer_id')])
            </div> --}}

                    {{-- @if ($selectedCustomerId)
                        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                            <h1 class="text-lg font-semibold mb-6">Selection Status</h1>
                            @livewire('list-sale-items', ['customer_id' => $selectedCustomerId])
                        </div>
                    @endif --}}


                    {{-- <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                        @livewire('list-sale-items', ['customer_id' => $selectedCustomerId])

                    </div> --}}


                    <h1 class="text-lg font-semibold mb-6">Select Item</h1>
                    <div class="flex flex-col lg:flex-row lg:justify-between">
                        <div class="w-full lg:w-1/2" id="table">
                            @livewire('list-sale-products')
                        </div>
                        <div id="receipt"
                            class="border border-gray-300 p-4 mt-4 lg:mt-0 lg:w-1/2 lg:ml-4 rounded bg-gray-100">
                            <h3 class="font-bold text-center bg-blue-500 text-white p-2 rounded">Receipt</h3>
                            @csrf
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-blue-500 text-white">
                                        <th class="border border-gray-300 p-2">Product</th>
                                        <th class="border border-gray-300 p-2">Quantity</th>
                                        <th class="border border-gray-300 p-2">Price</th>
                                        <th class="border border-gray-300 p-2">Total</th>
                                        <th class="border border-gray-300 p-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <div id="grandTotal" name="grandTotal" class="mt-4 font-bold">Grand Total: UGX
                                {{ $grandTotal }}</div>
                            <input type="hidden" id="grandTotalInput" name="grandTotal" readonly
                                value="{{ $grandTotal }}">
                            <input type="hidden" id="productIds" name="productIds">
                            <input type="hidden" id="productQuantities" name="productQuantities">
                            <input type="hidden" id="productPrices" name="productPrices">
                            <input type="hidden" id="productNames" name="productNames">
                            <div class="mt-4 flex justify-between">
                                <button type="button" onclick="previewReceipt()"
                                    class="btn btn-primary text-white bg-black p-2 rounded-full mt-2" style="background-color: black;">Preview</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </x-app-layout>
@else
    <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
@endif

@livewireScripts
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    #sales_items_table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    #sales_items_table th, #sales_items_table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    #sales_items_table th {
        background-color: #f2f2f2;
    }
</style>

<script>
    function printReceipt() {
        let printContent = `
            <div>
                <h1>Receipt</h1>
                <p>Customer: ${$('#customer_id option:selected').text()}</p>
                <p>Phone: ${$('#phone').val()}</p>
                <p>Hospital: {{ auth()->user()->entity->EntityName }}</p>
                <p>Attended by: {{ auth()->user()->name }}</p>
                ${$('#receipt').html()}
            </div>
        `;

        // Remove unnecessary elements for printing
        printContent = printContent.replace(/<button[^>]*>.*?<\/button>/g, '');
        printContent = printContent.replace(/<th>Action<\/th>/g, '');
        printContent = printContent.replace(/<td><button[^>]*>.*?<\/button><\/td>/g, '');

        let printWindow = window.open('', '', 'width=800, height=600');
        printWindow.document.write('<html><head><title>Print</title></head><body>' + printContent + '</body></html>');
        printWindow.document.close();

        // Add a delay before calling the print function
        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    }

    $(document).ready(function() {
        $('#signout').click(function() {
            cart = {};
            localStorage.clear();
            sessionStorage.clear();
        });

        $('#customer_id').select2({
            placeholder: "Search Patient",
            allowClear: true,
            tags: true
        });

        $('#customer_id').on('select2:selecting', function(e) {
            var selectedData = e.params.args.data;
            if (selectedData.element == null) {
                e.preventDefault();
                Swal.fire({
                    title: 'Add Customer?',
                    html: '<label for="swal-input1" class="block mb-1">Customer First Name</label>' +
                        '<input id="swal-input1" class="swal2-input mb-2" placeholder="Customer First Name" value="' +
                        selectedData.text + '" readonly>' +
                        '<label for="swal-input2" class="block mb-1">Customer Last Name</label>' +
                        '<input id="swal-input2" class="swal2-input mb-2" placeholder="Customer Last Name">' +
                        '<label for="swal-input3" class="block mb-1">Phone Number</label>' +
                        '<input id="swal-input3" class="swal2-input mb-2" placeholder="Phone Number">' +
                        '<label for="swal-input4" class="block mb-1">Email</label>' +
                        '<input id="swal-input4" class="swal2-input mb-2" placeholder="Email">' +
                        '<label for="swal-input5" class="block mb-1">Patient Insured?</label>' +
                        '<select id="swal-input5" class="swal2-input mb-2" style="width: 100%; padding: 8px; border-radius: 5px%">' +
                        '<option value="0">Select Insurance Status</option>' +
                        '<option value="0">No</option>' +
                        '<option value="1">Yes</option>' +
                        '</select>',
                    showCancelButton: true,
                    confirmButtonText: 'Create',
                    confirmButtonColor: "#3a57e8",
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: "#d33",
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        var fname = $('#swal-input1').val();
                        var lname = $('#swal-input2').val();
                        var phone = $('#swal-input3').val();
                        var email = $('#swal-input4').val();
                        var pInsured = $('#swal-input5').val();
                        return $.ajax({
                            url: "{{ route('customers.store') }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                FirstName: fname,
                                LastName: lname,
                                Phone: phone,
                                Email: email,
                                PInsured: pInsured
                                // entity_id: {{ auth()->user()->entity_id }}
                            }
                        }).done((response) => {
                            console.log('Customer created:', response);
                            return response;
                        }).fail((jqXHR, textStatus, errorThrown) => {
                            Swal.showValidationMessage(
                                `Request failed: ${textStatus}`);
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Patient created successfully!', '', 'success');
                        location.reload();
                        $.ajax({
                            url: "{{ route('customers.index') }}",
                            method: 'GET',
                            success: function(response) {
                                $('#customer_id').empty();
                                $.each(response.data, function(index, customer) {
                                    $('#customer_id').append(
                                        '<option value="' + customer
                                        .id + '" data-insured="' +
                                        customer.PInsured + '">' +
                                        customer.FirstName + '</option>'
                                    );
                                });
                                $('#customer_id').val(result.value.data.id).trigger(
                                    'change');
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });
            }
        });

        $('#customer_id').on('select2:select', function(e) {
            var selectedCustomer = e.params.data;
            console.log('Selected Customer:', selectedCustomer);
            updateReceipt();
        });

        let cart = {};
        let grandTotal = 0;

        function updateSessionStorage() {
            sessionStorage.setItem('cart', JSON.stringify(cart));
        }

        function retrieveCartFromSessionStorage() {
            const cartData = sessionStorage.getItem('cart');
            if (cartData) {
                cart = JSON.parse(cartData);
                updateReceipt();
            }
        }

        retrieveCartFromSessionStorage();

        function resetReceipt() {
            cart = {};
            grandTotal = 0;
            updateReceipt();
            sessionStorage.removeItem('cart');
        }

        function updateReceipt() {
            let receiptContent = '';
            grandTotal = 0;

            let productIds = [];
            let productQuantities = [];

            for (const [key, value] of Object.entries(cart)) {
                let productPrice = value.price;
                let productTotal = productPrice * value.quantity;

                receiptContent += '<tr style="background-color: ' + (Object.keys(cart).indexOf(key) % 2 == 0 ?
                    '#f2f2f2' : '#ffffff') + ';">';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.name + '</td>';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.quantity +
                    '</td>';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + productPrice + '</td>';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + productTotal + '</td>';
                receiptContent +=
                    '<td style="border: 1px solid #ccc; padding: 8px;"><button type="button" style="padding: 8px; border-radius: 50px; background-color: black; color: white;" onclick="removeItem(\'' +
                    key + '\')">Remove</button></td>';
                receiptContent += '</tr>';

                productIds.push(key);
                productQuantities.push(value.quantity);

                grandTotal += productTotal;
            }

            receiptContent +=
                '<tr><td colspan="3" style="border: 1px solid #ccc; padding: 8px;"><strong>Grand Total: UGX</strong></td><td style="border: 1px solid #ccc; padding: 8px;">UGX ' +
                grandTotal + '</td></tr>';

            $('#receipt table tbody').html(receiptContent);
            $('#grandTotal').html('Grand Total: UGX ' + grandTotal);
            $('#grandTotalInput').val(grandTotal);

            $('#productIds').val(JSON.stringify(productIds));
            $('#productQuantities').val(JSON.stringify(productQuantities));
        }

        let debounceTimer;
        window.updateCart = function(input) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                var quantity = parseInt($(input).val());
                var productId = $(input).data('product-id');
                var productName = $(input).data('product-name');
                var price = $(input).data('product-price');

                var customerId = $('#customer_id').val();
                if (!customerId) {
                    Swal.fire('Error', 'Please select a Patient before adding items.', 'error');
                    $(input).val('');
                    return;
                }

                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we update the receipt.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetchCustomerInsuranceStatus(customerId).then(customerInsured => {

                    fetchProductInsuranceStatus(productId).then(productInsured => {
                        var productPrice = (productInsured == 1 &&
                            customerInsured == 1) ? 0 : price;
                        var total = productPrice * quantity;

                        // Ensure the values are fetched correctly
                        //  console('Fetching Product Data:', productId);
                        console.log(
                            `Customer Insured: ${customerInsured}, Product Insured: ${productInsured}, Price: ${productPrice}`
                        );

                        cart[productId] = {
                            name: productName,
                            price: productPrice,
                            quantity: quantity,
                            total: total,
                            insured: productInsured
                        };
                        updateReceipt();
                        updateSessionStorage();
                        Swal.close();
                    });
                });
            }, 300);
        }

        function fetchCustomerInsuranceStatus(customerId) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `/customers2/${customerId}`,
                    method: 'GET',
                    success: function(customer) {
                        console.log('Fetched Customer Data:', customer);
                        if (customer && customer.PInsured !== undefined) {
                            resolve(customer.PInsured);
                        } else {
                            reject('Customer insurance status not found');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(`Error fetching customer data: ${error}`);
                        reject(error);
                    }
                });
            });
        }

        function fetchProductInsuranceStatus(productId) {

            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `/productData/${productId}`,
                    method: 'GET',
                    success: function(product) {
                        resolve(product.Insured);
                    },
                    error: function(xhr, status, error) {
                        console.error(`Error fetching product data: ${error}`);
                        reject(error);
                    }
                });
            });
        }

        window.removeItem = function(productId) {
            delete cart[productId];
            updateReceipt();
        }

        window.previewReceipt = function() {
            let receiptContent =
                '<h3 style="font-weight: bold; text-align: center; background-color: #007bff; color: white; padding: 10px; border-radius: 5px;">Receipt</h3>';
            receiptContent += '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">';
            receiptContent += '<thead style="background-color: #007bff; color: white;">';
            receiptContent += '<tr>';
            receiptContent += '<th style="border: 1px solid #ccc; padding: 8px;">Product</th>';
            receiptContent += '<th style="border: 1px solid #ccc; padding: 8px;">Quantity</th>';
            receiptContent += '<th style="border: 1px solid #ccc; padding: 8px;">Price</th>';
            receiptContent += '<th style="border: 1px solid #ccc; padding: 8px;">Total</th>';
            receiptContent += '</tr>';
            receiptContent += '</thead>';
            receiptContent += '<tbody>';

            for (const [key, value] of Object.entries(cart)) {
                let productPrice = value.price;
                let productTotal = productPrice * value.quantity;
                receiptContent += '<tr>';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.name +
                    '</td>';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.quantity +
                    '</td>';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + productPrice +
                    '</td>';
                receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + productTotal +
                    '</td>';
                receiptContent += '</tr>';
            }

            receiptContent += '<tr>';
            receiptContent +=
                '<td colspan="3" style="border: 1px solid #ccc; padding: 8px;"><strong>Grand Total: UGX</strong></td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">UGX ' + grandTotal +
                '</td>';
            receiptContent += '</tr>';

            receiptContent += '</tbody>';
            receiptContent += '</table>';
            receiptContent +=
                '<button onclick="printReceipt()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mt-4">Print</button>';

            Swal.fire({
                title: 'Receipt Preview',
                html: receiptContent,
                showCancelButton: true,
                confirmButtonText: 'Confirm Selection',
                cancelButtonText: 'Close',
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#d33',
                background: '#f9f9f9'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#receiptForm').submit();
                }
            });
        }

        let qrScanner;

        function startQrScanner() {
            qrScanner = new Html5QrcodeScanner("qr-reader", {
                fps: 10,
                qrbox: 250
            }, false);
            qrScanner.render(onScanSuccess, onScanError);
        }

        function stopQrScanner() {
            if (qrScanner) {
                qrScanner.clear();
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            $('#qrScannerModal').hide();
            stopQrScanner();
            fetchCustomerData(decodedText);
        }

        function onScanError(errorMessage) {
            console.warn(`QR Code Scan Error: ${errorMessage}`);
        }

        $('#qr-scan-btn').click(function() {
            startQrScanner();
        });

        $('#closeQrScanner').click(function() {
            $('#qrScannerModal').hide();
            stopQrScanner();
        });

        function fetchCustomerData(customerId) {
            $.ajax({
                url: `/customers/${customerId}`,
                method: 'GET',
                success: function(response) {
                    const customer = response;
                    console.log('Fetched Customer Data:', customer);
                    $('#customer_id').append(
                        `<option value="${customer.id}" selected>${customer.FirstName}</option>`
                    ).trigger('change');
                    $('#customer-icon').attr('src', `/storage/${customer.qr_code_path}`);
                },
                error: function(xhr, status, error) {
                    console.error(`Error fetching customer data: ${error}`);
                    Swal.fire('Error', 'Unable to fetch customer data. Please try again.', 'error');
                }
            });
        }





        $('#submitScan').click(function() {
            var phone = $('#phone').val();
            if (phone) {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we process your request.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.post("{{ route('customers.scanProcess2') }}", {
                    _token: '{{ csrf_token() }}',
                    phone: phone
                }).done(function(response) {
                    Swal.close();
                    if (response.customer && response.customer.id) {
                        // Access the customer ID from the response
                        var customerId = response.customer.id;

                        // Use Livewire to set the customer ID or update the DOM directly
                        Livewire.emit('setCustomerId', customerId);

                        // Optionally update other parts of the page
                        // Update select input with the new customer ID and trigger change
                        $('#customer_id').val(customerId).trigger('change');

                        // If you have additional fields to update based on the customer, do it here
                        // Example: Update customer details displayed on the page
                        $('#customer-details').html(`
                    Name: ${response.customer.FirstName} ${response.customer.LastName}<br>
                    Phone: ${response.customer.Phone}<br>
                    Email: ${response.customer.Email}
                `);

                    } else {
                        Swal.fire('Error', 'Customer not found or invalid response.', 'error');
                    }
                }).fail(function(xhr, status, error) {
                    Swal.fire('Error', 'Unable to process scan. Please try again.', 'error');
                });
            }
        });



        function updateSaleItemsList(customerId) {
            // This function could use AJAX to fetch and display sale items related to the customer
            $.get('/path-to-fetch-sale-items/' + customerId, function(data) {
                // Assume data contains HTML to display
                $('#sale-items-container').html(data);
            });
        }


        $(document).on('keypress', function(e) {
            if (e.which == 13 && !$(e.target).is('textarea') && !$(e.target).is('button')) {
                e.preventDefault();
            }
        });
    });
</script>

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
            }).catch(err => console.error(err));
        };
        reader.readAsDataURL(file);
    });

    phoneInput.addEventListener('input', () => {
        if (phoneInput.value) {
            scanResult.textContent = `Scanned Result: ${phoneInput.value}`;
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const transactionReference = "{{ session('transactionReference') }}";
        if (transactionReference) {
            const intervalId = setInterval(checkPaymentStatus, 30000);
        }

        function checkPaymentStatus() {
            fetch(`/check-payment-status/${transactionReference}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status !== 'PENDING') {
                        alert(`Payment status updated: ${data.status}`);
                        location.reload(); // Reload the page or update the UI as needed
                        clearInterval(intervalId); // Stop checking once status changes
                    }
                })
                .catch(error => console.error('Error checking payment status:', error));
        }
    });
</script>



<script>


// Function to fetch customer ID from phone number and then load sale items
function fetchCustomerAndSalesItems(phoneNumber) {
    $.ajax({
        url: '/get-customer-id',  // Endpoint that returns customer ID from phone number
        method: 'GET',
        data: { phone: phoneNumber },
        success: function(response) {
            if(response.customerId) {
                fetchSalesItems(response.customerId);
            } else {
                console.error('No customer found with that phone number.');
                alert('No customer found.');
            }
        },
        error: function(error) {
            console.error('Error fetching customer ID:', error);
            alert('Error fetching customer information.');
        }
    });
}



function fetchCustomerAndSalesItemsScan(phoneNumber) {
    const selectElement = document.getElementById('customer_id');
    const options = selectElement.options;

    for (let i = 0; i < options.length; i++) {
        if (options[i].dataset.phone === phoneNumber) {
            selectElement.value = options[i].value;
            fetchSalesItems(options[i].value);
            break;
        }
    }
}

// Function to fetch and display sale items by customer ID
function fetchSalesItems(customerId) {
    $.ajax({
        url: '/fetch-sales-items/' + customerId, // Endpoint that returns the sale items for the customer
        method: 'GET',
        success: function(data) {
            // Assuming data contains HTML of sale items table
            $('#sale-items-container').html(data);
        },
        error: function(error) {
            console.error('Error fetching sales items:', error);
            alert('Error fetching sales items.');
        }
    });
}

// Event handler for the submit button
$('#submitScan').click(function() {
    var phoneNumber = $('#phone').val(); // Get the phone number from input
    fetchCustomerAndSalesItems(phoneNumber); // Fetch customer ID and sales items
});





  // JavaScript to fetch and display sales items
  function fetchSalesItems(customerId) {
    if (!customerId) {
        $('#sales_items_table tbody').empty(); // Clear the table if no customer is selected
        return;
    }

    $.ajax({
        url: `/sales-items/${customerId}`,
        type: 'GET',
        success: function(data) {
            $('#sales_items_table tbody').empty();
            data.forEach(item => {
                const total = item.Quantity * item.Price;
                //   const partial = item.Partial;
                const row = `
                    <tr>
                        <td>${item.ProductName}</td>
                        <td>${item.Quantity}</td>
                        <td>${item.Price}</td>
                        <td>${total}</td>
                     <td>${item.Status ? 'Fully Offered' : item.Partial ? 'Partially Offered' : 'Not Offered'}</td>
                       
                    </tr>
                `;
                $('#sales_items_table tbody').append(row);
            });
        },
        error: function(error) {
            console.error('Error fetching sales items:', error);
            alert('Failed to fetch sales items.');
        }
    });
}


    </script>
    
    
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    let inputBuffer = '';

    document.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            // Output the scanned QR code to the console
            console.log('Scanned QR Code:', inputBuffer);
            // Display the result in the #result div
            document.getElementById('result').textContent = inputBuffer;
            fetchCustomerAndSalesItems(inputBuffer);

            // Clear the buffer for the next scan
            inputBuffer = '';
        } else {
            // Append the key to the buffer
            inputBuffer += e.key;
        }
    });
});
</script>
    