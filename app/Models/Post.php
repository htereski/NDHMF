<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['imagem', 'titulo', 'texto', 'user_id'];

    protected $casts = [
        'texto' => PurifyHtmlOnGet::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}