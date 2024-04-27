

<div>
    <input 
        name="custom" 
        type="number" 
        class="form-input block w-full mt-1 rounded-md focus:ring-blue-500 focus:border-blue-500"
        value="" 
        data-product-id="{{ $getRecord()->id }}"
        data-product-name="{{ $getRecord()->ProductName }}" 
        data-product-price="{{ $getRecord()->Price }}" 
        onchange="updateCart(this)" 
    />

   
</div>
