

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Customer Details -->
        <!-- Customer Details -->
        <div class="p-4 bg-white shadow-md rounded-lg">
            <h1 class="text-3xl mb-6 text-center">Ledger Details</h1>

            <!-- Customer Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Left column content -->
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-circle text-4xl mr-2"></i>
                        <span class="font-bold text-xl">Customer Information</span>
                    </div>
                    <div class="mb-3 flex items-center border-b border-gray-300">
                        <i class="fas fa-user mr-2"></i>

                        <span>
                            @if ($customer->picture)
                                <img src="{{ asset($customer->picture) }}" alt="customer picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <img src="{{ asset('images/01.png') }}" alt="customer picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @endif
                        </span>
                    </div>

                    <!-- Customer Details -->
                    <div class="mb-3 flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span class="font-bold">Name:</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>{{ $customer->name }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span class="font-bold">Address:</span>
                        <span>{{ $customer->address }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-id-card mr-2"></i>
                        <span class="font-bold">Account Number:</span>
                        <span>{{ $customer->account_number }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span class="font-bold">Phone Number:</span>
                        <span>{{ $customer->phone_number }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-money-bill-wave mr-2"></i>
                        <span class="font-bold">Balance:</span>
                        <span>UGX {{ number_format($customer->balance, 2) }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-id-card mr-2"></i>
                        <span class="font-bold">NIN:</span>
                        <span>{{ $customer->nin }}</span>
                    </div>
                </div>

                <!-- Right column content -->
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-shield text-4xl mr-2"></i>
                        <span class="font-bold text-xl">Guarantor Information</span>
                    </div>

                    <!-- Guarantor Details -->

                    <div class="mb-3 flex items-center border-b border-gray-300">
                        <i class="fas fa-user mr-2"></i>
                        {{-- <span class="font-bold">Guarantor's Photo:</span> --}}
                        <span>
                            @if ($customer->guarantor->photo)
                                <img src="{{ asset($customer->guarantor->photo) }}" alt="guarantor picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <img src="{{ asset('images/01.png') }}" alt="guarantor picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @endif
                        </span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span class="font-bold">Guarantor's Name:</span>
                        <span>{{ $customer->guarantor->name }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span class="font-bold">Guarantor's Address:</span>
                        <span>{{ $customer->guarantor->location }}</span>
                    </div>

                    <div class="mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span class="font-bold">Guarantor's Phone Number:</span>
                        <span>{{ $customer->guarantor->phone_number }}</span>
                    </div>



                    <div class="mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span class="font-bold">Alternative Phone Number:</span>
                        <span>{{ $customer->alternative_number }}</span>
                    </div>
                </div>
            </div>
            <!-- Right column content -->            
            <div class="bg-gray-100 rounded-lg p-4  mt-10">
                <div class="flex items-center mb-3">
                    <i class="fas fa-user-shield text-4xl mr-2"></i>

                    <span class="font-bold text-xl">Care Taker's Information</span>
                   
                </div>

                 {{-- photo --}}
                    
                    <div class="mb-3 flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        {{-- <span class="font-bold">Care Taker's Photo:</span> --}}
                        <span>
                            @if ($customer->careTaker->photo)
                                <img src="{{ asset($customer->careTaker->photo) }}" alt="careTaker picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @else
                                <img src="{{ asset('images/01.png') }}" alt="careTaker picture"
                                    class="rounded-full w-10 h-10 object-cover">
                            @endif
                        </span>
                    </div>

                <div class="mb-3 flex items-center">
                    <i class="fas fa-phone-alt mr-2"></i>
                    <span class="font-bold">Name:</span>
                    <span>{{ $customer->careTaker->name }}</span>
                </div>

                <div class="mb-3 flex items-center">
                    <i class="fas fa-id-card mr-2"></i>
                    <span class="font-bold">Care Of Name's Phone Number:</span>
                    <span>{{ $customer->careTaker->phone_number }}</span>
                </div>


            </div>

            <!-- ledger table-->
                        <!-- Ledger Table -->
            <div class="mt-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Ledger</h5>
                    </div>
                    <div class="card-body">
                        <!-- Include the DataTable for ledger -->
                        <table id="ledger_datatable" class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2">Advance</th>
                                    <th class="px-4 py-2">Payment</th>
                                    <th class="px-4 py-2">Current Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data rows will be dynamically added here -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="px-4 py-2">Total:</th>
                                    <th class="px-4 py-2"></th> <!-- This cell will be populated dynamically -->
                                    <th class="px-4 py-2"></th> <!-- This cell will be populated dynamically -->
                                    <th class="px-4 py-2"></th> <!-- This cell will be populated dynamically -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ledger table-->

        <!-- End of Customer Details -->


            <!-- Button -->
            <div class="text-center mt-8">
                <a href="{{ route('customers.index') }}" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">Go Back</a>
            </div>
        </div>
        <!-- End of Customer Details -->
    </div>
</x-app-layout>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Tailwind CSS -->
<link href="https://cdn.tailwindcss.com" rel="stylesheet">

<!-- DataTables core JavaScript -->
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>

<!-- DataTables Tailwind CSS plugin -->
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.tailwindcss.js"></script>



<script>
    // Function to load the ledger DataTable via AJAX
    function loadLedgerDataTable(customerId) {
        $.ajax({
            url: '/customer/' + customerId + '/ledger',
            type: 'GET',
            success: function(response) {

                // Destroy existing DataTable instance, if any
                if ($.fn.DataTable.isDataTable('#ledger_datatable')) {
                    $('#ledger_datatable').DataTable().destroy();
                }

                // Initialize variables to calculate totals
                var totalAdvance = 0;
                var totalPayment = 0;

                // Iterate over the response data to calculate the balance and totals
                var balance = 0;
                var ledgerData = response.data.map(function(entry) {
                    // Calculate the balance
                    if ('amount' in entry) {
                        balance += parseFloat(entry.amount);
                        totalAdvance += parseFloat(entry.amount); // Accumulate total advance
                    }
                    if ('deductable_advance' in entry) {
                        balance -= parseFloat(entry.deductable_advance);
                        totalPayment += parseFloat(entry.deductable_advance); // Accumulate total payment
                    }
                    entry.current_balance = balance;
                    return entry;
                });

                // Initialize DataTable with the modified data
                var table = $('#ledger_datatable').DataTable({
                    data: ledgerData,
                    columns: [{
                            data: 'date',
                            title: 'Date'
                        },
                        {
                            data: 'amount',
                            title: 'Advance',
                            render: function(data, type, row) {
                                return data ? 'UGX ' + parseFloat(data).toLocaleString(undefined, {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) : 'UGX 0';
                            }
                        },
                        {
                            data: 'deductable_advance',
                            title: 'Payment',
                            render: function(data, type, row) {
                                return data ? 'UGX ' + parseFloat(data).toLocaleString(undefined, {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) : 'UGX 0';
                            }
                        },
                        {
                            data: 'current_balance',
                            title: 'Current Balance',
                            render: function(data, type, row) {
                                return 'UGX ' + parseFloat(data).toLocaleString(undefined, {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }
                        }
                    ],
                    dom: 'Blfrtip', // Add buttons to the DOM
                    buttons: [
                        'csv',
                        'excel',
                        'print',
                        'pdf',
                        'colvis'
                    ],
                    footerCallback: function(row, data, start, end, display) {
                        let api = this.api();

                        // Update footer with the totals
                        $(api.column(1).footer()).html('UGX ' + totalAdvance.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                        $(api.column(2).footer()).html('UGX ' + totalPayment.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Load on page render
    var customerId = '{{ $customer->id }}';
    loadLedgerDataTable(customerId);
</script>