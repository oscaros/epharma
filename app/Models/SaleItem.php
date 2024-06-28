<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    //primary key is saleItemID
    protected $primaryKey = 'SaleItemID';

    protected $table = 'salesitems';

    protected $fillable = [
        'SaleID',
        
        'Quantity',
        'Price',
        'Status',
        'ProductID',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'SaleID', 'id'); // Correct foreign key and local key
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'ProductID');
    }

}
