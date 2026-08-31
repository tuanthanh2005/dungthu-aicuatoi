@extends('layouts.admin')

@section('title', 'Bảng Hoa Hồng Sản Phẩm')
@section('page_title', 'Bảng Hoa Hồng Sản Phẩm')

@section('breadcrumb')
    <span>Bảng Hoa Hồng</span>
@endsection

@section('content')
<div class="container-fluid px-0">

    <!-- Role Permission Banner -->
    @if(!$canEdit)
        <div class="alert alert-info border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 1.2rem;">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-primary">Tài khoản SuperAdmin_1 (Chế độ Chỉ Xem)</h6>
                    <p class="mb-0 text-muted small">Bạn đang xem bảng hoa hồng ở chế độ xem &amp; xuất báo cáo Excel. Chỉ <strong>sieusuperadmin</strong> mới có quyền nhập hoặc thay đổi % Hoa hồng.</p>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.commissions.export', request()->all()) }}" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                    <i class="fas fa-file-excel me-2"></i>Xuất Excel Báo Cáo
                </a>
            </div>
        </div>
    @else
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 1.2rem;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-success">Quyền Quản Trị Tối Cao (SieuSuperAdmin)</h6>
                    <p class="mb-0 text-muted small">Bạn có thể nhập <strong>% Hoa hồng</strong> hoặc <strong>Hoa hồng nhận được</strong>. Hệ thống sẽ tự động tính toán số tiền và cập nhật số tiền về hệ thống.</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.commissions.export', request()->all()) }}" class="btn btn-outline-success rounded-pill px-3 fw-semibold">
                    <i class="fas fa-file-excel me-2"></i>Xuất Excel
                </a>
                <button type="button" form="commissionMassForm" onclick="submitMassForm()" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                    <i class="fas fa-save me-2"></i>Lưu Tất Cả Thay Đổi
                </button>
            </div>
        </div>
    @endif

    <!-- Summary Stats Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase mb-1">Tổng Số Sản Phẩm</div>
                        <div class="h3 fw-bold mb-0 text-dark">{{ number_format($totalProducts) }}</div>
                    </div>
                    <div class="rounded-4 p-3 bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-boxes fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase mb-1">Dự Kiến Chi Trả Hoa Hồng</div>
                        <div class="h3 fw-bold mb-0 text-warning" id="statTotalCommission">{{ number_format($totalCommissionPaid, 0, ',', '.') }}đ</div>
                    </div>
                    <div class="rounded-4 p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-hand-holding-usd fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase mb-1">Dự Kiến Tiền Về Hệ Thống</div>
                        <div class="h3 fw-bold mb-0 text-success" id="statTotalSystem">{{ number_format($totalSystemRevenue, 0, ',', '.') }}đ</div>
                    </div>
                    <div class="rounded-4 p-3 bg-success bg-opacity-10 text-success">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.commissions') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-6 col-lg-7">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3 text-muted">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 rounded-end-pill ps-0" placeholder="Tìm kiếm tên sản phẩm..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <select name="sort" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>Sắp xếp: Mặc định</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên sản phẩm (A-Z)</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Giá bán (Thấp -> Cao)</option>
                        <option value="commission_percent" {{ request('sort') == 'commission_percent' ? 'selected' : '' }}>% Hoa Hồng (Cao -> Thấp)</option>
                    </select>
                </div>
                <div class="col-md-2 col-lg-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill w-100 fw-semibold">
                        <i class="fas fa-filter me-1"></i>Lọc
                    </button>
                    @if(request()->hasAny(['search', 'sort']))
                        <a href="{{ route('admin.commissions') }}" class="btn btn-light rounded-pill text-muted" title="Xóa bộ lọc">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Main Commission Table Form -->
    <form id="commissionMassForm" action="{{ route('admin.commissions.update') }}" method="POST">
        @csrf
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="commissionTable">
                    <thead class="bg-light text-uppercase text-secondary fs-7 fw-bold">
                        <tr>
                            <th class="ps-4 py-3" style="width: 50px;">STT</th>
                            <th class="py-3" style="min-width: 260px;">Tên Sản Phẩm</th>
                            <th class="py-3 text-end" style="width: 140px;">Giá Sản Phẩm</th>
                            <th class="py-3 text-center" style="width: 150px;">% Hoa Hồng</th>
                            <th class="py-3 text-end" style="width: 200px;">Hoa Hồng Nhận Được</th>
                            <th class="py-3 text-end" style="width: 200px;">Tiền Về Hệ Thống</th>
                            @if($canEdit)
                                <th class="pe-4 py-3 text-center" style="width: 110px;">Thao Tác</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $index => $product)
                            @php
                                $price = (float) ($product->effective_price ?? $product->price ?? 0);
                                $percent = (float) $product->calculated_commission_percent;
                                $commAmount = (float) $product->calculated_commission_amount;
                                $sysAmount = (float) $product->calculated_system_amount;
                            @endphp
                            <tr id="row-{{ $product->id }}" class="commission-row" data-price="{{ $price }}" data-id="{{ $product->id }}">
                                <!-- STT -->
                                <td class="ps-4 text-muted fw-semibold">{{ $products->firstItem() + $index }}</td>

                                <!-- Product Name -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-0 fs-6">{{ $product->name }}</div>
                                            <div class="text-muted fs-7">ID: #{{ $product->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="text-end fw-bold text-dark fs-6">
                                    {{ number_format($price, 0, ',', '.') }}đ
                                </td>

                                <!-- % Hoa Hồng -->
                                <td class="text-center">
                                    @if($canEdit)
                                        <div class="input-group input-group-sm rounded-pill border overflow-hidden mx-auto" style="max-width: 120px;">
                                            <input type="number" 
                                                   step="0.1" 
                                                   min="0" 
                                                   max="100" 
                                                   name="commissions[{{ $product->id }}][percent]" 
                                                   class="form-control border-0 text-center fw-bold input-percent" 
                                                   value="{{ $percent > 0 ? $percent : '' }}" 
                                                   placeholder="0"
                                                   oninput="calculateFromPercent({{ $product->id }})">
                                            <span class="input-group-text border-0 bg-light text-muted px-2 fw-bold">%</span>
                                        </div>
                                    @else
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold fs-7">
                                            {{ $percent > 0 ? number_format($percent, 1) . '%' : '—' }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Hoa Hồng Nhận Được -->
                                <td class="text-end">
                                    @if($canEdit)
                                        <div class="input-group input-group-sm rounded-pill border overflow-hidden ms-auto" style="max-width: 170px;">
                                            <input type="number" 
                                                   step="1000" 
                                                   min="0" 
                                                   max="{{ $price }}" 
                                                   name="commissions[{{ $product->id }}][amount]" 
                                                   class="form-control border-0 text-end fw-bold text-warning input-amount" 
                                                   value="{{ $commAmount > 0 ? (int)$commAmount : '' }}" 
                                                   placeholder="0"
                                                   oninput="calculateFromAmount({{ $product->id }})">
                                            <span class="input-group-text border-0 bg-light text-muted px-2 fw-bold">đ</span>
                                        </div>
                                    @else
                                        <span class="fw-bold text-warning fs-6 display-comm-amount">
                                            {{ $commAmount > 0 ? number_format($commAmount, 0, ',', '.') . 'đ' : '—' }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Tiền Về Hệ Thống -->
                                <td class="text-end">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold fs-6 display-sys-amount">
                                        {{ number_format($sysAmount, 0, ',', '.') }}đ
                                    </span>
                                </td>

                                <!-- Single Save Action (SieuSuperAdmin only) -->
                                @if($canEdit)
                                    <td class="pe-4 text-center">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold btn-single-save" 
                                                onclick="saveSingleProduct({{ $product->id }})" 
                                                title="Lưu dòng này">
                                            <i class="fas fa-check"></i> Lưu
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $canEdit ? 7 : 6 }}" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                                        <h6 class="fw-bold">Không tìm thấy sản phẩm nào!</h6>
                                        <p class="small mb-0">Thử thay đổi từ khóa tìm kiếm hoặc bấm lại lọc danh sách.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer Pagination -->
            @if($products->hasPages())
                <div class="card-footer bg-white border-top-0 p-3 d-flex align-items-center justify-content-between">
                    <div class="text-muted small">
                        Hiển thị {{ $products->firstItem() }} - {{ $products->lastItem() }} trên tổng {{ $products->total() }} sản phẩm
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        </div>
    </form>

