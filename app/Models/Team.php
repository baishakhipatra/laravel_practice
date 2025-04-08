<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_name',
        'team_lead_id',
        'team_members',
    ];

    public function teamLead()
    {
        return $this->belongsTo(User::class, 'team_lead_id');
    }

    public function members()
    {
        return $this->hasMany(User::class, 'team_id');
    }
}
