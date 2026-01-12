<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'fund_category_id',
        'user_id',
        'transaction_date',
        'title',
        'description',
        'amount',
        'proof_file',
    ];

    // Relasi: Transaksi milik satu kategori
    public function category()
    {
        return $this->belongsTo(FundCategory::class, 'fund_category_id');
    }

    // Relasi: Transaksi diinput oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
