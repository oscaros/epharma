<div>


        @if (in_array('Dashboard', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    {{-- Date filter --}}
    <div class="mb-4 flex items-center">
        <div class="relative flex-grow">
            <input type="date" wire:model="selectedDate" class="form-input pl-9 dark:bg-slate-800 text-slate-500 hover:text-slate-600 dark:text-slate-300 dark:hover:text-slate-200 font-medium w-[15.5rem]" placeholder="Select date" max="{{ now()->format('Y-m-d') }}" />
            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                <svg class="w-4 h-4 fill-current text-slate-500 dark:text-slate-400 ml-3" viewBox="0 0 16 16">
                    <path d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                </svg>
            </div>
        </div>
        
        {{-- Filter button --}}
        <button wire:click="applyFilter" class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-2">
            <span class="hidden xs:block ml-2">Filter</span>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Products --}}
        <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer">
            <h3 class="text-xl font-semibold mb-4">Total Products</h3>
            <p class="text-2xl font-bold">{{ number_format($totalProducts) }}</p>
        </div>

               {{-- Total Sales--}}
        {{-- <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer">
            <h3 class="text-xl font-semibold mb-4">Expired Products</h3>
            <p class="text-2xl font-bold">{{ number_format($totalSales) }}</p>
        </div> --}}

        <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer">
            <h3 class="text-xl font-semibold mb-4">Total Sales</h3>
            <p class="text-2xl font-bold">{{ number_format($totalSales) }}</p>
        </div>
        
        {{-- Total Products --}}
        <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer" >
            <h3 class="text-xl font-semibold mb-4">pendingProducts</h3>
            <p class="text-2xl font-bold">{{ number_format($pendingProducts) }}</p>
        </div>

        

 
        {{-- Total Invoices --}}
        <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer" >
            <h3 class="text-xl font-semibold mb-4">Total Invoices Created</h3>
            <p class="text-2xl font-bold">{{ number_format($totalInvoices) }}</p>
        </div>



         {{-- Total Products --}}
        {{-- <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer">
            <h3 class="text-xl font-semibold mb-4">Products Pending Approval</h3>
            <p class="text-2xl font-bold">{{ number_format($pendingProducts) }}</p>
        </div> --}}

               {{-- Total Sales--}}
        <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer">
            <h3 class="text-xl font-semibold mb-4">Total Sales Amount</h3>
            <p class="text-2xl font-bold">UGX {{ number_format($totalSalesAmount, 2) }}</p>
        </div>

       

        
        {{-- Total Products --}}
        <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer" >
            <h3 class="text-xl font-semibold mb-4">Total Users</h3>
            <p class="text-2xl font-bold">{{ number_format($totalUsers) }}</p>
        </div>

 
        {{-- Total Invoices --}}
        @if(Auth::user()->role->id == 1) 
        <div class="bg-gray-200 rounded-lg shadow-md p-6 cursor-pointer" >
            <h3 class="text-xl font-semibold mb-4">Total Pharmacies Registered</h3>
            <p class="text-2xl font-bold">{{ number_format($totalEntities) }}</p>
        </div>
        @endif

    </div>

   
    </div>
    @endif
</div>

