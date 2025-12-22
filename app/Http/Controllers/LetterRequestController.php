<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use App\Models\LetterType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id === 1) {
            $requests = LetterRequest::with(['user', 'letterType'])->latest()->get();
        } else {
            $requests = LetterRequest::with('letterType')->where('user_id', $user->id)->latest()->get();
        }

        return view('pages.letter.index', compact('requests'));
    }

    public function create()
    {
        $types = LetterType::all();
        return view('pages.letter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_type_id' => ['required'],
            'purpose' => ['required', 'string', 'max:255'],
        ]);

        LetterRequest::create([
            'user_id' => Auth::id(),
            'letter_type_id' => $request->letter_type_id,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return redirect('/letters')->with('success', 'Permohonan Surat Berhasil Dikirim');
    }

    public function edit($id)
    {
        $letter = LetterRequest::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $types = LetterType::all();
        return view('pages.letter.edit', compact('letter', 'types'));
    }

    public function update(Request $request, $id)
    {
        $letter = LetterRequest::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $request->validate([
            'letter_type_id' => 'required',
            'purpose' => 'required|string|max:255',
        ]);

        $letter->update([
            'letter_type_id' => $request->letter_type_id,
            'purpose' => $request->purpose,
        ]);

        return redirect('/letters')->with('success', 'Permohonan surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $letter = LetterRequest::findOrFail($id);

        // Cek otorisasi: hanya pemilik (jika pending) atau admin yang boleh hapus
        if (Auth::user()->role !== 'admin' && $letter->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki otorisasi untuk menghapus surat ini.');
        }

        $letter->delete();
        return redirect('/letters')->with('success', 'Data berhasil dihapus');
    }

    public function print($id)
    {
        $request = LetterRequest::with(['user.resident', 'letterType'])->findOrFail($id);

        if ($request->status !== 'approved') {
            return redirect('/letters')->with('error', 'Permohonan Surat belum disetujui oleh admin.');
        }

        $pdf = Pdf::loadView('pages.letter.pdf_template', [
            'data' => $request,
            'resident' => $request->user->resident,
        ]);

        return $pdf->stream('Surat-' . $request->user->name . '.pdf');
    }

    public function update_status(Request $request, $id)
    {
        if (Auth::user()->role_id !== 1) {
            return back()->with('error', 'Hanya admin yang dapat mengubah status surat.');
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_note' => 'nullable|string'
        ]);

        $letter = LetterRequest::findOrFail($id);
        $letter->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note // Catatan jika ditolak
        ]);

        return redirect('/letters')->with('success', 'Status surat berhasil diperbarui menjadi ' . $request->status);
    }
}
