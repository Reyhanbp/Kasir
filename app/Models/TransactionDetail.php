<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';
    protected $fillable = [
        'transaction_id',
        'item_id',
        'qty',
        'subtotal',
    ];
    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    public function items()
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
