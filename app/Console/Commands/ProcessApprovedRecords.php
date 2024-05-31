<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductTemp;
use Illuminate\Console\Command;

class ProcessApprovedRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-approved-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
   
   
    public function handle()
    {
        // Query the source table for records with status 'approved'
        $approvedRecords = ProductTemp::where('status', 'Approved')->get();

        // Update the destination table with approved records
        foreach ($approvedRecords as $record) {
            // Update the destination table or perform any necessary actions

            $product = Product::find($record->serial_number);

            $old_quantity = $product->Quantity;
            $new_quantity = $record->NewQuantity;
            $quantity = $old_quantity + $new_quantity;
            Product::update([
                // 'field1' => $record->field1,
                'ProductName' => $record->ProductName,
                'Quantity' => $quantity,
                // Add other fields as needed
              
                'Price' => $record->Price,
               
                // 'serial_number' => $request->serial_number,
                'expiry_date' => $record->expiry_date,
                'entity_id' => auth()->user()->entity_id,
            ]);

            $record->delete();

        }

        $this->info('Approved records processed successfully.');
    }
}
