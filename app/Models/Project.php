<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'user_id','project_name','project_details','language_used', 'team_members', 'project_progress', 'status',
    ];

    public function user()
    {
    return $this->belongsTo(User::class, 'user_id');
    }

}
