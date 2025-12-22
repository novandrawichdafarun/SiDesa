@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buat Permohonan Surat</h6>
            </div>
            <div class="card-body">
                <form action="/letters" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Jenis Surat</label>
                        <select name="letter_type_id" class="form-control" required>
                            <option value="">-- Pilih Jenis Surat --</option>
                            @foreach ([
                                (object) ['id' => 1, 'name' => 'Surat Keterangan Domisili', 'code' => 'SKD'],
                                (object) ['id' => 2, 'name' => 'Surat Keterangan Tidak Mampu', 'code' => 'SKTM'],
                                (object) ['id' => 3, 'name' => 'Surat Keterangan Usaha', 'code' => 'SKU'],
                            ] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <textarea name="purpose" class="form-control" rows="3" placeholder="Contoh: Persyaratan melamar pekerjaan"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Kirim Permohonan</button>
                    <a href="/letters" class="btn btn-secondary btn-block">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
