<!-- resources/views/livewire/list-sale-products.blade.php -->

<div style="display: flex;">
    <div style="width: 50%;">
        {{ $this->table }}
    </div>

    <div id="receipt" class="mt-4" style="border: 1px solid #ccc; padding: 10px; float: right; width: 50%;">
        <h3 style="font-weight: bold;">Receipt</h3>
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
            </tbody>
        </table>

        <div id="grandTotal" style="margin-top: 10px; font-weight: bold;">Grand Total: UGX {{ $grandTotal }}</div>

        <button wire:click="saveGrandTotal" style="margin-top: 10px;">Save Grand Total</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let cart = {};
    let grandTotal = 0;

    function updateReceipt() {
        let receiptContent = '';
        grandTotal = 0;
        for (const [key, value] of Object.entries(cart)) {
            receiptContent += '<tr>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.name + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.quantity + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.price + '</td>';
            receiptContent += '<td style="border: 1px solid #ccc; padding: 8px;">' + value.total + '</td>';
            receiptContent += '</tr>';
            grandTotal += value.total;
        }
        receiptContent += '<tr><td colspan="3" style="border: 1px solid #ccc; padding: 8px;"><strong>Grand Total:</strong></td><td style="border: 1px solid #ccc; padding: 8px;">' + grandTotal + '</td></tr>';

        $('#receipt table tbody').html(receiptContent);
        $('#grandTotal').html('Grand Total: UGX ' + grandTotal);
    }

    function updateCart(input) {
        var quantity = parseInt($(input).val());
        var productId = $(input).data('product-id');
        var productName = $(input).data('product-name');
        var price = $(input).data('product-price');
        var total = price * quantity;
        cart[productId] = { name: productName, price: price, quantity: quantity, total: total };

        // Update the receipt
        updateReceipt();
    }

    window.addEventListener('livewire:load', function () {
        Livewire.on('updateGrandTotal', function (grandTotal) {
            $('#grandTotal').html('Grand Total: $' + grandTotal);
        });
    });
</script>
