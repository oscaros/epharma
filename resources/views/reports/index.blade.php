<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@if (in_array('Report', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
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
