<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with('user')->get();
        return view('pages.resident.index', [
            'residents' => $residents
        ]);
    }

    public function create()
    {
        return view('pages.resident.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $data = $request->validate([
            'nik' => ['required', 'min:16', 'max:16', 'unique:residents,nik'],
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'date'],
            'birth_place' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:700'],
            'religion' => ['nullable', 'string', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:15'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        Resident::create($data);

        return redirect('/resident')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);

        return view('pages.resident.edit', [
            'resident' => $resident
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $data = $request->validate([
            'nik' => ['required', 'min:16', 'max:16', 'unique:residents,nik'],
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'date'],
            'birth_place' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:700'],
            'religion' => ['nullable', 'string', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:15'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        Resident::findOrFail($id)->update($data);

        return redirect('/resident')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect('/resident')->with('success', 'Data berhasil dihapus');
    }
}
