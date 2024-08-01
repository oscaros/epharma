<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <div class="mb-6">
                <h5 class="text-lg font-semibold">Reports</h5>
            </div>
            <!-- Form for selecting a date range -->
            <div class="my-4">
                <form id="reportForm">
                    @csrf
                    <div class="mb-3">
                        <label for="reportDate" class="block text-sm font-medium text-gray-700">Select Date Range:</label>
                        <input type="text" class="form-input mt-1 block w-full" id="dateRange" name="dateRange">
                    </div>

                    {{-- add select with options sales, customers --}}
                    <div class="mb-3">
                        <label for="reportType" class="block text-sm font-medium text-gray-700">Select Report
                            Type:</label>
                        <select class="form-select w-full rounded-md" id="reportType" name="reportType">
                            <option value="sales">Sales</option>
                            <option value="customers">Customers</option>
                            <option value="products">Products</option>
                        </select>
                    </div>
                    <!-- Button for generating report -->
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Generate Report</button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <canvas id="salesChart"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <canvas id="customersChart"></canvas>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <canvas id="productsChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script> <!-- Date Adapter for Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('#dateRange', {
                mode: 'range',
                dateFormat: 'Y-m-d',
                maxDate: 'today',
            });

            const salesChart = new Chart(document.getElementById('salesChart'), {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Sales',
                        data: [],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        }
                    }
                }
            });

            const customersChart = new Chart(document.getElementById('customersChart'), {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Customers',
                        data: [],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        }
                    }
                }
            });

            const productsChart = new Chart(document.getElementById('productsChart'), {
                type: 'pie',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Products',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                }
            });

            // Fetch default data for the previous day
            fetchReportData(getPreviousDay(), getPreviousDay());

            document.getElementById('reportForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const dateRange = document.getElementById('dateRange').value;
                const [startDate, endDate] = dateRange.split(' to ');

                fetchReportData(startDate, endDate);
            });

            function fetchReportData(startDate, endDate) {
                fetch('{{ route('report.data') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            start_date: startDate,
                            end_date: endDate
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        updateChart(salesChart, data.sales);
                        updateChart(customersChart, data.customers);
                        updateChart(productsChart, data.products);
                    })
                    .catch(error => console.error('Error:', error));

            }

            function updateChart(chart, data) {
                chart.data.labels = data.labels;
                chart.data.datasets[0].data = data.values;
                chart.update();
            }

            function getPreviousDay() {
                const date = new Date();
                date.setDate(date.getDate() - 1);
                return date.toISOString().split('T')[0];
            }
        });
    </script>
</x-app-layout>
