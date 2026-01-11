<div class="modal fade" id="modalApprove{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/account-request/approval/{{ $item->id }}" method="post">
            @csrf
            @method('POST')
            <div class="modal-content" style="border: none; border-radius: 0.75rem;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #1cc88a 0%, #15a26e 100%); border: none;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; font-weight: 600;">
                        <i class="fas fa-check-circle mr-2"></i>Konfirmasi Persetujuan
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    Apakah Anda yakin ingin <b>menyetujui</b> akun atas nama {{ $item->name }}?
                    <div class="form-group mt-4">
                        <label for="resident_id" class="font-weight-600 text-gray-800">Pautkan dengan Data Penduduk
                            (Opsional)</label>
                        <select name="resident_id" class="form-control"
                            style="border-radius: 0.25rem; border: 1px solid #e3e6f0;">
                            <option value="">-- Tidak Ada --</option>
                            @foreach ($residents as $resident)
                                <option value="{{ $resident->id }}">{{ $resident->name }} (NIK: {{ $resident->nik }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e3e6f0;">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"
                        style="border-radius: 0.25rem;">Batal</button>
                    <input type="hidden" name="for" value="approve">
                    <button type="submit" class="btn"
                        style="background: linear-gradient(135deg, #1cc88a 0%, #15a26e 100%); color: white; border: none; border-radius: 0.25rem;">Ya,
                        Setujui</button>
                </div>
            </div>
        </form>
    </div>
</div>
