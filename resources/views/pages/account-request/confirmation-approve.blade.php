<div class="modal fade" id="modalApprove{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Persetujuan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <b>menyetujui</b> akun atas nama {{ $item->name }}?
                <div class="form-group mt-3">
                    <label for="resident_id">Pautkan dengan Data Penduduk (Opsional)</label>
                    <select name="resident_id" class="form-control">
                        <option value="">-- Tidak Ada --</option>
                        @foreach ($residents as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->name }} (NIK: {{ $resident->nik }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                <form action="{{ route('account-request.approval', $item->id) }}" method="POST">
                    @csrf
                    {{-- Input hidden ini yang dibaca controller --}}
                    <input type="hidden" name="for" value="approve">
                    <button type="submit" class="btn btn-success">Ya, Setujui</button>
                </form>
            </div>
        </div>
    </div>
</div>
