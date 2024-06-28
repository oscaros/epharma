  @if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
      <x-app-layout>

          <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
              <h1 class="text-lg font-semibold mb-6">Manage Prescriptions</h1>
              @livewire('list-customer-sales', ['filter' => request()->query('filter', 'all')])
          </div>


      </x-app-layout>
  @else
      <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
  @endif