</div>
@endsection

@push('scripts')
<script>
/**
 * Auto Calculate values when % Hoa Hồng is entered
 */
function calculateFromPercent(id) {
    const row = document.getElementById('row-' + id);
    if (!row) return;

    const price = parseFloat(row.getAttribute('data-price')) || 0;
    const inputPercent = row.querySelector('.input-percent');
    const inputAmount = row.querySelector('.input-amount');
    const displaySys = row.querySelector('.display-sys-amount');

    let percent = parseFloat(inputPercent.value) || 0;
    if (percent > 100) {
        percent = 100;
        inputPercent.value = 100;
    }

    const amount = Math.round((price * percent) / 100);
    const system = Math.max(0, price - amount);

    if (inputAmount) {
        inputAmount.value = amount > 0 ? amount : '';
    }
    if (displaySys) {
        displaySys.textContent = formatCurrency(system);
    }
}

/**
 * Auto Calculate values when Hoa Hồng Nhận Được is entered
 */
function calculateFromAmount(id) {
    const row = document.getElementById('row-' + id);
    if (!row) return;

    const price = parseFloat(row.getAttribute('data-price')) || 0;
    const inputPercent = row.querySelector('.input-percent');
    const inputAmount = row.querySelector('.input-amount');
    const displaySys = row.querySelector('.display-sys-amount');

    let amount = parseFloat(inputAmount.value) || 0;
    if (amount > price) {
        amount = price;
        inputAmount.value = price;
    }

    const percent = price > 0 ? parseFloat(((amount / price) * 100).toFixed(2)) : 0;
    const system = Math.max(0, price - amount);

    if (inputPercent) {
        inputPercent.value = percent > 0 ? percent : '';
    }
    if (displaySys) {
        displaySys.textContent = formatCurrency(system);
    }
}

