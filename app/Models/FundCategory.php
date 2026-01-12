<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'fiscal_year',
        'budget_cap',
        'description',
    ];

    public function transactions()
    {
        return $this->hasMany(FundTransaction::class);
    }

    // Helper: Menghitung total yang sudah teralisasi (terpakai/terima)
    public function getRealizedAmountAttribute()
    {
        return $this->transactions->sum('amount');
    }

    // Helper: Menghitung sisa anggaran (hanya valid untuk pengeluaran)
    public function getRemainingBudgetAttribute()
    {
        if ($this->type == 'expense') {
            return $this->budget_cap - $this->transactions->sum('amount');
        }
        return 0;
    }
}
