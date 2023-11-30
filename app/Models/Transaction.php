<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'date',
        'total',
        'pay_total',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

}
