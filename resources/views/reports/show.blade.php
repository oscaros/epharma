<x-app-layout>
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
</x-app-layout>
