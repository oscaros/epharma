<div>
        @if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    {{ $this->table }}
    @endif
</div>
