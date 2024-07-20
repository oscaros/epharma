@if (in_array('Departments', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))


<div>
    <form wire:submit="save">
        {{ $this->form }}

        <button type="submit" class="mt-5 btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Service Point</button>
    </form>

    <x-filament-actions::modals />
</div>

@else
<div class="flex justify-center my-4">
    <p class="text-red-500">You do not have permission to view entities</p>
    </div> 
 @endif

