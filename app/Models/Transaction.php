<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    'invoice_number',
    'user_id',
    'transaction_date',
    'total_item',
    'total_price',
    'payment_type',
    'payment_method',
    'pay',
    'change',
];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
{
    return $this->hasMany(TransactionDetail::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}