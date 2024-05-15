<div>
        @if (in_array('Products', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    {{ $this->table }}
    @endif
</div>
