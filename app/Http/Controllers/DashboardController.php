<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\LetterRequest;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            return $this->adminDashboard();
        } else if ($user->role_id === 3) {
            return $this->kadesDashboard();
        }

        return $this->residentDashboard($user);
    }

    public function adminDashboard()
    {
        $stats = [
            'residents' => Resident::count(),
            'pending_letters' => LetterRequest::where('status', 'pending')->count(),
            'pending_complaints' => Complaint::where('status', 'pending')->count(),
        ];

        $genderData = [
            'male' => Resident::where('gender', 'male')->count(),
            'female' => Resident::where('gender', 'female')->count(),
        ];

        $recentLetters = LetterRequest::with('user')
            ->latest()
            ->take(5)
            ->get();

        $residentJob = Resident::select('occupation', DB::raw('COUNT(*) as count'))
            ->whereNotNull('occupation')
            ->groupBy('occupation')
            ->get();

        $jobLabels = $residentJob->pluck('occupation');
        $jobData = $residentJob->pluck('count');

        return view('pages.dashboard', compact('stats', 'genderData', 'recentLetters', 'jobLabels', 'jobData'));
    }

    public function kadesDashboard()
    {
        // 1. Grafik Pengaduan (Tren Bulanan & Kategori)
        $complaintStats = Complaint::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month')->all();

        // Mapping data bulanan (isi 0 jika bulan tidak ada data)
        $complaintData = [];
        for ($i = 1; $i <= 12; $i++) {
            $complaintData[] = $complaintStats[$i] ?? 0;
        }

        // 2. Demografi Cepat (Piramida Umur - Simplified)
        // Mengelompokkan penduduk: Anak (0-14), Produktif (15-64), Lansia (>65)
        $residents = Resident::all();
        $demography = [
            'anak' => $residents->filter(fn($r) => Carbon::parse($r->birth_date)->age < 15)->count(),
            'produktif' => $residents->filter(fn($r) => Carbon::parse($r->birth_date)->age >= 15 && Carbon::parse($r->birth_date)->age <= 64)->count(),
            'lansia' => $residents->filter(fn($r) => Carbon::parse($r->birth_date)->age > 64)->count(),
        ];

        // 3. Kinerja Layanan (Rata-rata waktu proses dalam Jam)
        // Menghitung selisih created_at dan updated_at untuk surat yang 'approved'
        $performance = LetterRequest::where('status', 'approved')
            ->get()
            ->map(function ($item) {
                return $item->created_at->diffInHours($item->updated_at);
            })
            ->avg(); // Rata-rata jam

        $performance = round($performance ?? 0, 1); // Pembulatan

        return view('pages.dashboard', [
            // ... variable yang sudah ada ...
            'complaintData' => $complaintData,
            'demographyLabels' => ['Anak (0-14)', 'Produktif (15-64)', 'Lansia (65+)'],
            'demographyData' => array_values($demography),
            'servicePerformance' => $performance
        ]);
    }

    public function residentDashboard($user)
    {
        $resident = Resident::where('user_id', $user->id)->first();

        if ($resident) {
            $myLetters = LetterRequest::latest()
                ->take(3)
                ->get();

            $myComplaints = Complaint::latest()
                ->take(3)
                ->get();

        } else {
            $myLetters = collect([]);
            $myComplaints = collect([]);
        }


        $isProfileComplete = Resident::where('user_id', $user->id)->exists();

        return view('pages.dashboard', compact('myLetters', 'myComplaints', 'isProfileComplete'));
    }
}
