<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@if (in_array('Reports', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    <x-app-layout :assets="$assets ?? []">
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <div class="grid grid-cols-1">
                <div class="col-span-1 md:col-span-3">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="mb-6">
                            <h5 class="text-lg font-semibold">Reports</h5>
                        </div>
                        <!-- Form for selecting a date range -->
                        <div class="my-4">
                            <form method="POST" action="{{ route('create_report') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="reportDate" class="block text-sm font-medium text-gray-700">Select Date Range:</label>
                                    <input type="text" class="form-input mt-1 block w-full" id="dateRange" name="dateRange">
                                </div>
                                <!-- Button for generating report -->
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Generate Report</button>
                            </form>
                        </div>

                        <!-- Form for viewing today's report -->
                        <form method="POST" action="{{ route('create_report') }}">
                            @csrf
                            <!-- Hidden input to specify today's date -->
                            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                            <!-- Button for viewing today's report -->
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Today's Summary</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-1 md:col-span-1">
                        <div class="bg-white rounded-lg shadow-md">
                            <div class="bg-green-500 py-4 px-6 rounded-t-lg">
                                <h4 class="mb-0 text-xl font-semibold text-black">Total Sales</h4>
                            </div>
                            <div class="p-6">
                                <ul class="divide-y divide-gray-200">
                                    <!-- Incomes -->
                                    <li class="flex justify-between items-center py-3">
                                        <span>Opening Sales</span>
                                        {{-- <span
                                            class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($openingSales, 2) }}</span> --}}
                                    </li>
    
                                    <li class="flex justify-between items-center py-3">
                                        <span>Total Paid</span>
                                        {{-- <span
                                            class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($totalPaid, 2) }}</span> --}}
                                    </li>
                                     <!-- Nested list for Total Milling -->
                                    <li class="py-3">
                                        <span class="font-semibold">Total Invoices</span>
                                        {{-- <span
                                            class="bg-green-500 text-black px-3 py-1 rounded justify-right ml-4">{{ number_format($totalInvoices, 2) }}</span> --}}
    
                                        <ul class="ml-10 divide-y divide-gray-200">
                                            <!-- Total Arabica SunDry -->
                                            <li class="flex justify-between items-center py-1">
                                                <span>Pending Invoices</span>
                                                {{-- <span
                                                    class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($pendingInvoices, 2) }}</span> --}}
                                            </li>
    
                                            <!-- Total Robusta SunDry -->
                                            <li class="flex justify-between items-center py-1">
                                                <span>Paid Invoices</span>
                                                {{-- <span
                                                    class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($paidInvoices, 2) }}</span> --}}
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    
    
    
                                    
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-1">
                        <div class="bg-white rounded-lg shadow-md">
                            <div class="bg-red-500  py-4 px-6 rounded-t-lg">
                                <h4 class="mb-0 text-xl font-semibold text-black">Total Expenditures</h4>
                            </div>
                            <div class="p-6">
                                <ul class="divide-y divide-gray-200">
                                    <!-- Expenditures -->
                                    <li class="flex justify-between items-center py-3">
                                        <span>Total Products Cost</span>
                                        {{-- <span
                                            class="bg-red-500 text-black px-3 py-1 rounded">{{ number_format($totalAdvances, 2) }}</span> --}}
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-500 text-white mt-4 rounded-lg shadow-md">
                    <div class="p-6">
                        <h4 class="mb-3 text-xl font-semibold">Summary</h4>
                        <ul class="divide-y divide-gray-200">
                            <li class="flex justify-between items-center py-3">
                                <span>Overall Expenditure</span>
                                {{-- <span
                                    class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($overallExpenditure, 2) }}</span> --}}
                            </li>
                            <li class="flex justify-between items-center py-3">
                                <span>Overall Income</span>
                                {{-- <span
                                    class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($overAllIncome, 2) }}</span> --}}
                            </li>
                            <li class="flex justify-between items-center py-3">
                                <span>Balance</span>
                                {{-- <span
                                    class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($netCapital, 2) }}</span> --}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div class="bg-blue-500 text-white rounded-lg shadow-md">
                        <div class="p-6">
                            <h4 class="mb-1 text-xl font-semibold">Products</h4>
                            <ul class="divide-y divide-gray-200">
                                <li class="flex justify-between items-center py-3">
                                    <span>Total Products Available</span>
                                    {{-- <span
                                        class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($totalArabica, 2) }}</span> --}}
                                </li>
                                <li class="flex justify-between items-center py-3">
                                    <span>Total Expired Products</span>
                                    {{-- <span
                                        class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($totalRobusta, 2) }}</span> --}}
                                </li>
                            </ul>
                            <div class="flex justify-between items-center mt-3">
                                <span class="font-semibold">Total Products:</span>
                                {{-- <span
                                    class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($totalStock, 2) }}</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-1 md:col-span-1">
                        <div class="bg-white rounded-lg shadow-md">
                            <div class="bg-green-500 py-4 px-6 rounded-t-lg">
                                <h4 class="mb-0 text-xl font-semibold text-black">Total Cash In</h4>
                            </div>
                            <div class="p-6">
                                <ul class="divide-y divide-gray-200">
                                    <!-- Incomes -->
                                    <li class="flex justify-between items-center py-3">
                                        <span>Todays Customers</span>
                                        <span class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($todaysCustomers, 2) }}</span>
                                    </li>
                                    <li class="flex justify-between items-center py-3">
                                        <span>Total Sales</span>
                                        <span class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($totalSales, 2) }}</span>
                                    </li>
                                    <li class="flex justify-between items-center py-3">
                                        <span>Total Sales Amount</span>
                                        <span class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($totalSalesAmount, 2) }}</span>
                                    </li>
                                    <li class="flex justify-between items-center py-3">
                                        <span>Pending Invoices</span>
                                        <span class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($totalPendingInvoices, 2) }}</span>
                                    </li>
                                    <li class="flex justify-between items-center py-3">
                                        <span>Total Drugs and Services</span>
                                        <span class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($totalProducts, 2) }}</span>
                                    </li>
                                    <li class="flex justify-between items-center py-3">
                                        <span>Total Users</span>
                                        <span class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($totalUsers, 2) }}</span>
                                    </li>
                                    <li class="flex justify-between items-center py-3">
                                        <span>Total Invoices</span>
                                        <span class="bg-green-500 text-black px-3 py-1 rounded">{{ number_format($totalInvoices, 2) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <div class="bg-blue-500 text-white mt-4 rounded-lg shadow-md">
                    <div class="p-6">
                        <h4 class="mb-3 text-xl font-semibold">Summary</h4>
                        <ul class="divide-y divide-gray-200">
                            
                            <li class="flex justify-between items-center py-3">
                                <span>Overall Income Made</span>
                                <span class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($totalSalesAmount, 2) }}</span>
                            </li>
                            <li class="flex justify-between items-center py-3">
                                <span>Closing Prescriptions Made</span>
                                <span class="bg-blue-500 text-black px-3 py-1 rounded">{{ number_format($totalSales, 2) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
            </div>
    </x-app-layout>
@else
    <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
@endif

<script>
    // Initialize Flatpickr for date range selection
    flatpickr('#dateRange', {
        mode: 'range',
        dateFormat: 'Y-m-d',
        maxDate: 'today', // Set maximum date to today
    });
</script>
