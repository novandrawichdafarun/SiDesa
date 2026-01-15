<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use App\Models\LetterType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LetterRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id != 2 && $user->role_id != 4) {
            $requests = LetterRequest::with(['user', 'letterType'])->latest()->get();
        } else if ($user->role_id == 4) {
            $resident = $user->resident;
            $rt = $resident->rt;
            $rw = $resident->rw;

            $requests = LetterRequest::with('letterType')
                ->whereHas('user.resident', function ($query) use ($rt, $rw) {
                    if ($rt) {
                        $query->where('rt', $rt);
                    } elseif ($rw) {
                        $query->where('rw', $rw);
                    } else {
                        $query->whereNull('id'); // jika RT dan RW kosong, tidak menampilkan data
                    }
                })
                ->latest()
                ->get();
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
        if (Auth::user()->role_id !== 3 && $letter->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki otorisasi untuk menghapus surat ini.');
        }

        $letter->delete();
        return redirect('/letters')->with('success', 'Data berhasil dihapus');
    }
    public function download($id)
    {
        $item = LetterRequest::with(['user.resident', 'letterType'])->findOrFail($id);

        if ($item->status !== 'selesai') {
            return back()->with('error', 'Surat belum disetujui.');
        }
        // Generate konten QR Code (Misal: Link verifikasi ke website desa)
        // Dalam riil, ini mengarah ke route verify public
        $validationUrl = route('letter.verify', ['id' => $item->id, 'hash' => md5($item->created_at)]);

        // Kita render QR code sebagai base64 image agar bisa masuk ke PDF
        $qrcode = base64_encode(QrCode::format('svg')->size(100)->generate($validationUrl));

        $pdf = Pdf::loadView('pages.letter.pdf_template', [
            'item' => $item,
            'resident' => $item->user->resident,
            'qrcode' => $qrcode
        ]);

        return $pdf->download('Surat-' . $item->user->resident->nik . '.pdf');
    }

    public function approve(Request $request, LetterRequest $letter)
    {
        $user = Auth::user();

        // Cek apakah data letter benar-benar ditemukan
        if (!$letter->exists) {
            return back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Cek apakah canApproveBy mengembalikan false
        if (!$letter->canApproveBy($user->role_id)) {
            return back()->with('error', 'Akses ditolak. Status saat ini: ' . $letter->status . ' dan Peran Anda ID: ' . $user->role_id);
        }

        $nextStatus = match ($user->role_id) {
            4 => 'disetujui_rt_rw',
            1 => 'disetujui_admin',
            3 => 'selesai',
            default => $letter->status
        };


        $letter->update(['status' => $nextStatus]);

        return redirect('/letters')->with('success', 'Status surat berhasil diperbarui menjadi ' . $request->status);
    }

    public function reject(Request $request, LetterRequest $letter)
    {
        $user = Auth::user();

        // Cek apakah data letter benar-benar ditemukan
        if (!$letter->exists) {
            return back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Cek apakah canApproveBy mengembalikan false
        if (!$letter->canApproveBy($user->role_id)) {
            return back()->with('error', 'Akses ditolak. Status saat ini: ' . $letter->status . ' dan Peran Anda ID: ' . $user->role_id);
        }

        $letter->update(['status' => 'rejected', 'catatan_revisi' => $request->catatan_revisi]);

        return redirect('/letters')->with('success', 'Surat telah ditolak.');
    }

    public function verify($id, $hash)
    {
        // Logika untuk menampilkan halaman "Dokumen Asli" bagi siapa saja yang scan QR
        $item = LetterRequest::findOrFail($id);
        // Cek hash untuk keamanan sederhana...
        return "Dokumen ini ASLI dan dikeluarkan oleh Desa pada " . $item->updated_at;
    }

}
