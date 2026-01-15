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
        $user = Auth::user();
        $query = Resident::query();
        $resident = $user->resident;

        //? filter data sesuai RT/RW jika user adalah RT/RW
        if ($user->role_id === 4) {
            if ($resident) {
                $rt = $resident->rt;
                $rw = $resident->rw;
            }
            if ($rt) {
                $query->where('rt', $rt);
            } elseif ($rw) {
                $query->where('rw', $rw);
            } else {
                $query->whereNull('id'); // jika RT dan RW kosong, tidak menampilkan data
            }
            $residents = $query->latest()->get();
        } else {
            $residents = $query->latest()->get();
        }


        return view('pages.resident.index', [
            'residents' => $residents ?? []
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
            'nik' => ['required', 'digits:16', 'unique:residents,nik', 'regex:/^35/'],
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'date'],
            'birth_place' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:700'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'religion' => ['nullable', 'string', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:15'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ], [
            'nik.required' => 'NIK harus diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nik.regex' => 'NIK harus diawali dengan kode wilayah yang sesuai (35..).',
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'gender.required' => 'Jenis kelamin harus dipilih.',
            'birth_date.required' => 'Tanggal lahir harus diisi.',
            'birth_place.required' => 'Tempat lahir harus diisi.',
            'birth_place.max' => 'Tempat lahir maksimal 100 karakter.',
            'address.required' => 'Alamat harus diisi.',
            'address.max' => 'Alamat maksimal 700 karakter.',
            'rt.max' => 'RT maksimal 5 karakter.',
            'rw.max' => 'RW maksimal 5 karakter.',
            'religion.string' => 'Agama harus berupa string.',
            'religion.max' => 'Agama maksimal 50 karakter.',
            'marital_status.required' => 'Status perkawinan harus dipilih.',
            'occupation.max' => 'Pekerjaan maksimal 100 karakter.',
            'occupation.string' => 'Pekerjaan harus berupa string.',
            'phone.max' => 'Nomor telepon maksimal 15 karakter.',
            'phone.unique' => 'Nomor telepon sudah terdaftar.',
            'status.required' => 'Status harus dipilih.',
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
            'nik' => ['required', 'digits:16', 'regex:/^35/'],
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'date'],
            'birth_place' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:700'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'religion' => ['nullable', 'string', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:15'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ], [
            'nik.required' => 'NIK harus diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 karakter.',
            'nik.regex' => 'NIK harus diawali dengan kode wilayah yang sesuai (35..).',
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'gender.required' => 'Jenis kelamin harus dipilih.',
            'birth_date.required' => 'Tanggal lahir harus diisi.',
            'birth_place.required' => 'Tempat lahir harus diisi.',
            'birth_place.max' => 'Tempat lahir maksimal 100 karakter.',
            'address.required' => 'Alamat harus diisi.',
            'address.max' => 'Alamat maksimal 700 karakter.',
            'rt.max' => 'RT maksimal 5 karakter.',
            'rw.max' => 'RW maksimal 5 karakter.',
            'religion.string' => 'Agama harus berupa string.',
            'religion.max' => 'Agama maksimal 50 karakter.',
            'marital_status.required' => 'Status perkawinan harus dipilih.',
            'occupation.max' => 'Pekerjaan maksimal 100 karakter.',
            'occupation.string' => 'Pekerjaan harus berupa string.',
            'phone.max' => 'Nomor telepon maksimal 15 karakter.',
            'phone.unique' => 'Nomor telepon sudah terdaftar.',
            'status.required' => 'Status harus dipilih.',
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
