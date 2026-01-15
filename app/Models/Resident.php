<?php

namespace App\Models;

use Database\Factories\ResidentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'residents';

    protected $fillable = [
        'user_id',
        'nik',
        'name',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'rt',
        'rw',
        'religion',
        'marital_status',
        'occupation',
        'phone',
        'status'
    ];
    protected $guarded = [];

    protected static function newFactory()
    {
        return ResidentFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
