<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\LetterRequest;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role_id === 1) {
            return $this->adminDashboard();
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

        $genderData = Resident::selectRaw('gender, count(*) as count')
            ->groupBy('gender')
            ->pluck('count', 'gender')
            ->toArray();

        $recentLetters = LetterRequest::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.dashboard', compact('stats', 'genderData', 'recentLetters'));
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
