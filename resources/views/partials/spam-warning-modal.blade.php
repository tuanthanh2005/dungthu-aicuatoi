<!-- Modal Xác Nhận Đối Tác Chính Thức DungThu.com -->
<div class="modal fade" id="spamWarningWelcomeModal" tabindex="-1" aria-labelledby="spamWarningWelcomeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 22px; overflow: hidden; background: #ffffff;">
            {{-- Header --}}
            <div class="modal-header border-0 text-white px-4 py-3 position-relative d-flex align-items-center justify-content-between" 
                 style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);">
                <div>
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2 mb-1" id="spamWarningWelcomeModalLabel" style="font-size: 16.5px;">
                        <i class="fa-solid fa-circle-check text-warning"></i>
                        {{ __('ĐỐI TÁC CHÍNH THỨC DUNGTHU.COM') }}
                    </h5>
                    <div class="d-flex align-items-center gap-1 text-white-50" style="font-size: 11.5px;">
                        <span style="width: 7px; height: 7px; background-color: #4ade80; border-radius: 50%; display: inline-block; animation: pulseDotLive 1.5s infinite;"></span>
                        <span class="text-white fw-medium">{{ __('Xác thực hệ thống & Bảo hành liên kết') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white close-spam-modal-btn" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.9; filter: invert(1) grayscale(1) brightness(2);"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-3 p-sm-4" style="background-color: #fbf9ff;">
                <div class="p-3 bg-white rounded-3 shadow-sm border mb-3" style="border-color: #e9d5ff !important;">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #f3e8ff; color: #8b5cf6;">
                            <i class="fa-solid fa-handshake fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-size: 14.5px; color: #1e1b4b;">
                                {{ __('AICuaToi.com là Đối Tác của DungThu.com') }}
                            </h6>
                            <p class="text-muted mb-0" style="font-size: 12.5px; line-height: 1.5;">
                                {{ __('Website con trực thuộc hệ sinh thái công nghệ, phân phối tài khoản AI & giải pháp số chính hãng, bảo hành đồng bộ 100%.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 text-start mb-3">
                    <div class="d-flex align-items-start gap-2 p-2 rounded-2" style="background-color: #faf5ff; border: 1px solid #f3e8ff;">
                        <i class="fa-solid fa-shield-halved text-success mt-1" style="font-size: 13px;"></i>
                        <span style="font-size: 12.5px; line-height: 1.4; color: #374151;">
                            <strong>{{ __('Cam kết chất lượng:') }}</strong> {{ __('Toàn bộ tài khoản AI, bản quyền tool được cung cấp và bảo hành trực tiếp từ hệ sinh thái DungThu.com.') }}
                        </span>
                    </div>

                    <div class="d-flex align-items-start gap-2 p-2 rounded-2" style="background-color: #f5f3ff; border: 1px solid #ede9fe;">
                        <i class="fa-solid fa-globe text-primary mt-1" style="font-size: 13px;"></i>
                        <span style="font-size: 12.5px; line-height: 1.4; color: #374151;">
                            <strong>{{ __('Website Chính Thống:') }}</strong> {{ __('Bạn có thể ghé thăm trang chủ mẹ tại ') }}<a href="https://dungthu.com" target="_blank" class="fw-bold text-decoration-underline" style="color: #7c3aed;">dungthu.com</a>.
                        </span>
                    </div>
                </div>

                {{-- Nút link qua web chính thống --}}
                <div class="text-center pt-1">
                    <a href="https://dungthu.com" target="_blank" class="btn w-100 py-2 fw-bold text-white shadow-sm d-flex align-items-center justify-content-center gap-2" 
                       style="background: linear-gradient(135deg, #ff5e00 0%, #ff8e43 100%); border-radius: 12px; font-size: 13px; text-decoration: none;">
                        <i class="fa-solid fa-external-link-alt"></i> {{ __('Ghé thăm Website chính: DungThu.com') }}
                    </a>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer border-0 p-3 bg-white d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-sm btn-light border text-muted px-3 close-spam-modal-btn" data-bs-dismiss="modal" style="border-radius: 20px; font-size: 12px;">
                    <i class="fa-solid fa-xmark me-1"></i>{{ __('Đóng (Tắt 1h)') }}
                </button>
                <button type="button" class="btn btn-sm text-white px-4 fw-bold shadow-sm close-spam-modal-btn" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #8b5cf6 0%, #c084fc 100%); border-radius: 20px; font-size: 12.5px;">
                    <i class="fa-solid fa-check me-1"></i>{{ __('Tiếp tục tại AICuaToi.com') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('spamWarningWelcomeModal');
        const STORAGE_KEY = 'partner_welcome_modal_closed_until';
        const closedUntil = localStorage.getItem(STORAGE_KEY);
        const now = Date.now();

        const shouldShowPartnerModal = modalEl && (!closedUntil || now >= parseInt(closedUntil, 10));

        if (shouldShowPartnerModal) {
            // 1. Hiển thị Modal Đối Tác (sau 1.2s)
            setTimeout(() => {
                const bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                bsModal.show();
            }, 1200);

            // Khi đóng modal -> Cho phép mở modal Đơn hàng mới
            modalEl.addEventListener('hidden.bs.modal', function () {
                const oneHourLater = Date.now() + 3600000;
                localStorage.setItem(STORAGE_KEY, oneHourLater.toString());

                if (typeof window.showRecentOrdersModal === 'function') {
                    setTimeout(() => {
                        window.showRecentOrdersModal();
                    }, 400);
                }
            }, { once: true });
        } else {
            // 2. Nếu Modal đã tắt 1h -> Hiển thị thẳng modal Đơn hàng mới
            if (typeof window.showRecentOrdersModal === 'function') {
                setTimeout(() => {
                    window.showRecentOrdersModal();
                }, 1500);
            }
        }

        if (modalEl) {
            // Lưu mốc thời gian ẩn 1 tiếng khi click nút đóng/tôi đã hiểu
            const actionElements = modalEl.querySelectorAll('.close-spam-modal-btn');
            actionElements.forEach(el => {
                el.addEventListener('click', function() {
                    const oneHourLater = Date.now() + 3600000;
                    localStorage.setItem(STORAGE_KEY, oneHourLater.toString());
                });
            });
        }
    });
</script>
