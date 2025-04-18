<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallet';

    protected $fillable = [
        'user_id',
        'wallet_balance',
        'amount_added',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
