<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function fetchData(Request $request)
    {
        \Log::info('Request received', $request->all());
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'report_type' => 'required|in:sales,customers,products'
        ]);

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $reportType = $request->input('report_type');

        try {
            $sales = $reportType === 'sales' ? Sale::whereBetween('created_at', [$startDate, $endDate])->get() : [];
            $customers = $reportType === 'customers' ? Customer::whereBetween('created_at', [$startDate, $endDate])->get() : [];
            $products = $reportType === 'products' ? Product::whereBetween('created_at', [$startDate, $endDate])->get() : [];

            $salesData = $this->formatSalesData($sales);
            $customerData = $this->formatCustomerData($customers);
            $productData = $this->formatProductData($products);

            return response()->json([
                'sales' => $salesData,
                'customers' => $customerData,
                'products' => $productData,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching report data: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Data retrieval failed: ' . $e->getMessage()], 500);
        }
    }

    public function exportCSV(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'report_type' => 'required|in:sales,customers,products'
        ]);

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $reportType = $request->input('report_type');

        $data = [];
        $columns = [];

        if ($reportType === 'sales') {
            $data = Sale::whereBetween('created_at', [$startDate, $endDate])->get()->toArray();
            $columns = ['amount', 'type', 'phone_number', 'user_id', 'customer_id', 'description', 'status', 'created_at'];
        } elseif ($reportType === 'customers') {
            $data = Customer::whereBetween('created_at', [$startDate, $endDate])->get()->toArray();
            $columns = ['FirstName', 'LastName', 'Phone', 'Email', 'created_at'];
        } elseif ($reportType === 'products') {
            $data = Product::whereBetween('created_at', [$startDate, $endDate])->get()->toArray();
            $columns = ['ProductName', 'Quantity', 'Price', 'created_at'];
        }

        $filename = "{$reportType}_report_{$startDate->format('Ymd')}_to_{$endDate->format('Ymd')}.csv";

        $handle = fopen($filename, 'w');
        fputcsv($handle, $columns);

        foreach ($data as $row) {
            $filteredRow = array_intersect_key($row, array_flip($columns));
            fputcsv($handle, $filteredRow);
        }

        fclose($handle);

        return Response::download($filename)->deleteFileAfterSend(true);
    }

    private function formatSalesData($sales)
    {
        $salesData = [
            'labels' => [],
            'values' => []
        ];

        foreach ($sales as $sale) {
            $salesData['labels'][] = $sale->created_at->format('Y-m-d');
            $salesData['values'][] = $sale->amount;
        }

        return $salesData;
    }

    private function formatCustomerData($customers)
    {
        $customerData = [
            'labels' => [],
            'values' => []
        ];

        foreach ($customers as $customer) {
            $customerData['labels'][] = $customer->created_at->format('Y-m-d');
            $customerData['values'][] = 1;
        }

        return $customerData;
    }

    private function formatProductData($products)
    {
        $productData = [
            'labels' => [],
            'values' => []
        ];

        foreach ($products as $product) {
            $productData['labels'][] = $product->name;
            $productData['values'][] = $product->quantity_sold; // assuming you have a field for quantity sold
        }

        return $productData;
    }
}
