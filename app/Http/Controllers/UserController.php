<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Resident;

class UserController extends Controller
{
    public function accountRequestView()
    {
        $user = User::where('status', 'submitted')->get();

        $residents = Resident::whereNull('user_id')->get();

        return view('pages.account-request.index', [
            'users' => $user,
            'residents' => $residents
        ]);
    }

    public function accountListView()
    {
        $user = User::where('role_id', 2)
            ->where('status', '!=', 'submitted')
            ->get();

        return view('pages.account-list.index', [
            'users' => $user
        ]);
    }

    public function accountApproval(Request $request, $id)
    {
        $request->validate([
            'for' => ['required', Rule::in(['approve', 'reject', 'activate', 'deactivate'])],
            'reason' => ['nullable', 'exists:residents,id', 'string', 'max:255'],
        ]);

        $user = User::findOrFail($id);
        $action = $request->input('for');

        if ($action === 'approve' || $action === 'activate') {
            $user->status = 'approved';
            $message = 'Berhasil menyetujui akun ' . $user->name;

            if ($request->has('resident_id') && $request->input('resident_id')) {
                $resident = Resident::find($request->input('resident_id'));
                if ($resident) {
                    $resident->user_id = $user->id;
                    $resident->save();
                }
            }
        } else {
            $user->status = 'rejected';
            $message = 'Berhasil menolak akun ' . $user->name;
        }

        $user->save();

        if ($action === 'activate') {
            $message = 'Akun berhasil diaktifkan';
        } elseif ($action === 'deactivate') {
            $message = 'Akun berhasil dinonaktifkan';
        } elseif ($action === 'approve') {
            $message = 'Akun berhasil disetujui';
        } else {
            $message = 'Akun berhasil ditolak';
        }

        $user->save();
        return back()->with('success', $message);
    }

    public function profileView()
    {
        return view('pages.profile.index');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function changePasswordView()
    {
        return view('pages.profile.change-password');
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::findOrFail($id);

        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return back()->with('success', 'Berhasil mengubah password');
        } else {
            return back()->with('error', 'Gagal mengubah password. Password lama tidak valid.');
        }
    }

}
