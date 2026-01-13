<div class="modal fade" id="modalApprove{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('letters-list.approval', $item->id) }}" method="POST">
            @csrf
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
                    <p class="text-wrap">Apakah Anda yakin ingin <b>menyetujui</b> permohonan surat atas nama
                        {{ $item->user->name }}? </p>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e3e6f0;">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"
                        style="border-radius: 0.25rem;">Batal</button>
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn"
                        style="background: linear-gradient(135deg, #1cc88a 0%, #15a26e 100%); color: white; border: none; border-radius: 0.25rem;">Ya,
                        Setujui</button>
                </div>
            </div>
        </form>
    </div>
</div>
