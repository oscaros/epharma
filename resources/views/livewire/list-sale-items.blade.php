<div>
    @if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))


    
        
        {{ $this->table }}

    @else
        <div>
            <h2>Sorry you do not have permission to view this page, for assistance, contact your System Administrator
            </h2>
        </div>
    @endif
</div>
