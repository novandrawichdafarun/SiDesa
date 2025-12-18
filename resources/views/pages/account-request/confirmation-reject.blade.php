<div class="modal fade" id="modalReject{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penolakan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">
                Apakah Anda yakin ingin <b>menolak</b> akun atas nama {{ $item->name }}?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                <form action="{{ route('account-request.approval', $item->id) }}" method="POST">
                    @csrf
                    {{-- Input hidden ini yang dibaca controller --}}
                    <input type="hidden" name="for" value="reject">
                    <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                </form>
            </div>
        </div>
    </div>
</div>
