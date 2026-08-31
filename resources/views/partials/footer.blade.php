<footer class="footer-techfeed">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="footer-brand d-flex align-items-center gap-2 mb-2">
                    <img src="{{ asset('images/aicuatoi-logo.png') }}" alt="AICuaToi Logo" 
                         style="width: 38px; height: 38px; object-fit: contain; flex-shrink: 0; filter: drop-shadow(0 2px 8px rgba(139, 92, 246, 0.4));">
                    <span class="fw-bold fs-5 text-dark">AICuaToi<span style="color: #a855f7;">.com</span></span>
                </div>
                <div class="d-inline-flex align-items-center gap-1 badge rounded-pill px-3 py-1 text-white mb-2 shadow-sm" style="background: linear-gradient(135deg, #8b5cf6 0%, #c084fc 100%); font-size: 11px;">
                    <i class="fa-solid fa-handshake"></i> {{ __('Đối Tác của DungThu.com') }}
                </div>
                <p class="small text-muted">{{ __('Nền tảng cung cấp tài khoản AI, giải pháp công nghệ AI và công cụ số chất lượng hàng đầu Việt Nam.') }}</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">{{ __('Liên kết nhanh') }}</h6>
                <ul class="footer-links">
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#aboutModal">{{ __('Về chúng tôi') }}</a></li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">{{ __('Chính sách bảo mật') }}</a></li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#advertisingModal">{{ __('Liên hệ quảng cáo') }}</a></li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#contactModal">{{ __('Liên hệ ngay') }}</a></li>
                    <li><a href="{{ route('shop') }}">{{ __('Cửa hàng') }}</a></li>
                    <li><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">{{ __('Sản phẩm nổi bật') }}</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('product.keyword', 'gpt') }}">{{ __('Mua tài khoản ChatGPT') }}</a></li>
                    <li><a href="{{ route('product.keyword', 'cursor') }}">{{ __('Mua tài khoản Cursor AI Pro') }}</a></li>
                    <li><a href="{{ route('product.keyword', 'gemini') }}">{{ __('Mua tài khoản Gemini Advanced') }}</a></li>
                    <li><a href="{{ route('product.keyword', 'youtube') }}">{{ __('Mua YouTube Premium') }}</a></li>
                    <li><a href="{{ route('product.keyword', 'office') }}">{{ __('Mua Office 365') }}</a></li>
                    <li><a href="{{ route('product.keyword', 'canva') }}">{{ __('Mua Canva Pro') }}</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">{{ __('Tải App & Trải nghiệm') }}</h6>
                <ul class="footer-links mb-3">
                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appDownloadModal"><i class="fa-brands fa-android text-success me-1"></i> {{ __('App Android (Mobile)') }}</a></li>
                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appDownloadModal"><i class="fa-brands fa-apple text-white me-1"></i> {{ __('App iOS (iPhone/iPad)') }}</a></li>
                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appDownloadModal"><i class="fa-solid fa-desktop text-primary me-1"></i> {{ __('App Desktop (Windows)') }}</a></li>
                    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appDownloadModal"><i class="fa-solid fa-bolt text-warning me-1"></i> {{ __('PWA Native Install') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-copy">
            © {{ date('Y') }} <strong>AICuaToi.com</strong> &mdash; {{ __('Đối Tác của') }} <a href="https://dungthu.com" target="_blank" class="text-decoration-none fw-bold" style="color: #8b5cf6;">DungThu.com</a> &mdash; Made with <i class="fa-solid fa-heart text-danger"></i> in Vietnam
        </div>
    </div>
