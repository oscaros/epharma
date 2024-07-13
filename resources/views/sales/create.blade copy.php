@if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    <x-app-layout>

        <form id="receiptForm" method="POST" action="{{ route('yopay') }}">
            <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

                <div class="form-group mt-4 mb-4">
                   
                
                    <div style="display: flex; align-items: center;">
                        <img class="w-9 h-9 rounded-full" src="{{ asset('images/1.png') }}" width="36" height="36" alt="User 01" id="customer-icon" style="margin-right: 10px;" />
                        <button id="qr-scan-btn" type="button" style="border-radius: 10%; padding: 10px; background-color: blue; color: white;">Scan QR Code</button>
                    </div>
                
                    <br>
                    <select class="form-control" id="customer_id" name="customer_id">
                        <option value="">Select Patient</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" data-insured="{{ $customer->PInsured }}">{{ $customer->FirstName }}</option>
                        @endforeach
                    </select>
                </div>
                

                <h1 class="text-lg font-semibold mb-6">Select Item</h1>

                <div style="display: flex; justify-content: space-between;">
                    <div style="width: 50%;" id="table">
                        @livewire('list-sale-products')
                    </div>

                    <div id="receipt"
                        style="border: 1px solid #ccc; padding: 10px; width: 45%; margin-left: 20px; border-radius: 10px; background-color: #f9f9f9;">
                        <h3
                            style="font-weight: bold; text-align: center; background-color: #007bff; color: white; padding: 10px; border-radius: 5px;">
                            Receipt</h3>
                        @csrf
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #007bff; color: white;">
                                    <th style="border: 1px solid #ccc; padding: 8px;">Product</th>
                                    <th style="border: 1px solid #ccc; padding: 8px;">Quantity</th>
                                    <th style="border: 1px solid #ccc; padding: 8px;">Price</th>
                                    <th style="border: 1px solid #ccc; padding: 8px;">Total</th>
                                    <th style="border: 1px solid #ccc; padding: 8px;">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <div id="grandTotal" name="grandTotal" style="margin-top: 10px; font-weight: bold;">Grand Total:
                            UGX {{ $grandTotal }}</div>
                        <input type="hidden" id="grandTotalInput" name="grandTotal"
                            style="margin-top: 10px; font-weight: bold;" readonly value="{{ $grandTotal }}">
                        <input type="hidden" id="productIds" name="productIds">
                        <input type="hidden" id="productQuantities" name="productQuantities">
                        <input type="hidden" id="productPrices" name="productPrices">
                        <input type="hidden" id="productNames" name="productNames">

                        <div style="margin-top: 10px; display: flex; justify-content: space-between;">
                            <button type="button" onclick="previewReceipt()" class="btn btn-primary"
                                style="color: white; background-color: darkgrey; padding: 8px; border-radius: 50px; margin-top: 10px;">Preview</button>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />






<script>
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
                        '<select id="swal-input5" class="swal2-input mb-2">' +
                        '<option value="0">Select Insurance Status</option>' +
                        '<option value="0">No</option>' +
                        '<option value="1">Yes</option>' +
                        '</select>',
                    showCancelButton: true,
                    confirmButtonText: 'Create',
                    cancelButtonText: 'Cancel',
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
                            }
                        }).done((response) => {
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
                        //reload page
                        location.reload();
                        // Refetch the list of customers
                        $.ajax({
                            url: "{{ route('customers.index') }}",
                            method: 'GET',
                            success: function(response) {
                                // Clear the dropdown
                                $('#customer_id').empty();
                                // Populate the dropdown with the updated list of customers
                                $.each(response.data, function(index, customer) {
                                    $('#customer_id').append(
                                        '<option value="' + customer
                                        .id + '" data-insured="' +
                                        customer.PInsured + '">' +
                                        customer.FirstName + '</option>'
                                        );
                                });
                                // Auto-select the newly added customer
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
            console.log('Selected Customer:', selectedCustomer); // Log selected customer data
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
            let productQuantities = []; // Array to store quantities

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
                productQuantities.push(value.quantity); // Store quantity

                grandTotal += productTotal;
            }

            receiptContent +=
                '<tr><td colspan="3" style="border: 1px solid #ccc; padding: 8px;"><strong>Grand Total: UGX</strong></td><td style="border: 1px solid #ccc; padding: 8px;">UGX ' +
                grandTotal + '</td></tr>';

            $('#receipt table tbody').html(receiptContent);
            $('#grandTotal').html('Grand Total: UGX ' + grandTotal);
            $('#grandTotalInput').val(grandTotal);

            $('#productIds').val(JSON.stringify(productIds));
            $('#productQuantities').val(JSON.stringify(productQuantities)); // Save quantities
        }

        let debounceTimer;
        window.updateCart = function(input) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                var quantity = parseInt($(input).val());
                var productId = $(input).data('product-id');
                var productName = $(input).data('product-name');
                var price = $(input).data('product-price');

                // Check if customer is selected
                var customerId = $('#customer_id').val();
                if (!customerId) {
                    Swal.fire('Error', 'Please select a customer before adding products.', 'error');
                    $(input).val('');
                    return;
                }

                // Fetch customer insurance status if not available
                fetchCustomerInsuranceStatus(customerId).then(customerInsured => {
                    // Fetch product insurance status via AJAX
                    fetchProductInsuranceStatus(productId).then(productInsured => {
                        var productPrice = (productInsured == 1 &&
                            customerInsured == 1) ? 0 : price;
                        var total = productPrice * quantity;

                        // Log product data
                        console.log('Product Data:', {
                            productId,
                            productName,
                            price,
                            insured: productInsured,
                            quantity
                        });

                        cart[productId] = {
                            name: productName,
                            price: productPrice,
                            quantity: quantity,
                            total: total,
                            insured: productInsured
                        };
                        updateReceipt();
                        updateSessionStorage();
                    });
                });
            }, 300); // Adjust the debounce time as needed
        }

        function fetchCustomerInsuranceStatus(customerId) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `/customers/${customerId}`,
                    method: 'GET',
                    success: function(customer) {
                        resolve(customer.PInsured);
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
                    url: `/products/${productId}`, // Adjust this URL to your actual route
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

            Swal.fire({
                title: 'Receipt Preview',
                html: receiptContent,
                showCancelButton: true,
                confirmButtonText: 'Confirm Prescription',
                cancelButtonText: 'Close',
                confirmButtonColor: '#007bff',
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
                    console.log('Fetched Customer Data:', customer); // Log customer data
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
    });
</script>
