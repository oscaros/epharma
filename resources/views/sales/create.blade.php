@if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    <x-app-layout>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <h1 class="text-lg font-semibold mb-6">Make Sale</h1>
            {{-- @livewire('list-sales', ['filter' => request()->query('filter', 'all')]) --}}

            <div style="display: flex; justify-content: space-between;">
                <div style="width: 50%;" id="table">
                    @livewire('list-sale-products')
                </div>

                <div id="receipt" style="border: 1px solid #ccc; padding: 10px; width: 45%; margin-left: 20px; border-radius: 10px; background-color: #f9f9f9;">
                    <h3 style="font-weight: bold; text-align: center; background-color: #007bff; color: white; padding: 10px; border-radius: 5px;">Receipt</h3>
                    <form id="receiptForm" method="POST" action="{{ route('sales.store') }}">
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
                            <tbody>
                            </tbody>
                        </table>

                        <div class="form-group mt-4">
                            <label for="customer_id">Customer</label>
                            <select class="form-control" id="customer_id" name="customer_id">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->FirstName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="grandTotal" name="grandTotal" style="margin-top: 10px; font-weight: bold;">Grand Total: UGX {{ $grandTotal }}</div>
                        <input type="hidden" id="grandTotalInput" name="grandTotal" style="margin-top: 10px; font-weight: bold;" readonly value="{{ $grandTotal }}">

                        <!-- Hidden input fields to store product information -->
                        <input type="hidden" id="productIds" name="productIds">
                        <input type="hidden" id="productNames" name="productNames">
                        <input type="hidden" id="productPrices" name="productPrices">

                        <div style="margin-top: 10px; display: flex; justify-content: space-between;">
                            <button type="submit" class="btn btn-primary" style="color: white; background-color: rgb(24, 24, 61); padding: 8px; border-radius: 50px; margin-top: 10px">Make A Sale</button>
                        </div>
                    </form>

                    <button onclick="previewReceipt()" style="color: white; background-color: darkgrey; padding: 8px; border-radius: 50px; margin-top: 10px;">Preview</button>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
@endif

@livewireScripts
<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



<script>

    $(document).ready(function() {
        $('#signout').click(function() {
            cart = {};
            localStorage.clear();
            sessionStorage.clear();
        });

        $('#customer_id').select2({
            placeholder: "Search Customer",
            allowClear: true,
            tags: true
        });

        $('#customer_id').on('select2:selecting', function(e) {
            var selectedData = e.params.args.data;
            if (selectedData.element == null) {
                e.preventDefault();
                Swal.fire({
                    title: 'Add Customer?',
                    html: '<label for="swal-input1" class="block mb-1">Customer Name</label>' +
                        '<input id="swal-input1" class="swal2-input mb-2" placeholder="Customer Name" value="' +
                        selectedData.text + '" readonly>' +
                        '<label for="swal-input2" class="block mb-1">Phone Number</label>' +
                        '<input id="swal-input2" class="swal2-input" placeholder="Phone Number">' +
                        '<label for="swal-input3" class="block mb-1">Email</label>' +
                        '<input id="swal-input3" class="swal3-input" placeholder="Email">',
                    showCancelButton: true,
                    confirmButtonText: 'Create',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        var name = $('#swal-input1').val();
                        var phone = $('#swal-input2').val();
                        var email = $('#swal-input3').val();
                        return $.ajax({
                            url: "{{ route('customers.store') }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                FirstName: name,
                                Phone: phone,
                                Email: email
                            }
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Customer created successfully!', '', 'success');
                        $.ajax({
                            url: "{{ route('customers.index') }}",
                            method: 'GET',
                            success: function(response) {
                                $('#customer_id').empty();
                                $.each(response.data, function(index, customer) {
                                    $('#customer_id').append(
                                        '<option value="' + customer.id + '">' + customer.name + '</option>');
                                });
                                $('#customer_id').val(result?.value?.data?.id).trigger('change');
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });
            }
        });
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

    $(document).ready(function() {
        retrieveCartFromSessionStorage();
    });

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

        for (const [key, value] of Object.entries(cart)) {
            receiptContent += '<tr style="background-color: ' + (Object.keys(cart).indexOf(key) % 2 == 0 ? '#f2f2f2' : '#ffffff') + ';">';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.name + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.quantity + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.price + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.total + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;"><button style="padding: 8px; border-radius: 50px; background-color: black; color: white;" onclick="removeItem(\'' + key + '\')">Remove</button></td>';
            receiptContent += '</tr>';

            productIds.push(key);

            grandTotal += value.total;
        }
        receiptContent += '<tr><td colspan="3" style="border: 1px solid #ccc; padding: 8px;"><strong>Grand Total: UGX</strong></td><td style="border: 1px solid #ccc; padding: 8px;">UGX ' + grandTotal + '</td></tr>';

        $('#receipt table tbody').html(receiptContent);
        $('#grandTotal').html('Grand Total: UGX ' + grandTotal);
        $('#grandTotalInput').val(grandTotal);

        $('#productIds').val(JSON.stringify(productIds));
    }

    function updateCart(input) {
        var quantity = parseInt($(input).val());
        var productId = $(input).data('product-id');
        var productName = $(input).data('product-name');
        var price = $(input).data('product-price');
        var total = price * quantity;
        cart[productId] = {
            name: productName,
            price: price,
            quantity: quantity,
            total: total
        };
        updateReceipt();
        updateSessionStorage();
        // location.reload();
    }

    window.addEventListener('livewire:load', function() {
        Livewire.on('updateGrandTotal', function(grandTotal) {
            $('#grandTotal').html('Grand Total: UGX ' + grandTotal);
        });
    });

    function removeItem(productId) {
        delete cart[productId];
        updateReceipt();
    }

    function previewReceipt() {
        let receiptContent = '<h3 style="font-weight: bold; text-align: center; background-color: #007bff; color: white; padding: 10px; border-radius: 5px;">Receipt</h3>';
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
            receiptContent += '<tr>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.name + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.quantity + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.price + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.total + '</td>';
            receiptContent += '</tr>';
        }

        receiptContent += '<tr>';
        receiptContent += '<td colspan="3" style="border: 1px solid #ccc; padding: 8px;"><strong>Grand Total: UGX</strong></td>';
        receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">UGX ' + grandTotal + '</td>';
        receiptContent += '</tr>';

        receiptContent += '</tbody>';
        receiptContent += '</table>';

        Swal.fire({
            title: 'Receipt Preview',
            html: receiptContent,
            showCancelButton: false,
            confirmButtonText: 'Print',
            confirmButtonColor: '#007bff',
        }).then((result) => {
            if (result.isConfirmed) {
                window.print();
            }
        });
    }
</script>