/**
 * Format currency number to Vietnamese format (e.g., 340.000đ)
 */
function formatCurrency(num) {
    return new Intl.NumberFormat('vi-VN').format(num) + 'đ';
}

/**
 * Single Row Ajax Save (SieuSuperAdmin)
 */
function saveSingleProduct(id) {
    const row = document.getElementById('row-' + id);
    if (!row) return;

    const inputPercent = row.querySelector('.input-percent');
    const inputAmount = row.querySelector('.input-amount');
    const btn = row.querySelector('.btn-single-save');

    const percent = inputPercent ? inputPercent.value : 0;
    const amount = inputAmount ? inputAmount.value : 0;

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    fetch('{{ route('admin.commissions.update') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: id,
            commission_percent: percent,
            commission_amount: amount
        })
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check"></i> Lưu';

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: data.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500
            });
            if (inputPercent) inputPercent.value = data.data.commission_percent > 0 ? data.data.commission_percent : '';
            if (inputAmount) inputAmount.value = data.data.commission_amount > 0 ? Math.round(data.data.commission_amount) : '';
            const displaySys = row.querySelector('.display-sys-amount');
            if (displaySys) displaySys.textContent = data.data.formatted_system_amount;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: data.message || 'Có lỗi xảy ra khi lưu dữ liệu.'
            });
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check"></i> Lưu';
        Swal.fire({
            icon: 'error',
            title: 'Lỗi hệ thống!',
            text: 'Không thể kết nối máy chủ.'
        });
    });
}

/**
 * Submit Mass Form (SieuSuperAdmin)
 */
function submitMassForm() {
    Swal.fire({
        title: 'Lưu toàn bộ thay đổi?',
        text: 'Tất cả cấu hình % Hoa hồng trên trang này sẽ được lưu vào hệ thống.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Lưu ngay',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('commissionMassForm').submit();
        }
    });
}
</script>
@endpush
