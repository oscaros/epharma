<x-app-layout>
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
