<div>
        @if (in_array('Logs', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    {{ $this->table }}
    @endif
</div>
