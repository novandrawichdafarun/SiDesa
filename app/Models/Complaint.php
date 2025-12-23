<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [];

    public function getStatusLabelAttribute()// status_label
    {
        return match ($this->status) {
            'new' => 'Baru',
            'processing' => 'Sedang Diproses',
            'completed' => 'Selesai',
            default => 'Tidak Diketahui',
        };
    }

    public function getReportDateLabelAttribute()
    {
        return \Carbon\Carbon::parse($this->report_date)->translatedFormat('d M Y, H:i:s');
    }

    public function getStatusColorAttribute() // status_color
    {
        return match ($this->status) {
            'new' => 'info',
            'processing' => 'warning',
            'completed' => 'success',
            default => 'secondary',
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
