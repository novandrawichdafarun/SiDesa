<div class="modal fade" id="detailAccount-{{ $item->id }}" tabindex="-1" aria-labelledby="detailAccountLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border: none; border-radius: 0.75rem;">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border: none;">
                <h4 class="modal-title fs-5" id="detailAccountLabel" style="color: white; font-weight: 600;">
                    <i class="fas fa-user-circle mr-2"></i>Detail Akun
                </h4>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close"
                    style="color: white; border: none;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body py-4">
                <div class="form-group mb-4">
                    <label for="name" class="font-weight-600 text-gray-800 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $item->user->name }}" readonly
                        style="background-color: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 0.25rem;">
                </div>
                <div class="form-group mb-2">
                    <label for="email" class="font-weight-600 text-gray-800 mb-2">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $item->user->email }}" readonly
                        style="background-color: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 0.25rem;">
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e3e6f0;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="border-radius: 0.25rem;">Tutup</button>
            </div>
        </div>
    </div>
</div>
