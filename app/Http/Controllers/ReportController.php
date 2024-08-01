<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function fetchData(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));
            $reportType = $request->input('report_type');
    
            $sales = $reportType === 'sales' ? Sale::whereBetween('created_at', [$startDate, $endDate])->get() : [];
            $customers = $reportType === 'customers' ? Customer::whereBetween('created_at', [$startDate, $endDate])->get() : [];
            $products = $reportType === 'products' ? Product::all() : [];
    
            $salesData = $this->formatSalesData($sales);
            $customerData = $this->formatCustomerData($customers);
            $productData = $this->formatProductData($products);
    
            return response()->json([
                'sales' => $salesData,
                'customers' => $customerData,
                'products' => $productData,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data retrieval failed.'], 500);
        }
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
