

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


<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

