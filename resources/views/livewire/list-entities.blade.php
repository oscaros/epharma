
<div>
@if (in_array('Entities', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))



    <div class="flex justify-end my-4">
        
            <a class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                href="{{ route('entities.create') }}">Add New Entity</a>
    </div>

    {{ $this->table }}
    @else
    <div class="flex justify-center my-4">
        <p class="text-red-500">You do not have permission to view entities</p>
        </div> 
     @endif
</div>

