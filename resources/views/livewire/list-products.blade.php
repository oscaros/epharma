<div>
        @if (in_array('Products', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
  <div class="flex justify-end my-4">
                            <a class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" href="{{route('products.create')}}">Add Product</a>
                        </div>
    {{ $this->table }}
    @endif
</div>