</footer>

    <!-- About Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                    <h5 class="modal-title fw-bold" id="aboutModalLabel">
                        <i class="fas fa-info-circle me-2"></i>{{ __('Về Chúng Tôi') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body p-4" style="font-size: 15px; line-height: 1.8; color: #4a5568;">
                    <h6 class="fw-bold mb-3" style="color: #7c3aed;">{{ __('🎯 Sứ Mệnh Của Chúng Tôi') }}</h6>
                    <p>{{ __('AICuaToi.com là một nền tảng cung cấp tài khoản AI, công cụ AI bản quyền và giải pháp số hàng đầu cho cộng đồng Việt Nam. Chúng tôi cam kết mang lại giá trị tốt nhất cho khách hàng với sản phẩm chất lượng cao và giá cạnh tranh.') }}</p>

                    <h6 class="fw-bold mb-3 mt-4" style="color: #7c3aed;">{{ __('✨ Tại Sao Chọn AICuaToi?') }}</h6>
                    <ul class="ms-3">
                        <li><strong>{{ __('Sản phẩm chất lượng:') }}</strong> {{ __('Tất cả tài khoản được kích hoạt chính hãng và bảo hành uy tín') }}</li>
                        <li><strong>{{ __('Giá cạnh tranh:') }}</strong> {{ __('Giá tốt nhất trên thị trường') }}</li>
                        <li><strong>{{ __('Hỗ trợ 24/7:') }}</strong> {{ __('Đội ngũ chuyên gia sẵn sàng hỗ trợ bạn') }}</li>
                        <li><strong>{{ __('An toàn:') }}</strong> {{ __('Bảo vệ thông tin cá nhân và giao dịch an toàn') }}</li>
                    </ul>

                    <div class="alert alert-success mt-4" style="border-radius: 12px;">
                        <i class="fas fa-heart me-2"></i>
                        <strong>{{ __('Cảm ơn bạn đã tin tưởng AICuaToi.com!') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                    <h5 class="modal-title fw-bold" id="privacyModalLabel">
                        <i class="fas fa-shield-alt me-2"></i>{{ __('Chính Sách Bảo Mật') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body p-4" style="font-size: 15px; line-height: 1.8; color: #4a5568;">
                    <h6 class="fw-bold mb-3" style="color: #7c3aed;">{{ __('📋 Thông Tin Chúng Tôi Thu Thập') }}</h6>
                    <p>{{ __('Chúng tôi thu thập những thông tin sau để phục vụ bạn tốt hơn:') }}</p>
                    <ul class="ms-3">
                        <li>{{ __('Tên, email, số điện thoại khi bạn đăng ký') }}</li>
                        <li>{{ __('Địa chỉ giao hàng để xử lý đơn hàng') }}</li>
                        <li>{{ __('Lịch sử mua hàng và sở thích sản phẩm') }}</li>
                    </ul>

                    <h6 class="fw-bold mb-3 mt-4" style="color: #7c3aed;">{{ __('🔒 Bảo Vệ Thông Tin') }}</h6>
                    <p>{{ __('Chúng tôi sử dụng mã hóa SSL/TLS cho tất cả giao tiếp và không chia sẻ thông tin cá nhân với bên thứ ba.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Advertising Modal -->
    <div class="modal fade" id="advertisingModal" tabindex="-1" aria-labelledby="advertisingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                    <h5 class="modal-title fw-bold" id="advertisingModalLabel">
                        <i class="fas fa-bullhorn me-2"></i>{{ __('Liên Hệ Quảng Cáo') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body p-4" style="font-size: 15px; line-height: 1.8; color: #4a5568;">
                    <h6 class="fw-bold mb-3" style="color: #7c3aed;">{{ __('📢 Cơ Hội Quảng Cáo') }}</h6>
                    <p>{{ __('AICuaToi.com có hàng ngàn khách hàng tiềm năng hàng tháng. Chúng tôi cung cấp các giải pháp quảng cáo linh hoạt giúp thương hiệu của bạn tiếp cận khán giả chính xác.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                    <h5 class="modal-title fw-bold" id="contactModalLabel">
                        <i class="fas fa-phone-alt me-2"></i>{{ __('Liên Hệ Chúng Tôi') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-center mb-4" style="font-size: 16px; line-height: 1.8;">
                        <strong>{{ __('Hãy liên hệ với chúng tôi qua các kênh dưới đây:') }}</strong>
                    </p>

                    <!-- Email Contact -->
                    <a href="mailto:tvu81568890@gmail.com" class="d-block p-3 mb-3 rounded-3"
                        style="background: #faf5ff; border: 2px solid #8b5cf6; text-decoration: none; color: inherit;">
                        <div style="text-align: center;">
                            <i class="fas fa-envelope"
                                style="font-size: 2rem; color: #8b5cf6; margin-bottom: 10px; display: block;"></i>
                            <h6 class="fw-bold mt-2 mb-1">📧 Email</h6>
                            <small style="color: #718096;">tvu81568890@gmail.com</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

