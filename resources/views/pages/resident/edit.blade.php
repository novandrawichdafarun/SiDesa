@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Penduduk</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mt-4">
                        <p>{{ $error }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <form action="/resident/{{ $resident->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="nik">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" placeholder="Masukkan NIK" inputmode="numeric"
                                value="{{ old('nik', $resident->nik) }}">
                            @error('nik')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukkan Nama" value="{{ old('name', $resident->name) }}">
                            @error('name')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender"
                                class="form-control @error('gender') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Laki-laki',
                'value' => 'male',
            ],
            (object) [
                'label' => 'Perempuan',
                'value' => 'female',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('gender', $resident->gender) == $item->value)>
                                        {{ $item->label }}</option>
                                @endforeach
                            </select>
                            @error('gender')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="birth_date">Tangal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                id="birth_date" name="birth_date" value="{{ old('birth_date', $resident->birth_date) }}">
                            @error('birth_date')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="birth_place">Tempat Lahir</label>
                            <input type="text" class="form-control @error('birth_place') is-invalid @enderror"
                                id="birth_place" name="birth_place" placeholder="Masukkan Tempat Lahir"
                                value="{{ old('birth_place', $resident->birth_place) }}">
                            @error('birth_place')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" cols="10" rows="3"
                                class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan Alamat">{{ old('address', $resident->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="religion">Agama</label>
                            <input type="text" class="form-control @error('religion') is-invalid @enderror"
                                id="religion" name="religion" placeholder="Masukkan Agama"
                                value="{{ old('religion', $resident->religion) }}">
                            @error('religion')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="marital_status">Status Pernikahan</label>
                            <select name="marital_status" id="marital_status"
                                class="form-control @error('marital_status') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Belum Menikah',
                'value' => 'single',
            ],
            (object) [
                'label' => 'Sudah Menikah',
                'value' => 'married',
            ],
            (object) [
                'label' => 'Cerai',
                'value' => 'divorced',
            ],
            (object) [
                'label' => 'Janda/Duda',
                'value' => 'widowed',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('marital_status', $resident->marital_status) == $item->value)>
                                        {{ $item->label }}</option>
                                @endforeach
                            </select>
                            @error('marital_status')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="occupation">Pekerjaan</label>
                            <input type="text" class="form-control @error('occupation') is-invalid @enderror"
                                id="occupation" name="occupation" placeholder="Masukkan Pekerjaan"
                                value="{{ old('occupation', $resident->occupation) }}">
                            @error('occupation')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="phone">Nomor Telepon</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" placeholder="Masukkan Nomor Telepon" inputmode="numeric"
                                value="{{ old('phone', $resident->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Hidup',
                'value' => 'active',
            ],
            (object) [
                'label' => 'Pindah',
                'value' => 'moved',
            ],
            (object) [
                'label' => 'Almarhum',
                'value' => 'deceased',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('status', $resident->status) == $item->value)>
                                        {{ $item->label }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/resident" class="btn btn-outline-secondary mr-3">Kembali</a>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
