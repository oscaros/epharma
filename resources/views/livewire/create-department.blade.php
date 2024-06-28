<div>
    <form wire:submit="create">
        {{ $this->form }}

      

        <div class="col-span-2">
            <button type="submit" id="button"
                class="bg-blue-500 text-white mt-4 px-4 py-2 rounded-md hover:bg-blue-600">Add Service Point</button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
