@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Permohonan Surat</h6>
            </div>
            <div class="card-body">
                <form action="/letters/{{ $letter->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Jenis Surat</label>
                        <select name="letter_type_id" class="form-control" required>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ $letter->letter_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <textarea name="purpose" class="form-control" rows="3" required>{{ $letter->purpose }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
