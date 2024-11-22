<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VictimHasChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'victim_id',
        'chat_id'
    ];
    
}