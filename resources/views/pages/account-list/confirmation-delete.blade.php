{{-- Modal Confirmation Delete --}}
<div class="modal fade" id="confirmationDelete-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmationDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="/account-list/{{ $item->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content" style="border: none; border-radius: 0.75rem;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); border: none;">
                    <h4 class="modal-title fs-5" id="confirmationDeleteLabel" style="color: white; font-weight: 600;">
                        <i class="fas fa-trash-alt mr-2"></i>Konfirmasi Hapus
                    </h4>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close"
                        style="color: white; border: none;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body text-start py-4">
                    <p class="mb-2"><strong>Nama Pengguna:</strong> {{ $item->name }}</p>
                    <p class="text-danger"><i class="fas fa-exclamation-triangle mr-2"></i>Apakah Anda yakin ingin
                        menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e3e6f0;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 0.25rem;">Tutup</button>
                    <button type="submit" class="btn"
                        style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white; border: none; border-radius: 0.25rem;">Ya,
                        Hapus!</button>
                </div>
            </div>
        </form>
    </div>
</div>
