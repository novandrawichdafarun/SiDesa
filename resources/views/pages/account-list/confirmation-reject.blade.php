<div class="modal fade" id="modalReject{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: none; border-radius: 0.75rem;">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); border: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white; font-weight: 600;">
                    <i class="fas fa-ban mr-2"></i>Konfirmasi Non-Aktivasi
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body py-4">
                Apakah Anda yakin ingin <b>menonaktifkan</b> akun ini?
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e3e6f0;">
                <button class="btn btn-secondary" type="button" data-dismiss="modal"
                    style="border-radius: 0.25rem;">Batal</button>
                <form action="{{ route('account-request.approval', $item->id) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    <input type="hidden" name="for" value="deactivate">
                    <button type="submit" class="btn"
                        style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white; border: none; border-radius: 0.25rem;">Ya,
                        Non-Aktifkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
