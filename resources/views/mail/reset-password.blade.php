@component('mail::message')
# 🔐 Đặt Lại Mật Khẩu

Xin chào!

Bạn vừa yêu cầu đặt lại mật khẩu cho tài khoản của bạn trên **AICuaToi.com**.

@component('mail::button', ['url' => $resetUrl])
Đặt Lại Mật Khẩu
@endcomponent

**Lưu ý quan trọng:**
- Link này sẽ **hết hạn trong 60 phút**
- Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng **bỏ qua email này**
- Không chia sẻ link này với bất kỳ ai

Nếu nút trên không hoạt động, hãy copy và paste URL này vào trình duyệt:
{{ $resetUrl }}

---

**Cần trợ giúp?** Liên hệ chúng tôi tại [tranthanhtuanfix@gmail.com](mailto:tranthanhtuanfix@gmail.com)

Trân trọng,
**Đội ngũ AICuaToi.com**

@component('mail::subcopy')
Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.
@endcomponent
@endcomponent

