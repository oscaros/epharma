<x-app-layout :assets="$assets ?? []">
    <!-- Create Entity Form -->
   <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Edit Service Point</h5>
                    </div>

                    @livewire('edit-department', ['department' => $department])

                    

                   
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create Entity Form -->
</x-app-layout>
