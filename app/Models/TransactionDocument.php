<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'path',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}