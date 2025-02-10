<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function transactiondetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}

class TransactionDetail extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
