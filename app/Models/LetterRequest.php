<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LetterRequest extends Model
{
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
}
