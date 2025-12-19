<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index()
    {
        $residentId = Auth::user()->resident->id ?? null;
        $complaints = Complaint::when(Auth::user()->role_id == 2, function ($query) use ($residentId) {
            $query->where('resident_id', $residentId);
        })->paginate(5);
        return view('pages.complaint.index', compact('complaints'));
    }

    public function create()
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung ke data penduduk.');
        }

        return view('pages.complaint.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'content' => ['required', 'string', 'min:3', 'max:255'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg,jpeg,PNG,JPG,JPEG', 'max:2048'],
        ]);

        $resident = Auth::user()->resident;

        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung ke data penduduk.');
        }

        $complaint = new Complaint();
        $complaint->resident_id = $resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Pengaduan berhasil dibuat');
    }

    public function edit($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung ke data penduduk.');
        }

        $complaint = Complaint::findOrFail($id);
        return view('pages.complaint.edit', compact('complaint'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'content' => ['required', 'string', 'min:3', 'max:255'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg,jpeg,PNG,JPG,JPEG', 'max:2048'],
        ]);

        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung ke data penduduk.');
        }

        $complaint = Complaint::findOrFail($id);

        if ($complaint->status != 'new') {
            return redirect('/complaint')->with('error', "Pengaduan anda $complaint->status_label, pengaduan tidak dapat diubah.");
        }

        $complaint->resident_id = $resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            if (isset($complaint->photo_proof)) {
                Storage::delete($complaint->photo_proof);
            }
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Pengaduan berhasil diubah');
    }

    public function destroy($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung ke data penduduk.');
        }

        $complaint = Complaint::findOrFail($id);

        if ($complaint->status != 'new') {
            return redirect('/complaint')->with('error', "Pengaduan anda $complaint->status_label, pengaduan tidak dapat dihapus.");
        }

        if (isset($complaint->photo_proof)) {
            Storage::delete($complaint->photo_proof);
        }
        $complaint->delete();

        return redirect('/complaint')->with('success', 'Pengaduan berhasil dihapus');
    }

    public function update_status(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['new', 'processing', 'completed'])],
        ]);

        $resident = Auth::user()->resident;
        if (!$resident && Auth::user()->role_id != 1) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung ke data penduduk.');
        }

        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->input('status');

        $complaint->save();

        return redirect('/complaint')->with('success', 'Status pengaduan berhasil diubah');
    }
}
