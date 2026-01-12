<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\LetterRequest;
use App\Models\News;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('query');
        $user = Auth::user();
        $results = [];

        if (strlen($keyword) >= 2) { // Minimal 2 karakter baru cari

            // --- 1. PENCARIAN HALAMAN / MENU SISTEM ---
            // Kita definisikan manual menu-menu yang ada di sistem
            $systemPages = [
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fas fa-fw fa-tachometer-alt'],
                ['title' => 'Ganti Password', 'url' => route('change-password.index'), 'icon' => 'fas fa-fw fa-key'],
                ['title' => 'Pengumuman', 'url' => route('news.index'), 'icon' => 'fas fa-fw fa-bullhorn'],
                ['title' => 'Edit Profil', 'url' => route('profile.index'), 'icon' => 'fas fa-fw fa-user'],
                ['title' => 'Keuangan Desa', 'url' => route('funds.index'), 'icon' => 'fas fa-fw fa-wallet']
            ];

            // Menu khusus Admin/Pejabat
            if ($user->role_id != 2) {
                $systemPages[] = ['title' => 'Data Penduduk', 'url' => url('/resident'), 'icon' => 'fas fa-fw fa-users'];
                $systemPages[] = ['title' => 'Data Pengaduan', 'url' => url('/complaint'), 'icon' => 'fas fa-fw fa-bullhorn'];
                $systemPages[] = ['title' => 'Kelola Berita', 'url' => route('news.index'), 'icon' => 'fas fa-fw fa-newspaper'];
            }

            // Menu khusus Penduduk
            if ($user->role_id == 2) {
                $systemPages[] = ['title' => 'Buat Surat', 'url' => url('/letters/create'), 'icon' => 'fas fa-fw fa-envelope'];
                $systemPages[] = ['title' => 'Buat Aduan', 'url' => url('/complaint/create'), 'icon' => 'fas fa-fw fa-plus-circle'];
            }

            // Filter Array Halaman berdasarkan keyword
            foreach ($systemPages as $page) {
                if (stripos($page['title'], $keyword) !== false) {
                    $results[] = [
                        'category' => 'Halaman',
                        'title' => $page['title'],
                        'url' => $page['url'],
                        'icon' => $page['icon']
                    ];
                }
            }

            // --- 2. PENCARIAN DATA PENDUDUK (hanya untuk Admin/Pejabat) ---
            if ($user->role_id != 2) {
                $residents = Resident::where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('nik', 'LIKE', '%' . $keyword . '%')
                    ->limit(5)
                    ->get();

                foreach ($residents as $resident) {
                    $results[] = [
                        'category' => 'Penduduk',
                        'title' => $resident->name . ' (' . $resident->nik . ')',
                        'url' => url('/resident'), // Link to index, as no show route
                        'icon' => 'fas fa-fw fa-users'
                    ];
                }
            }

            // --- 3. PENCARIAN BERITA ---
            $news = News::where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('content', 'LIKE', '%' . $keyword . '%');
            })
                ->whereNotNull('slug')
                ->limit(5)
                ->get();

            foreach ($news as $item) {
                $results[] = [
                    'category' => 'Berita',
                    'title' => $item->title,
                    'url' => route('news.show', $item->slug),
                    'icon' => 'fas fa-fw fa-newspaper'
                ];
            }

            // --- 4. PENCARIAN PENGADUAN ---
            $complaints = Complaint::where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('content', 'LIKE', '%' . $keyword . '%')
                ->limit(5)
                ->get();

            foreach ($complaints as $complaint) {
                $results[] = [
                    'category' => 'Pengaduan',
                    'title' => $complaint->title,
                    'url' => url('/complaint'), // Link to index
                    'icon' => 'fas fa-fw fa-bullhorn'
                ];
            }

            // --- 5. PENCARIAN SURAT (untuk semua role yang bisa akses) ---
            $letters = LetterRequest::where('purpose', 'LIKE', '%' . $keyword . '%')
                ->limit(5)
                ->get();

            foreach ($letters as $letter) {
                $results[] = [
                    'category' => 'Surat',
                    'title' => $letter->purpose,
                    'url' => url('/letters'), // Link to index
                    'icon' => 'fas fa-fw fa-envelope'
                ];
            }
        }

        return response()->json($results);
    }
}

