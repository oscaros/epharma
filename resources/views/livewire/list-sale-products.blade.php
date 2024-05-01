

<div style="display: flex;">
    <div style="width: 50%;">
        {{ $this->table }}
    </div>

    <div id="receipt" class="mt-4"
        style="border: 1px solid #ccc; padding: 10px; float: right; width: 50%; margin: 20px;">
        <h3 style="font-weight: bold;">Receipt</h3>
        <form id="receiptForm" method="POST" action="{{ route('sales.store') }}">
            @csrf
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
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

            {{-- add customer input field --}}
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
              
                <button type="submit" class="btn btn-primary"
                    style="color: white; background-color: blue; padding: 8px; border-radius: 50px;">Make A
                    Sale</button>
            </div>
        </form>

          <button onclick="printReceipt()"
                    style="color: white; background-color: blue; padding: 8px; border-radius: 50px; margin-top: 10px;">Preview</button>
    </div>


    
</div>

@livewireScripts

   

  
<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


    let cart = {};
    let grandTotal = 0;



      // Function to update local storage with cart data
    function updateLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Function to retrieve cart data from local storage and populate the cart
    function retrieveCartFromLocalStorage() {
        const cartData = localStorage.getItem('cart');
        if (cartData) {
            cart = JSON.parse(cartData);
            updateReceipt(); // Update the receipt with retrieved cart data
        }
    }

    // Call the function to retrieve cart data from local storage when the page loads
    $(document).ready(function() {
        retrieveCartFromLocalStorage();
    });

   

    // Function to reset the cart and local storage
    function resetReceipt() {
        cart = {};
        grandTotal = 0;
        updateReceipt();
        localStorage.removeItem('cart'); // Remove cart data from local storage
    }


    function updateReceipt() {
        let receiptContent = '';
        grandTotal = 0;

        // Arrays to store product information
        let productIds = [];

        for (const [key, value] of Object.entries(cart)) {
            receiptContent += '<tr>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.name + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.quantity + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.price + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.total + '</td>';
            receiptContent +=
                '<td style="border: 1px solid #ccc; padding: 8px;"><button style="padding: 8px; border-radius: 50px; background-color: red; color: white;" onclick="removeItem(\'' +
                key + '\')">Remove</button></td>';
            receiptContent += '</tr>';

            // Push product IDs to the array
            productIds.push(key);

            grandTotal += value.total;
        }
        receiptContent +=
            '<tr><td colspan="3" style="border: 1px solid #ccc; padding: 8px;"><strong>Grand Total: UGX</strong></td><td style="border: 1px solid #ccc; padding: 8px;">UGX ' +
            grandTotal + '</td></tr>';

        $('#receipt table tbody').html(receiptContent);
        $('#grandTotal').html('Grand Total: UGX ' + grandTotal);
        //add grandtotal into input field
        $('#grandTotalInput').val(grandTotal);

        // Update the hidden input field with product IDs
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
        // Update the receipt
        updateReceipt();
         updateLocalStorage();
          //reload page
        location.reload();
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

    function printReceipt() {
        const printContents = document.getElementById("previewModal").innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function resetReceipt() {
        cart = {};
        grandTotal = 0;
        updateReceipt();
    }


    //create or search customer
    $(document).ready(function() {
    $('#customer_id').select2({
        placeholder: "Search Customer",
        allowClear: true,
        tags: true
    });

     $('#customer_id').on('select2:selecting', function (e) {
        var selectedData = e.params.args.data;
        if (selectedData.element == null) {
            e.preventDefault(); // Prevent Select2 from updating its value

            // Show SweetAlert for confirmation
            Swal.fire({
                title: 'Add Customer?',
                html:
                '<label for="swal-input1" class="block mb-1">Customer Name</label>' +
                '<input id="swal-input1" class="swal2-input mb-2" placeholder="Customer Name" value="' + selectedData.text + '" readonly>' +
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
                    // You can also validate the input here if needed
                    return $.ajax({
                        url: "{{ route('customers.store') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            FirstName: name,
                            Phone: phone,
                            Email: email
                            // You can add more fields here if needed
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show success message
                    Swal.fire('Customer created successfully!', '', 'success');
                    // Fetch updated list of customers
                    $.ajax({
                        url: "{{ route('customers.index') }}",
                        method: 'GET',
                        success: function(response) {
                            // Clear existing options
                            $('#customer_id').empty();
                            // Populate select options with updated customer list
                            $.each(response.data, function(index, customer) {
                                $('#customer_id').append('<option value="' + customer.id + '">' + customer.name + '</option>');
                            });
                            // Select the newly created customer
                            $('#customer_id').val(result?.value?.data?.id).trigger('change');
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error(error);
                        }
                    });
                }
            });
        }
    });
});
</script>




