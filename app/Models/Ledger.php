<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ledger extends Model
{
    use HasFactory;

    protected $table = 'ledgers';
    protected $fillable = [
        'user_id',
        'transaction_id',
        'transaction_amount',
        'is_credit',
        'is_debit',
        'purpose',
        'purpose_description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
