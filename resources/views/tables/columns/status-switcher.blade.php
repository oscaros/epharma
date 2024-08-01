<div>
    {{-- Get the status from the record --}}
    @php
        $status = $getRecord()->Status;
    @endphp

    {{-- Display the checkbox with the correct checked status --}}
    {{-- <input 
        name="status" 
        type="checkbox" 
        class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out"
        @if($status == 1) checked @endif
    /> --}}

    {{-- Display the status text with the appropriate color --}}
    <span class="{{ $status == 1 ? 'text-green-600' : 'text-red-600' }}">
        {{ $status == 1 ? 'Approved' : 'Pending' }}
    </span>
</div>
