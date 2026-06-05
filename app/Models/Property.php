<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'type',
        'transaction_type',
        'surface',
        'price',
        'address',
        'district',
        'latitude',
        'longitude',
        'status',
        'description',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}