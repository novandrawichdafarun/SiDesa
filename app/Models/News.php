<?php

namespace App\Models;

use Database\Factories\NewsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return NewsFactory::new();
    }

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
