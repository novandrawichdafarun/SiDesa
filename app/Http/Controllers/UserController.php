<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountRequestView()
    {
        $user = User::where('status', 'submitted')->get();
        return view('pages.account-request.index', [
            'users' => $user
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
        $user = User::findOrFail($id);

        $action = $request->input('for');

        if ($action === 'approve' || $action === 'activate') {
            $user->status = 'approved';
        } else {
            $user->status = 'rejected';
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

        return back()->with('success', $message);
    }


}
