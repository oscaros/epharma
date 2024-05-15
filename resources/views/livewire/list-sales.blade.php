<div>

  


    <div style="padding-top: 10px;">
        {{-- add sale --}}

        <div class="flex justify-end my-4">
            <a class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" href="{{route('sales.create')}}">Make New Sale</a>
        </div>

        @if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
            {{ $this->table }}
        @endif
    </div>

</div>
