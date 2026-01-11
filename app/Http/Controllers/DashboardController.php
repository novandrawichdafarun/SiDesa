<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\LetterRequest;
use App\Models\News;
use App\Models\Resident;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return match ((int) $user->role_id) {
            1 => $this->adminDashboard(),
            3 => $this->kadesDashboard(),
            4 => $this->rtDashboard($user), // Tambahkan method untuk RT/RW
            default => $this->residentDashboard($user),
        };
    }

    public function adminDashboard()
    {
        $stats = [
            'residents' => Resident::count(),
            // Admin hanya mengurus surat yang sudah di-acc RT/RW
            'pending_letters' => LetterRequest::where('status', 'disetujui_rt_rw')->count(),
            'pending_complaints' => Complaint::where('status', 'pending')->count(),
            'pending_accounts' => User::where('status', 'submitted')->count(),
        ];

        $genderData = [
            'male' => Resident::where('gender', 'male')->count(),
            'female' => Resident::where('gender', 'female')->count(),
        ];

        $recentLetters = LetterRequest::with('user')
            ->where('status', 'disetujui_rt_rw')
            ->latest()->take(5)->get();

        $residentJob = Resident::select('occupation', DB::raw('COUNT(*) as count'))
            ->whereNotNull('occupation')
            ->groupBy('occupation')
            ->get();

        $jobLabels = $residentJob->pluck('occupation');
        $jobData = $residentJob->pluck('count');
        $newsFeed = News::latest()->take(3)->get();

        return view('pages.dashboard.dashboard', compact('stats', 'genderData', 'recentLetters', 'jobLabels', 'jobData', 'newsFeed'));
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

        $stats = [
            'residents' => Resident::count(),
            'waiting_signature' => LetterRequest::where('status', 'disetujui_admin')->count(),
            'today_letters' => LetterRequest::where('created_at', today())->count(),
            'total_news' => News::count(),
        ];

        $recentLetters = LetterRequest::with('user')
            ->where('status', 'disetujui_admin')
            ->latest()->take(5)->get();

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
        $newsFeed = News::latest()->take(3)->get();

        return view('pages.dashboard.dashboard', [
            // ... variable yang sudah ada ...
            'newsFeed' => $newsFeed,
            'stats' => $stats,
            'recentLetters' => $recentLetters,
            'complaintData' => $complaintData,
            'demographyLabels' => ['Anak (0-14)', 'Produktif (15-64)', 'Lansia (65+)'],
            'demographyData' => array_values($demography),
            'servicePerformance' => $performance
        ]);
    }

    public function rtDashboard($user)
    {
        // Gunakan scope wilayah jika sudah ada di model Resident
        $resident = $user->resident;
        $query = LetterRequest::with(['user', 'letterType'])->where('status', 'pending');
        $newsFeed = News::latest()->take(3)->get();

        // Jika data resident ada, filter berdasarkan RT/RW resident tersebut
        if ($resident) {
            $query->whereHas('user.resident', function ($q) use ($resident) {
                $q->where('rt', $resident->rt)
                    ->where('rw', $resident->rw);
            });
        } else {
            $query->whereRaw('1 = 0');
        }

        $stats = [
            'residents' => Resident::count(),
            'my_citizens' => $resident ? Resident::where('rt', $resident->rt)->where('rw', $resident->rw)->count() : 0,
            'pending_letters' => $resident ? $query->count() : 0,
            'has_resident_data' => $resident ? true : false,
        ];

        $recentLetters = $resident ? $query->latest()->take(5)->get() : collect([]);

        return view('pages.dashboard.dashboard', compact('stats', 'recentLetters', 'newsFeed'));
    }

    public function residentDashboard($user)
    {
        $resident = Resident::where('user_id', $user->id)->first();
        $newsFeed = News::latest()->take(3)->get();

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

        return view('pages.dashboard.dashboard', compact('myLetters', 'myComplaints', 'isProfileComplete', 'newsFeed'));
    }
}
