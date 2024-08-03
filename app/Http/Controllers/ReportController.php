<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
// use Carbon\Carbon;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function fetchData(Request $request)
    {

        // dd('called out');
        \Log::info('Request received', $request->all());
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'report_type' => 'required|in:sales,customers,products'
        ]);
    
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $reportType = $request->input('report_type');
    
        // Log the parsed date to see if it's working correctly
        \Log::info('Parsed Date', ['start_date' => $startDate]);
        \Log::info('Parsed Date', ['end_date' => $endDate]);



       
        try {

            // dd('called in');


          
            // $startDate = Carbon::parse($request->input('start_date'));
            // $endDate = Carbon::parse($request->input('end_date'));
            // $reportType = $request->input('report_type');
    
            $sales = $reportType === 'sales' ? Sale::whereBetween('created_at', [$startDate, $endDate])->get() : [];
            $customers = $reportType === 'customers' ? Customer::whereBetween('created_at', [$startDate, $endDate])->get() : [];
            $products = $reportType === 'products' ? Product::all() : [];
    
            $salesData = $this->formatSalesData($sales);
            $customerData = $this->formatCustomerData($customers);
            $productData = $this->formatProductData($products);

            //  dd('called');
    
            return response()->json([
                'sales' => $salesData,
                'customers' => $customerData,
                'products' => $productData,
            ]);
        } catch (\Exception $e) {

            // dd($e->getTraceAsString());
            \Log::error('Error fetching report data: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Data retrieval failed: ' . $e->getMessage()], 500);
        }
    }

    public function Test(Request $request){

        // dd($request->all());
        // $startDate = Carbon::parse($request->input('start_date'));

        \Log::info('Request received', $request->all());
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);
    
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
    
        // Log the parsed date to see if it's working correctly
        \Log::info('Parsed Date', ['start_date' => $startDate]);
        \Log::info('Parsed Date', ['end_date' => $endDate]);

        

       

        return response()->json(['success' => true, 'message' => 'Success']);
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
