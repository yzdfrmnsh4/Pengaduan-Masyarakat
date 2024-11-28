<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    
    protected $fillable = [
        'user_id', 
        'user_type', 
        'action', 
        'description', 
        'ip_address'
    ];
}
