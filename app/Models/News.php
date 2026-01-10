<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($news) => $news->slug = Str::slug($news->title));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
