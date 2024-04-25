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

            <div id="grandTotal" name="grandTotal" style="margin-top: 10px; font-weight: bold;">Grand Total: UGX {{ $grandTotal }}</div>
            <input id="grandTotalInput" name="grandTotal" style="margin-top: 10px; font-weight: bold;" readonly value="{{ $grandTotal }}">

            <!-- Hidden input fields to store product information -->
            <input type="hidden" id="productIds" name="productIds">
            <input type="hidden" id="productNames" name="productNames">
            <input type="hidden" id="productPrices" name="productPrices">

            <div style="margin-top: 10px; display: flex; justify-content: space-between;">
                <button onclick="printReceipt()"
                    style="color: white; background-color: blue; padding: 8px; border-radius: 50px;">Preview</button>
                <button type="submit" class="btn btn-primary"
                    style="color: white; background-color: blue; padding: 8px; border-radius: 50px;">Make A
                    Sale</button>
            </div>
        </form>
    </div>


    <div>
        <!-- Preview Modal -->
        <div wire:ignore.self class="modal fade" id="previewModal" tabindex="-1" role="dialog"
            aria-labelledby="previewModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 style="font-weight: bold;">Receipt</h3>
                        <form id="previewReceiptForm" method="POST" action="{{ route('sales.store') }}">
                            @csrf
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #ccc; padding: 8px;">Product</th>
                                        <th style="border: 1px solid #ccc; padding: 8px;">Quantity</th>
                                        <th style="border: 1px solid #ccc; padding: 8px;">Price</th>
                                        <th style="border: 1px solid #ccc; padding: 8px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $key => $value)
                                        <tr>
                                            <td style="border: 1px solid #ccc; padding: 8px;">{{ $value['name'] }}</td>
                                            <td style="border: 1px solid #ccc; padding: 8px;">{{ $value['quantity'] }}
                                            </td>
                                            <td style="border: 1px solid #ccc; padding: 8px;">{{ $value['price'] }}</td>
                                            <td style="border: 1px solid #ccc; padding: 8px;">{{ $value['total'] }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" style="border: 1px solid #ccc; padding: 8px; "><strong>Grand
                                                Total:</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px;">UGX {{ $grandTotal }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" id="previewGrandTotal" name="grandTotal">
                            <button type="submit" class="btn btn-primary">Make A Sale</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let cart = {};
    let grandTotal = 0;

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
</script>
