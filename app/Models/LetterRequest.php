<?php

namespace App\Models;

use Database\Factories\LetterRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LetterRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function letterType()
    {
        return $this->belongsTo(LetterType::class);
    }

    protected static function newFactory()
    {
        return LetterRequestFactory::new();
    }

    public function viewOwnScope($query)
    {
        $user = Auth::user();

        if ($user && $user->role_id === 4 && $user->resident) {
            $userRt = $user->resident->rt;
            $userRw = $user->resident->rw;

            return $query->whereHas('resident', function ($q) use ($userRt, $userRw) {
                $q->where('rt', $userRt)
                    ->where('rw', $userRw);
            });
        }

        return $query;
    }

    public function canApproveBy($roleId)
    {
        return match ((int) $roleId) {
            4 => $this->status === 'pending',
            1 => $this->status === 'disetujui_rt_rw',
            3 => $this->status === 'disetujui_admin',
            default => false,
        };
    }
}
