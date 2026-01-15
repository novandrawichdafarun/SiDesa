<div class="modal fade" id="detailReject-{{ $item->id }}" tabindex="-1" aria-labelledby="detailRejectLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="detailRejectLabel">Detail Penolakan</h4>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Permohonan surat Anda ditolak dengan alasan berikut:</p>
                <div class="alert alert-danger" role="alert">
                    {{ $item->catatan_revisi }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
